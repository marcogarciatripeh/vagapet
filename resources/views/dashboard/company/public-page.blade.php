@extends('layouts.app')

@section('title', 'Página Pública da Empresa - VagaPet')

@section('content')
<div class="page-wrapper dashboard">

  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Main Header-->
  @include('layouts.partials.header-company')
  <!-- End Main Header -->

  <!-- Página Pública da Empresa -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Página Pública da Empresa</h3>
        <div class="text">Como os profissionais veem sua empresa.</div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Visualização Pública</h4>
              </div>

              <div class="widget-content">
                <div class="company-preview">
                  <div class="company-header" style="display: flex; align-items: center; margin-bottom: 30px; padding: 20px; background: #f8f9fa; border-radius: 10px;">
                    <div class="company-logo" style="margin-right: 20px;">
                      <img src="{{ asset('images/resource/company-logo/1-1.png') }}" alt="Logo da Empresa" style="width: 80px; height: 80px; object-fit: cover; border-radius: 10px;">
                    </div>
                    <div class="company-info">
                      <h3 style="margin: 0 0 10px 0; color: #333;">Dogs, Cats and Love</h3>
                      <p class="title" style="margin: 0 0 5px 0; color: #666; font-weight: 500;">Pet Shop e Clínica Veterinária</p>
                      <p class="location" style="margin: 0; color: #888;"><i class="icon flaticon-map-locator"></i> Vila Clementino, São Paulo, SP</p>
                    </div>
                  </div>

                  <div class="company-details">
                    <div style="margin-bottom: 30px;">
                      <h4 style="color: #333; margin-bottom: 15px;">Sobre a Empresa</h4>
                      <p style="line-height: 1.6; color: #666;">Empresa especializada em produtos e serviços para pets, com mais de 10 anos de experiência no mercado. Oferecemos banho e tosa, consultas veterinárias e produtos de qualidade.</p>
                    </div>

                    <div style="margin-bottom: 30px;">
                      <h4 style="color: #333; margin-bottom: 15px;">Serviços Oferecidos</h4>
                      <ul style="list-style: none; padding: 0;">
                        <li style="padding: 8px 0; border-bottom: 1px solid #eee;"><i class="la la-check" style="color: #28a745; margin-right: 10px;"></i>Banho e Tosa</li>
                        <li style="padding: 8px 0; border-bottom: 1px solid #eee;"><i class="la la-check" style="color: #28a745; margin-right: 10px;"></i>Consulta Veterinária</li>
                        <li style="padding: 8px 0; border-bottom: 1px solid #eee;"><i class="la la-check" style="color: #28a745; margin-right: 10px;"></i>Venda de Produtos Pet</li>
                        <li style="padding: 8px 0;"><i class="la la-check" style="color: #28a745; margin-right: 10px;"></i>Hotelaria para Pets</li>
                      </ul>
                    </div>

                    <div>
                      <h4 style="color: #333; margin-bottom: 15px;">Vagas Ativas</h4>
                      <div class="active-jobs">
                        <div class="job-item" style="background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 20px; margin-bottom: 15px;">
                          <h5 style="margin: 0 0 10px 0; color: #333;">Atendente de Banho e Tosa</h5>
                          <p style="margin: 0; color: #666;"><i class="la la-money-bill" style="color: #28a745; margin-right: 5px;"></i>R$ 1.800 - R$ 2.200 | <i class="la la-map-marker" style="color: #007bff; margin-right: 5px;"></i>São Paulo, SP</p>
                        </div>
                        <div class="job-item" style="background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 20px; margin-bottom: 15px;">
                          <h5 style="margin: 0 0 10px 0; color: #333;">Vendedor de Produtos Pet</h5>
                          <p style="margin: 0; color: #666;"><i class="la la-money-bill" style="color: #28a745; margin-right: 5px;"></i>R$ 1.500 - R$ 1.800 | <i class="la la-map-marker" style="color: #007bff; margin-right: 5px;"></i>São Paulo, SP</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Página Pública da Empresa -->

  <!-- Rodapé -->
  @include('layouts.partials.copyright')
  <!-- Fim do Rodapé -->

</div>
<!-- Fim Page Wrapper -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush
