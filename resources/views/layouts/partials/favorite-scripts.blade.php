<style>
/* Estilo para botão de favorito ativo - Cor verde primária */
.bookmark-btn.active {
  background-color: #28a745 !important;
  color: #fff !important;
}

.bookmark-btn.active i,
.bookmark-btn.active span {
  color: #fff !important;
}

/* Animação ao clicar */
.bookmark-btn {
  transition: all 0.3s ease;
}

.bookmark-btn:hover {
  transform: scale(1.1);
}
</style>

<script>
/**
 * Sistema de Favoritos - VagaPet
 * Função genérica para favoritar vagas (profissionais) e profissionais (empresas)
 */
function toggleFavorite(type, id, options) {
  options = options || {};
  // Verificar se o usuário está logado
  @guest
    alert('Faça login para favoritar itens.');
    window.location.href = '{{ route("login") }}';
    return;
  @endguest
  
  @auth
    // Verificar qual perfil o usuário tem
    const hasProfessionalProfile = {{ Auth::user()->professionalProfile ? 'true' : 'false' }};
    const hasCompanyProfile = {{ Auth::user()->companyProfile ? 'true' : 'false' }};
    
    // Validar permissões baseado no tipo
    if (type === 'App\\Models\\Job' || type === 'App\\Models\\CompanyProfile') {
      // Somente profissionais podem favoritar vagas e empresas
      if (!hasProfessionalProfile) {
        alert('Apenas profissionais podem favoritar vagas e empresas. Crie um perfil profissional primeiro.');
        return;
      }
    } else if (type === 'App\\Models\\ProfessionalProfile') {
      // Somente empresas podem favoritar profissionais
      if (!hasCompanyProfile) {
        alert('Apenas empresas podem favoritar profissionais. Crie um perfil empresarial primeiro.');
        return;
      }
    }
    
    // Determinar a rota baseada no perfil do usuário
    let route = '';
    if (hasProfessionalProfile && (type === 'App\\Models\\Job' || type === 'App\\Models\\CompanyProfile')) {
      route = '{{ route("professional.toggle-favorite") }}';
    } else if (hasCompanyProfile && type === 'App\\Models\\ProfessionalProfile') {
      route = '{{ route("company.toggle-favorite") }}';
    } else {
      alert('Você não tem permissão para favoritar este item.');
      return;
    }
    
    // Fazer a requisição AJAX
    fetch(route, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
      },
      body: JSON.stringify({
        favoritable_type: type,
        favoritable_id: id
      }),
      redirect: 'manual' // Não seguir redirects automaticamente
    })
    .then(response => {
      // Verificar se é um redirect (status 302, 301, etc)
      if (response.status >= 300 && response.status < 400) {
        // Redirect detectado - provavelmente não autenticado
        alert('Você precisa estar logado como empresa para favoritar profissionais.');
        window.location.href = '{{ route("login") }}';
        throw new Error('Redirecionamento para login');
      }
      
      // Verificar se há erro HTTP
      if (!response.ok) {
        // Tentar ler como JSON primeiro
        return response.json().then(jsonData => {
          // Se conseguiu parsear como JSON, mostrar mensagem específica
          const errorMessage = jsonData.error || jsonData.message || 'Erro na requisição';
          
          if (response.status === 401) {
            alert('Você precisa estar logado para favoritar profissionais.');
            window.location.href = '{{ route("login") }}';
            throw new Error('Não autenticado');
          } else if (response.status === 403) {
            alert(errorMessage || 'Você precisa ter um perfil de empresa para favoritar profissionais.');
            throw new Error('Sem permissão');
          }
          
          throw new Error(errorMessage);
        }).catch(error => {
          // Se não conseguiu parsear como JSON, tratar como texto
          if (error.message === 'Unexpected token < in JSON at position 0') {
            // Provavelmente recebeu HTML em vez de JSON
            if (response.status === 401 || response.status === 403) {
              alert('Você precisa estar logado como empresa para favoritar profissionais.');
              window.location.href = '{{ route("login") }}';
            }
            throw new Error('Erro na requisição: ' + response.status);
          }
          throw error;
        });
      }
      
      return response.json();
    })
    .then(data => {
      if (data.action === 'added') {
        // Atualizar visualmente o botão (adicionar classe 'active')
        updateFavoriteButton(id, true);
        
        // Feedback visual com ícone
        showFavoriteToast('✓ Adicionado aos favoritos!');

        if (typeof options.onAdded === 'function') {
          options.onAdded();
        }
      } else {
        // Atualizar visualmente o botão (remover classe 'active')
        updateFavoriteButton(id, false);
        
        // Feedback visual com ícone
        showFavoriteToast('✗ Removido dos favoritos');

        if (typeof options.onRemoved === 'function') {
          options.onRemoved();
        }
      }
    })
    .catch(error => {
      console.error('Erro:', error);
      
      // Se já foi tratado (redirect para login), não mostrar alerta duplicado
      if (error.message && error.message.includes('Redirecionamento para login')) {
        return;
      }
      
      // Se é erro de autenticação, já foi tratado acima
      if (error.message && (error.message.includes('401') || error.message.includes('403'))) {
        return;
      }
      
      // Mostrar mensagem genérica apenas se não foi um erro de autenticação
      alert('Erro ao favoritar. Tente novamente.');
      if (typeof options.onError === 'function') {
        options.onError(error);
      }
    });
    
    return false; // Sempre retornar false para prevenir comportamento padrão
  @endauth
  
  return false;
}

/**
 * Atualizar visualmente o botão de favorito
 */
function updateFavoriteButton(id, isActive) {
  const buttons = document.querySelectorAll(`[data-favorite-id="${id}"]`);
  buttons.forEach(button => {
    if (isActive) {
      button.classList.add('active');
      button.setAttribute('title', 'Remover dos favoritos');
    } else {
      button.classList.remove('active');
      button.setAttribute('title', 'Adicionar aos favoritos');
    }
  });
}

/**
 * Mostrar toast de feedback
 */
function showFavoriteToast(message) {
  // Remover toast anterior se existir
  const existingToast = document.getElementById('favorite-toast');
  if (existingToast) {
    existingToast.remove();
  }
  
  // Criar novo toast
  const toast = document.createElement('div');
  toast.id = 'favorite-toast';
  toast.style.cssText = `
    position: fixed;
    top: 80px;
    right: 20px;
    background: #28a745;
    color: white;
    padding: 15px 25px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    z-index: 9999;
    font-size: 14px;
    font-weight: 500;
    animation: slideIn 0.3s ease, slideOut 0.3s ease 2.7s;
  `;
  toast.textContent = message;
  document.body.appendChild(toast);
  
  // Remover após 3 segundos
  setTimeout(() => {
    if (toast.parentNode) {
      toast.remove();
    }
  }, 3000);
}

// Adicionar animações CSS
if (!document.getElementById('toast-animations')) {
  const style = document.createElement('style');
  style.id = 'toast-animations';
  style.textContent = `
    @keyframes slideIn {
      from {
        transform: translateX(400px);
        opacity: 0;
      }
      to {
        transform: translateX(0);
        opacity: 1;
      }
    }
    @keyframes slideOut {
      from {
        transform: translateX(0);
        opacity: 1;
      }
      to {
        transform: translateX(400px);
        opacity: 0;
      }
    }
  `;
  document.head.appendChild(style);
}
</script>

