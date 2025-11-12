@extends('layouts.dashboard-professional')

@section('title', 'Meu Perfil - VagaPet')

@section('content')
  <!-- Painel (Meu Perfil) -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Meu Perfil</h3>
        <div class="text">Pronto para voltar ao trabalho?</div>
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
                <form class="default-form" method="POST" action="{{ route('professional.profile.update') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <!-- Foto de Perfil -->
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Foto de Perfil</label>
                      @if($profile->photo)
                        <div class="mb-3">
                          <img src="{{ url('storage/' . $profile->photo) }}" alt="Foto de Perfil" style="max-width: 200px; max-height: 200px; border: 1px solid #ddd; padding: 10px; border-radius: 8px;">
                        </div>
                      @endif
                      <div class="uploading-outer">
                        <div class="uploadButton">
                          <input class="uploadButton-input" type="file" name="photo" accept="image/*" id="upload-photo" />
                          <label class="uploadButton-button ripple-effect" for="upload-photo">{{ $profile->photo ? 'Alterar Foto' : 'Subir Foto' }}</label>
                          <span class="uploadButton-file-name"></span>
                        </div>
                        <div class="text">Tamanho máximo: 1MB. Formatos: .jpg e .png</div>
                      </div>
                    </div>

                    <!-- Nome -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Nome*</label>
                      <input type="text" name="first_name" placeholder="Maria" value="{{ old('first_name', $profile->first_name) }}" required>
                    </div>

                    <!-- Sobrenome -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Sobrenome*</label>
                      <input type="text" name="last_name" placeholder="da Silva" value="{{ old('last_name', $profile->last_name) }}" required>
                    </div>

                    <!-- Título Profissional -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Título Profissional*</label>
                      <input type="text" name="title" placeholder="Groomer Especialista em Banho e Tosa" value="{{ old('title', $profile->title) }}">
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
                      <label>Site Pessoal</label>
                      <input type="text" name="website" placeholder="www.meuservicos.com.br" value="{{ old('website', $profile->website) }}">
                    </div>

                    <!-- Experiência -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Experiência profissional</label>
                      <select class="chosen-select" name="experience_level">
                        <option value="">Selecione</option>
                        <option value="estagio" {{ old('experience_level', $profile->experience_level) == 'estagio' ? 'selected' : '' }}>Estágio (estudante)</option>
                        <option value="junior" {{ old('experience_level', $profile->experience_level) == 'junior' ? 'selected' : '' }}>Junior (até 2 anos)</option>
                        <option value="pleno" {{ old('experience_level', $profile->experience_level) == 'pleno' ? 'selected' : '' }}>Pleno (de 3 a 5 anos)</option>
                        <option value="senior" {{ old('experience_level', $profile->experience_level) == 'senior' ? 'selected' : '' }}>Senior (mais de 5 anos)</option>
                      </select>
                    </div>

                    <!-- Gênero -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Gênero</label>
                      <select class="chosen-select" name="gender">
                        <option value="">Selecione</option>
                        <option value="male" {{ old('gender', $profile->gender) == 'male' ? 'selected' : '' }}>Masculino</option>
                        <option value="female" {{ old('gender', $profile->gender) == 'female' ? 'selected' : '' }}>Feminino</option>
                        <option value="other" {{ old('gender', $profile->gender) == 'other' ? 'selected' : '' }}>Outro</option>
                      </select>
                    </div>

                    <!-- Área de trabalho -->
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Área de trabalho*</label>
                      <p>Você pode incluir mais de uma opção (separadas por vírgula)</p>
                      <input type="text" name="areas" placeholder="Ex: Banho & Tosa, Recepção, Vendas" value="{{ old('areas', is_array($profile->areas) ? implode(', ', $profile->areas) : $profile->areas) }}">
                    </div>

                    <!-- Data de Nascimento -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Data de Nascimento</label>
                      <input type="date" name="birth_date" value="{{ old('birth_date', $profile->birth_date ? $profile->birth_date->format('Y-m-d') : '') }}">
                    </div>

                    <!-- Descrição/Bio -->
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Descrição</label>
                      <textarea name="bio" placeholder="Fale sobre sua experiência com animais, aptidões em pet shops, serviços oferecidos (banho, tosa, recepção, etc.) e qualquer outro detalhe relevante.">{{ old('bio', $profile->bio) }}</textarea>
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

          <!-- Ls widget (Seção Redes Sociais) -->
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Redes Sociais</h4>
                <p>Inclua suas redes sociais se quiser que outros vejam seu perfil e possam te seguir.</p>
              </div>

              <div class="widget-content">
                <form class="default-form" method="POST" action="{{ route('professional.profile.update') }}">
                  @csrf
                  <!-- Campos obrigatórios ocultos -->
                  <input type="hidden" name="first_name" value="{{ $profile->first_name }}">
                  <input type="hidden" name="last_name" value="{{ $profile->last_name }}">
                  <input type="hidden" name="city" value="{{ $profile->city }}">
                  
                  <div class="row">
                    <!-- Facebook -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Facebook</label>
                      <input type="text" name="facebook" placeholder="www.facebook.com/MeuPerfil" value="{{ old('facebook', $profile->facebook) }}">
                    </div>

                    <!-- LinkedIn -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>LinkedIn</label>
                      <input type="text" name="linkedin" placeholder="www.linkedin.com/in/meuperfil" value="{{ old('linkedin', $profile->linkedin) }}">
                    </div>

                    <!-- Instagram -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Instagram</label>
                      <input type="text" name="instagram" placeholder="instagram.com/meuperfil" value="{{ old('instagram', $profile->instagram) }}">
                    </div>

                    <!-- Site -->
                    <div class="form-group col-lg-6 col-md-12">
                      <label>Site Pessoal</label>
                      <input type="text" name="website" placeholder="www.meuservicos.com.br" value="{{ old('website', $profile->website) }}">
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

          <!-- Ls widget (Seção Localização) -->
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Localização</h4>
                <p>Só o bairro e cidade ficarão visíveis na plataforma para ajudar na busca por vagas relevantes.</p>
              </div>

              <div class="widget-content">
                <form class="default-form" method="POST" action="{{ route('professional.profile.update') }}">
                  @csrf
                  <!-- Campos obrigatórios ocultos -->
                  <input type="hidden" name="first_name" value="{{ $profile->first_name }}">
                  <input type="hidden" name="last_name" value="{{ $profile->last_name }}">
                  
                  <div class="row">
                    <!-- Endereço -->
                    <div class="form-group col-lg-12 col-md-12">
                      <label>Endereço Completo*</label>
                      <input type="text" name="address" placeholder="Rua das Flores, 123" value="{{ old('address', $profile->address) }}">
                    </div>

                    <!-- Bairro -->
                    <div class="form-group col-lg-4 col-md-12">
                      <label>Bairro</label>
                      <input type="text" name="neighborhood" placeholder="Vila Clementina" value="{{ old('neighborhood', $profile->neighborhood) }}">
                    </div>

                    <!-- Cidade -->
                    <div class="form-group col-lg-4 col-md-12">
                      <label>Cidade*</label>
                      <input type="text" name="city" placeholder="São Paulo" value="{{ old('city', $profile->city) }}">
                    </div>

                    <!-- Estado -->
                    <div class="form-group col-lg-4 col-md-12">
                      <label>Estado (UF)*</label>
                      <input type="text" name="state" placeholder="SP" maxlength="2" value="{{ old('state', $profile->state) }}">
                    </div>

                    <!-- CEP -->
                    <div class="form-group col-lg-12 col-md-12">
                      <label>CEP</label>
                      <input type="text" name="zip_code" placeholder="01234-567" value="{{ old('zip_code', $profile->zip_code) }}">
                    </div>

                    <!-- Latitude/Longitude (ocultos) -->
                    <input type="hidden" name="latitude" value="{{ old('latitude', $profile->latitude) }}">
                    <input type="hidden" name="longitude" value="{{ old('longitude', $profile->longitude) }}">

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
@endpush
