@extends('layouts.dashboard')

@section('title', 'Perfil da Empresa - VagaPet')

@section('content')
  <!-- Painel de Perfil da Empresa -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Perfil da Empresa</h3>
      </div>

      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <ul class="mb-0">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      <div class="row">
        <div class="col-lg-12">
          <!-- Ls widget (Seção de Informações Básicas) -->
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Meu Perfil</h4>
              </div>

              <div class="widget-content">
                <form class="default-form" method="POST" action="{{ route('company.profile.update') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <!-- Logo da Empresa -->
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Logo da Empresa</label>
                      @if($profile->logo)
                        <div class="mb-3">
                          <img src="{{ url($profile->logo) }}" alt="Logo da Empresa" style="max-width: 200px; max-height: 200px; border: 1px solid #ddd; padding: 10px; border-radius: 8px;">
                        </div>
                      @endif
                      <div class="uploading-outer">
                        <div class="uploadButton">
                          <input class="uploadButton-input" type="file" name="logo" accept="image/*" id="upload-logo" />
                          <label class="uploadButton-button ripple-effect" for="upload-logo">{{ $profile->logo ? 'Alterar Logo' : 'Subir Logo' }}</label>
                          <span class="uploadButton-file-name"></span>
                        </div>
                        <div class="text">Tamanho máximo: 1MB. Formatos: .jpg e .png</div>
                      </div>
                    </div>

                    <!-- Nome Empresa -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Nome da empresa*</label>
                      <input type="text" name="company_name" placeholder="Nome do meu negócio" value="{{ old('company_name', $profile->company_name) }}" required>
                    </div>

                    <!-- Telefone -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Telefone*</label>
                      <input type="text" name="phone" id="phone" placeholder="(11) 98765-4321" value="{{ old('phone', $profile->phone) }}">
                    </div>

                    <!-- Endereço de E-mail -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Endereço de E-mail*</label>
                      <input type="email" placeholder="maria@exemplo.com" value="{{ Auth::user()->email }}" readonly disabled style="background-color: #e9ecef; cursor: not-allowed;">
                      <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                    </div>

                    <!-- Site -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Site</label>
                      <input type="text" name="website" placeholder="www.meuservicos.com.br" value="{{ old('website', $profile->website) }}">
                    </div>

                    <!-- Quantidade de funcionários -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Quantidade de funcionários</label>
                      <select class="chosen-select" name="company_size">
                        <option value="">Selecione</option>
                        <option value="1-4" {{ old('company_size', $profile->company_size) == '1-4' ? 'selected' : '' }}>Até 4</option>
                        <option value="5-10" {{ old('company_size', $profile->company_size) == '5-10' ? 'selected' : '' }}>De 5 a 10</option>
                        <option value="11-20" {{ old('company_size', $profile->company_size) == '11-20' ? 'selected' : '' }}>De 11 a 20</option>
                        <option value="21+" {{ old('company_size', $profile->company_size) == '21+' ? 'selected' : '' }}>Acima de 21</option>
                      </select>
                    </div>

                    <!-- CNPJ -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>CNPJ</label>
                      <input type="text" name="cnpj" id="cnpj" placeholder="00.000.000/0000-00" value="{{ old('cnpj', $profile->cnpj) }}" maxlength="18">
                    </div>

                    <!-- Serviços -->
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Serviços*</label>
                      <p>Você pode incluir mais de uma opção</p>
                      <input type="text" name="services" placeholder="Ex: Banho & Tosa, Recepção, Veterinário (separados por vírgula)" value="{{ old('services', is_array($profile->services) ? implode(', ', $profile->services) : $profile->services) }}">
                    </div>

                    <!-- Descrição -->
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Descrição</label>
                      <textarea name="description" placeholder="Fale sobre sua empresa, serviços oferecidos (banho, tosa, recepção, etc.) e qualquer outro detalhe relevante.">{{ old('description', $profile->description) }}</textarea>
                    </div>

                    <!-- Botão Salvar -->
                    <div class="form-group col-lg-6 col-md-12">
                      <button class="theme-btn btn-style-one">Salvar</button>
                    </div>
                  </div>
                </form>

                <!-- Status de Preenchimento -->
                <div class="form-group border-bottom mt-4">
                  @php
                    $percentage = $profile->getProfileCompletionPercentage();
                  @endphp
                  <label>Status de Preenchimento: <strong>{{ $percentage }}%</strong></label>
                  <div class="progress">
                    <div class="progress-bar {{ $percentage >= 90 ? 'bg-success' : 'bg-warning' }}" style="width: {{ $percentage }}%;"></div>
                  </div>
                  @if($percentage < 90)
                    <div class="alert alert-warning mt-2 mb-2">
                      <small><i class="la la-exclamation-triangle"></i> Complete seu perfil para melhorar sua visibilidade na plataforma.</small>
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>

          <!-- Ls widget (Seção Redes Sociais) -->
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Redes Sociais</h4>
                <p>Inclua suas redes sociais se quiser que outros vejam seu perfil e possam te seguir.</p>
              </div>

              <div class="widget-content">
                <form class="default-form" method="POST" action="{{ route('company.profile.update') }}">
                  @csrf
                  <!-- Campos obrigatórios ocultos -->
                  <input type="hidden" name="company_name" value="{{ $profile->company_name ?? '' }}">
                  <input type="hidden" name="city" value="{{ $profile->city ?? '' }}">
                  
                  <div class="row">
                    <!-- Facebook -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Facebook</label>
                      <input type="text" name="facebook" placeholder="www.facebook.com/MeuPerfil" value="{{ old('facebook', $profile->facebook) }}">
                    </div>

                    <!-- LinkedIn -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>LinkedIn</label>
                      <input type="text" name="linkedin" placeholder="www.linkedin.com/company/meuperfil" value="{{ old('linkedin', $profile->linkedin) }}">
                    </div>

                    <!-- Instagram -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Instagram</label>
                      <input type="text" name="instagram" placeholder="instagram.com/meuperfil" value="{{ old('instagram', $profile->instagram) }}">
                    </div>

                    <!-- YouTube -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>YouTube</label>
                      <input type="text" name="youtube" placeholder="youtube.com/@meuperfil" value="{{ old('youtube', $profile->youtube) }}">
                    </div>

                    <!-- Botão Salvar -->
                    <div class="form-group col-lg-6 col-md-12">
                      <button type="submit" class="theme-btn btn-style-one">Salvar</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Ls widget (Seção Informações de Contato) -->
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Localização</h4>
                <p>Só o bairro e cidade ficarão visíveis na plataforma para ajudar na busca por vagas releventes.</p>
              </div>

              <div class="widget-content">
                <form class="default-form" method="POST" action="{{ route('company.profile.update') }}">
                  @csrf
                  <!-- Campos obrigatórios ocultos -->
                  <input type="hidden" name="company_name" value="{{ $profile->company_name }}">
                  
                  <div class="row">

                    <!-- Endereço Completo -->
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Endereço Completo*</label>
                      <input type="text" name="address" placeholder="Rua Exemplo, 123" value="{{ old('address', $profile->address) }}">
                    </div>

                    <!-- Cidade -->
                    <div class="form-group col-lg-4 col-md-12">
                      <label>Cidade*</label>
                      <input type="text" name="city" placeholder="São Paulo" value="{{ old('city', $profile->city) }}">
                    </div>

                    <!-- Estado -->
                    <div class="form-group col-lg-4 col-md-12">
                      <label>Estado (UF)*</label>
                      <select name="state" class="chosen-select">
                        <option value="">Selecione o estado</option>
                        @foreach($states as $code => $name)
                          <option value="{{ $code }}" {{ old('state', $profile->state) == $code ? 'selected' : '' }}>
                            {{ $code }} - {{ $name }}
                          </option>
                        @endforeach
                      </select>
                    </div>

                    <!-- CEP -->
                    <div class="form-group col-lg-4 col-md-12">
                      <label>CEP</label>
                      <input type="text" name="zip_code" id="zip_code" placeholder="00000-000" value="{{ old('zip_code', $profile->zip_code) }}">
                    </div>

                    <!-- Latitude (oculto) -->
                    <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $profile->latitude ?? -23.550520) }}">
                    
                    <!-- Longitude (oculto) -->
                    <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $profile->longitude ?? -46.633308) }}">

                    <!-- Mapa do Google Maps -->
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Localização no Mapa</label>
                      <div id="map-canvas" style="width: 100%; height: 400px; border: 1px solid #ddd; border-radius: 4px;"></div>
                      <small class="form-text text-muted">O mapa será atualizado automaticamente quando você preencher o endereço ou CEP.</small>
                    </div>

                    <!-- Botão Salvar -->
                    <div class="form-group col-lg-12 col-md-12">
                      <button type="submit" class="theme-btn btn-style-one">Salvar</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- Fim Ls widget -->

        </div>
      </div>
    </div>
  </section>
  <!-- Fim Painel (Meu Perfil) -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
<script src="{{ asset('js/address-map.js') }}"></script>
<script>
  // Função para aplicar máscara de CNPJ
  function formatCNPJ(value) {
    value = value.replace(/\D/g, '');
    
    if (value.length <= 14) {
      value = value.replace(/^(\d{2})(\d)/, '$1.$2');
      value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
      value = value.replace(/\.(\d{3})(\d)/, '.$1/$2');
      value = value.replace(/(\d{4})(\d)/, '$1-$2');
    }
    
    return value;
  }

  // Aplicar máscara ao carregar a página
  document.addEventListener('DOMContentLoaded', function() {
    const cnpjInput = document.getElementById('cnpj');
    if (cnpjInput && cnpjInput.value) {
      cnpjInput.value = formatCNPJ(cnpjInput.value);
    }
  });

  // Aplicar máscara ao digitar
  document.getElementById('cnpj').addEventListener('input', function(e) {
    e.target.value = formatCNPJ(e.target.value);
  });
</script>
@endpush
