@extends('layouts.dashboard-professional')

@section('title', 'Configurações - VagaPet')

@section('content')
  <!-- Settings Section -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Configurações de conta</h3>
      </div>

      <ul class="accordion-box">
        <!-- Minha Conta -->
        <li class="accordion block active-block">
          <div class="acc-btn active">Minha Conta <span class="icon flaticon-add"></span></div>
          <div class="acc-content current">
            <div class="content">
              <form>
                <div class="form-group pb-4 border-bottom">
                  <label>E-mail cadastrado</label>
                  <div class="d-flex">
                    <input type="email" class="form-control rounded-end-0" value="usuario@exemplo.com" readonly>
                    <button class="btn btn-outline-primary rounded-start-0"><span class="la la-pencil"></span></button>
                  </div>
                </div>
                <div class="form-group pt-4 pb-4 border-bottom">
                  <label>Telefone / WhatsApp</label>
                  <div class="d-flex">
                    <input type="text" class="form-control rounded-end-0" value="(11) 91234-5678" readonly>
                    <button class="btn btn-outline-primary rounded-start-0"><span class="la la-pencil"></span></button>
                  </div>
                </div>
                <div class="form-group pt-4">
                  <label>Senha</label>
                  <div class="d-flex">
                    <input type="password" class="form-control rounded-end-0" value="********" readonly>
                    <button class="btn btn-outline-primary rounded-start-0"><span class="la la-pencil"></span></button>
                  </div>
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
              <form>
                <div class="form-group">
                  <label>Visibilidade do perfil</label><br>
                  <!-- Switchbox Outer -->
                  <div class="switchbox-outer margin-top-10 mb-30 border-bottom">
                    <ul class="switchbox">
                      <li>
                        <label class="switch">
                          <input type="checkbox">
                          <span class="slider round"></span>
                          <span class="title">Perfil público</span>
                        </label>
                      </li>
                      <li>
                        <label class="switch">
                          <input type="checkbox" checked>
                          <span class="slider round"></span>
                          <span class="title">Aparecer nas buscas</span>
                        </label>
                      </li>
                    </ul>
                  </div>
                </div>

                <div class="form-group border-bottom">
                  <label>Status de Preenchimento: <strong>80%</strong></label>
                  <div class="progress">
                    <div class="progress-bar" style="width: 80%;"></div>
                  </div>
                  <a href="{{ route('professional.profile') }}" class="btn btn-link mt-2 mb-30">Completar Perfil</a>
                </div>
              </form>
            </div>
          </div>
        </li>

        <!-- Notificações -->
        <li class="accordion block">
          <div class="acc-btn">Notificações <span class="icon flaticon-add"></span></div>
          <div class="acc-content">
            <div class="content">
              <form>
                <div class="form-group">
                  <label>Preferências de notificação</label><br>
                  <div class="switchbox-outer margin-top-10">
                    <ul class="switchbox">
                      <li>
                        <label class="switch">
                          <input type="checkbox" checked>
                          <span class="slider round"></span>
                          <span class="title">E-mail</span>
                        </label>
                      </li>
                      <li>
                        <label class="switch">
                          <input type="checkbox" checked>
                          <span class="slider round"></span>
                          <span class="title">WhatsApp</span>
                        </label>
                      </li>
                      <li>
                        <label class="switch">
                          <input type="checkbox">
                          <span class="slider round"></span>
                          <span class="title">SMS</span>
                        </label>
                      </li>
                    </ul>
                  </div>
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
              <form>
                <div class="form-group">
                  <label>Configurações de privacidade</label><br>
                  <div class="switchbox-outer margin-top-10">
                    <ul class="switchbox">
                      <li>
                        <label class="switch">
                          <input type="checkbox" checked>
                          <span class="slider round"></span>
                          <span class="title">Permitir contato direto</span>
                        </label>
                      </li>
                      <li>
                        <label class="switch">
                          <input type="checkbox">
                          <span class="slider round"></span>
                          <span class="title">Mostrar salário atual</span>
                        </label>
                      </li>
                    </ul>
                  </div>
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
@endpush

