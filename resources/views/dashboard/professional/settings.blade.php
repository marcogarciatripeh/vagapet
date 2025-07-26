@extends('layouts.app')

@section('title', 'Configurações - VagaPet')

@section('content')
<div class="page-wrapper dashboard">

  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Main Header-->
  @include('layouts.partials.header-professional')
  <!-- End Main Header -->

  <!-- Painel de Configurações -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Configurações</h3>
        <div class="text">Gerencie suas preferências e configurações da conta.</div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Configurações da Conta</h4>
              </div>

              <div class="widget-content">
                <form class="default-form" action="{{ route('professional.settings.update') }}" method="POST">
                  @csrf
                  <div class="row">

                    <!-- Notificações por E-mail -->
                    <div class="form-group col-lg-12 col-md-12">
                      <div class="field-outer">
                        <div class="input-group checkboxes square">
                          <input type="checkbox" name="email_notifications" id="email_notifications" checked>
                          <label for="email_notifications" class="remember"><span class="custom-checkbox"></span> Receber notificações por e-mail</label>
                        </div>
                      </div>
                    </div>

                    <!-- Notificações por WhatsApp -->
                    <div class="form-group col-lg-12 col-md-12">
                      <div class="field-outer">
                        <div class="input-group checkboxes square">
                          <input type="checkbox" name="whatsapp_notifications" id="whatsapp_notifications">
                          <label for="whatsapp_notifications" class="remember"><span class="custom-checkbox"></span> Receber notificações por WhatsApp</label>
                        </div>
                      </div>
                    </div>

                    <!-- Perfil Público -->
                    <div class="form-group col-lg-12 col-md-12">
                      <div class="field-outer">
                        <div class="input-group checkboxes square">
                          <input type="checkbox" name="public_profile" id="public_profile" checked>
                          <label for="public_profile" class="remember"><span class="custom-checkbox"></span> Tornar perfil público para empresas</label>
                        </div>
                      </div>
                    </div>

                    <!-- Botão Salvar -->
                    <div class="form-group col-lg-12 col-md-12">
                      <button class="theme-btn btn-style-one">Salvar Configurações</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Painel de Configurações -->

  <!-- Rodapé -->
  @include('layouts.partials.copyright')
  <!-- Fim do Rodapé -->

</div>
<!-- Fim Page Wrapper -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush
