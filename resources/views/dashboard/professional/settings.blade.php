@extends('layouts.dashboard-professional')

@section('title', 'Configurações - VagaPet')

@section('content')
  <!-- Settings Section -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Configurações de conta</h3>
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

      <ul class="accordion-box">
        <!-- Minha Conta -->
        <li class="accordion block active-block">
          <div class="acc-btn active">Minha Conta <span class="icon flaticon-add"></span></div>
          <div class="acc-content current">
            <div class="content">
              <!-- Formulário de E-mail -->
              <form method="POST" action="{{ route('professional.update-settings') }}" id="email-form">
                @csrf
                <input type="hidden" name="type" value="email">
                <div class="form-group pb-4 border-bottom">
                  <label>E-mail cadastrado</label>
                  <div class="d-flex">
                    <input type="email" name="email" class="form-control rounded-end-0" value="{{ Auth::user()->email }}" required>
                    <button type="submit" class="btn btn-outline-primary rounded-start-0"><span class="la la-pencil"></span></button>
                  </div>
                </div>
              </form>

              <!-- Formulário de Telefone -->
              <form method="POST" action="{{ route('professional.update-settings') }}" id="phone-form">
                @csrf
                <input type="hidden" name="type" value="phone">
                <div class="form-group pt-4 pb-4 border-bottom">
                  <label>Telefone / WhatsApp</label>
                  <div class="d-flex">
                    <input type="text" name="phone" id="phone" class="form-control rounded-end-0" value="{{ $profile->phone ?? '' }}" placeholder="(11) 98765-4321">
                    <button type="submit" class="btn btn-outline-primary rounded-start-0"><span class="la la-pencil"></span></button>
                  </div>
                </div>
              </form>

              <!-- Formulário de Senha -->
              <form method="POST" action="{{ route('professional.update-settings') }}" id="password-form">
                @csrf
                <input type="hidden" name="type" value="password">
                <div class="form-group pt-4">
                  <label>Alterar Senha</label>
                  <div class="form-group">
                    <label>Senha Atual</label>
                    <input type="password" name="current_password" class="form-control" placeholder="Digite sua senha atual" required>
                  </div>
                  <div class="form-group">
                    <label>Nova Senha</label>
                    <input type="password" name="password" class="form-control" placeholder="Digite a nova senha" required>
                  </div>
                  <div class="form-group">
                    <label>Confirmar Nova Senha</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirme a nova senha" required>
                  </div>
                  <button type="submit" class="btn btn-primary"><span class="la la-pencil"></span> Alterar Senha</button>
                </div>
              </form>
            </div>
          </div>
        </li>

        <!-- Perfil & Privacidade -->
        <li class="accordion block">
          <div class="acc-btn">Perfil & Privacidade <span class="icon flaticon-add"></span></div>
          <div class="acc-content">
            <div class="content">
              <form method="POST" action="{{ route('professional.update-privacy-settings') }}" id="privacy-form">
                @csrf
                <div class="form-group">
                  <label>Visibilidade do perfil</label><br>
                  <!-- Switchbox Outer -->
                  <div class="switchbox-outer margin-top-10 mb-30 border-bottom">
                    <ul class="switchbox">
                      <li>
                        <label class="switch">
                          <input type="checkbox" name="is_public" value="1" {{ Auth::user()->is_active ? 'checked' : '' }}>
                          <span class="slider round"></span>
                          <span class="title">Perfil público</span>
                        </label>
                      </li>
                      <li>
                        <label class="switch">
                          <input type="checkbox" name="show_in_search" value="1" checked>
                          <span class="slider round"></span>
                          <span class="title">Aparecer nas buscas</span>
                        </label>
                      </li>
                    </ul>
                  </div>
                  <button type="submit" class="btn btn-primary">Salvar Preferências</button>
                </div>
              </form>

              <div class="form-group border-bottom mt-4">
                @php
                  $filledFields = 0;
                  $totalFields = 15;
                  if ($profile->first_name) $filledFields++;
                  if ($profile->last_name) $filledFields++;
                  if ($profile->phone) $filledFields++;
                  if ($profile->birth_date) $filledFields++;
                  if ($profile->gender) $filledFields++;
                  if ($profile->address) $filledFields++;
                  if ($profile->city) $filledFields++;
                  if ($profile->state) $filledFields++;
                  if ($profile->zip_code) $filledFields++;
                  if ($profile->bio) $filledFields++;
                  if ($profile->title) $filledFields++;
                  if ($profile->experience_level) $filledFields++;
                  if ($profile->areas && count($profile->areas) > 0) $filledFields++;
                  if ($profile->skills && count($profile->skills) > 0) $filledFields++;
                  if ($profile->photo) $filledFields++;
                  $percentage = round(($filledFields / $totalFields) * 100);
                @endphp
                <label>Status de Preenchimento: <strong>{{ $percentage }}%</strong></label>
                <div class="progress">
                  <div class="progress-bar" style="width: {{ $percentage }}%;"></div>
                </div>
                <a href="{{ route('professional.profile') }}" class="btn btn-link mt-2 mb-30">Completar Perfil</a>
              </div>
            </div>
          </div>
        </li>

        <!-- Notificações -->
        <li class="accordion block">
          <div class="acc-btn">Notificações <span class="icon flaticon-add"></span></div>
          <div class="acc-content">
            <div class="content">
              <form method="POST" action="{{ route('professional.update-notification-settings') }}" id="notification-form">
                @csrf
                <div class="form-group">
                  <label>Preferências de notificação</label><br>
                  <div class="switchbox-outer margin-top-10">
                    <ul class="switchbox">
                      <li>
                        <label class="switch">
                          <input type="checkbox" name="email_notifications" value="1" checked>
                          <span class="slider round"></span>
                          <span class="title">E-mail</span>
                        </label>
                      </li>
                      <li>
                        <label class="switch">
                          <input type="checkbox" name="whatsapp_notifications" value="1" checked>
                          <span class="slider round"></span>
                          <span class="title">WhatsApp</span>
                        </label>
                      </li>
                      <li>
                        <label class="switch">
                          <input type="checkbox" name="sms_notifications" value="1">
                          <span class="slider round"></span>
                          <span class="title">SMS</span>
                        </label>
                      </li>
                    </ul>
                  </div>
                  <button type="submit" class="btn btn-primary mt-3">Salvar Preferências</button>
                </div>
              </form>
            </div>
          </div>
        </li>

        <!-- Privacidade -->
        <li class="accordion block">
          <div class="acc-btn">Privacidade <span class="icon flaticon-add"></span></div>
          <div class="acc-content">
            <div class="content">
              <form method="POST" action="{{ route('professional.update-privacy-settings') }}" id="privacy-settings-form">
                @csrf
                <div class="form-group">
                  <label>Configurações de privacidade</label><br>
                  <div class="switchbox-outer margin-top-10">
                    <ul class="switchbox">
                      <li>
                        <label class="switch">
                          <input type="checkbox" name="allow_direct_contact" value="1" checked>
                          <span class="slider round"></span>
                          <span class="title">Permitir contato direto</span>
                        </label>
                      </li>
                      <li>
                        <label class="switch">
                          <input type="checkbox" name="show_current_salary" value="1">
                          <span class="slider round"></span>
                          <span class="title">Mostrar salário atual</span>
                        </label>
                      </li>
                    </ul>
                  </div>
                  <button type="submit" class="btn btn-primary mt-3">Salvar Configurações</button>
                </div>
              </form>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </section>
@endsection

@push('scripts')
@include('layouts.partials.scripts')
<script>
  // Máscara de telefone
  document.getElementById('phone')?.addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length <= 11) {
      if (value.length <= 10) {
        value = value.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, '($1) $2-$3');
      } else {
        value = value.replace(/^(\d{2})(\d{5})(\d{0,4}).*/, '($1) $2-$3');
      }
      e.target.value = value;
    }
  });
</script>
@endpush
