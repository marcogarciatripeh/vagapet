@extends('layouts.app')

@section('title', 'Manual do Usuário - VagaPet')

@section('content')
<div class="page-wrapper dashboard">
  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Cabeçalho Principal -->
  @include('layouts.partials.header-dynamic')
  <!-- Fim do Cabeçalho Principal -->

  <!-- Painel (Manual do Usuário) -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="row">
        <div class="col-lg-12">
          <!-- Ls widget (Seção de Informações Básicas) -->
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Manual do Usuário — VagaPet</h4>
              </div>

              <div class="widget-content">
                <h2>1. Introdução</h2>
                <p>O Manual do Usuário do <strong>VagaPet</strong> estabelece as condutas esperadas de quem acessa nossas plataformas — sejam profissionais, empresas contratantes, parceiros ou colaboradores. Nosso compromisso é oferecer um serviço de qualidade, transparente, garantindo uma experiência única. Para isso, contamos com a boa fé e bom senso dos usuários, tanto no ambiente digital quanto nas interações presenciais, baseadas em respeito, clareza e cordialidade.</p>
                <p>Qualquer ação que desrespeite as diretrizes deste Manual deve ser reportada por meio dos canais de comunicação do VagaPet, para que possamos investigar irregularidades e, se necessário, aplicar as penalidades cabíveis.</p>
                <p><strong>Nosso objetivo:</strong> simplificar e melhorar as conexões entre profissionais e empresas do mundo pet, sempre com respeito mútuo.</p>

                <h2>2. Aplicabilidade</h2>
                <p>Este Manual aplica-se a <strong>todos os usuários</strong> das plataformas VagaPet, incluindo profissionais cadastrados, empresas contratantes, fotógrafos, consultores, avaliadores, parceiros comerciais e colaboradores internos (os "Usuários").</p>

                <h2>3. Valores</h2>
                <p>No VagaPet, prezamos por <strong>transparência, integridade e equilíbrio nas relações</strong>, garantindo acesso correto às informações publicadas na plataforma.</p>

                <h2>4. Diversidade e Inclusão</h2>
                <p>Sabemos que reduzir desigualdades estruturais é responsabilidade coletiva. Trabalhar pela diversidade e inclusão não é apenas bom para os negócios — é <strong>o certo a se fazer</strong>. Incentivamos todos os usuários a consultar nossa <strong>Cartilha de Diversidade e Inclusão</strong> e acompanhar as ações que promovemos em nossos canais oficiais.</p>

                <h2>5. Condutas e Diretrizes</h2>
                <p><strong>Regra de ouro:</strong> não faça com os outros aquilo que você não gostaria que fizessem com você.</p>
                <ul>
                  <li><strong>Assédio:</strong> Não toleramos nenhum tipo de assédio — físico, verbal ou virtual.</li>
                  <li><strong>Contato e Comunicação:</strong> Use dados de forma responsável e apenas para os fins acordados.</li>
                  <li><strong>Compartilhamento de Conta:</strong> Não é permitido compartilhar contas com terceiros.</li>
                  <li><strong>Discriminação:</strong> Nenhuma forma de discriminação é aceita.</li>
                  <li><strong>Conflito de Interesses:</strong> É proibido desviar negociações da plataforma.</li>
                  <li><strong>Fraude:</strong> Uso de dados ou identidade falsos será tratado como violação grave.</li>
                  <li><strong>Maioridade:</strong> Apenas maiores de 18 anos ou emancipados podem usar a plataforma.</li>
                  <li><strong>Mau Comportamento:</strong> Não são toleradas ofensas, ameaças ou qualquer conduta agressiva.</li>
                  <li><strong>Mau Uso da Plataforma:</strong> Inclui fingir ser outra pessoa, prejudicar a imagem do VagaPet, usar bots, coletar dados indevidamente, entre outros.</li>
                </ul>

                <h2>6. Apuração de Irregularidades e Penalidades</h2>
                <p>O descumprimento deste manual poderá gerar bloqueio temporário ou definitivo da conta. As penalidades variam conforme o tipo de violação e a gravidade da conduta, com base em provas documentais e/ou testemunhais.</p>
                <p>Exemplos:</p>
                <ul>
                  <li><strong>Parceiros (ex: consultores, fotógrafos):</strong> podem ter contrato rescindido e perfil desativado.</li>
                  <li><strong>Terceiros (ex: funcionários do pet shop):</strong> recomendamos que o fato também seja reportado à administração local.</li>
                  <li><strong>Profissionais ou empresas:</strong> serão avaliadas e, se necessário, medidas proporcionais serão aplicadas.</li>
                </ul>

                <h3>Leia também:</h3>
                <ul>
                  <li><a href="{{ route('privacy') }}">Aviso de Privacidade</a></li>
                  <li><a href="{{ route('terms') }}">Termos e Condições de Uso</a></li>
                  <li><a href="{{ route('cookies') }}">Política de Cookies</a></li>
                </ul>

                <p><strong>Versão:</strong> 28/05/2025</p>
              </div>
            </div>
          </div>
          <!-- Fim Ls widget -->
        </div>
      </div>
    </div>
  </section>
  <!-- Fim Painel (Manual do Usuário) -->

  <!-- Rodapé -->
  @include('layouts.partials.copyright')
  <!-- Fim do Rodapé -->
</div>
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush
