@extends('layouts.dashboard')

@section('title', 'Gerenciar Vagas - VagaPet')

@section('content')
  <!-- Painel de Gerenciar Vagas -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="upper-title-box">
        <h3>Gerenciar Vagas</h3>
        <div class="text">Pronto para voltar ao trabalho?</div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <!-- Ls widget -->
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Minhas Vagas Publicadas</h4>
                <div class="chosen-outer">
                  <select class="chosen-select">
                    <option>Últimos 6 meses</option>
                    <option>Últimos 12 meses</option>
                    <option>Últimos 16 meses</option>
                    <option>Últimos 24 meses</option>
                    <option>Últimos 5 anos</option>
                  </select>
                </div>
              </div>

              <div class="widget-content">
                <div class="table-outer row">
                  <!-- Exemplo 1: Veterinário -->
                  <div class="job-block col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-box">
                      <span class="badge text-bg-success text-white rounded-start-2" style="position:absolute; bottom:0; right:0;">Ativa</span>
                      <div class="content">
                        <span class="company-logo">
                          <img src="{{ asset('images/resource/company-logo/1-2.png') }}" alt="">
                        </span>

                        <h4><a href="#">Veterinário(a) – Amigão PetShop</a></h4>

                        <ul class="job-info">
                          <li><span class="icon flaticon-briefcase"></span> 14 candidaturas</li>
                          <li><span class="icon flaticon-map-locator"></span> São Paulo, SP</li>
                          <li><span class="icon flaticon-clock-3"></span> 10 jan 2023</li>
                        </ul>
                        <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
                        <div class="option-box pb-4">
                          <ul class="option-list">
                            <li class="ml-0"><button data-text="Ver vaga"><span class="la la-eye"></span></button></li>
                            <li><button data-text="Editar vaga"><span class="la la-pencil"></span></button></li>
                            <li><button data-text="Apagar vaga"><span class="la la-trash"></span></button></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Exemplo 2: Banho e Tosa -->
                  <div class="job-block col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-box">
                      <span class="badge text-bg-warning text-white rounded-start-2" style="position:absolute; bottom:0; right:0;">Em análise</span>
                      <div class="content">
                        <span class="company-logo"><img src="{{ asset('images/resource/company-logo/1-2.png') }}" alt=""></span>
                        <h4><a href="#">Groomer / Banho e Tosa – Amigão PetShop</a></h4>
                        <ul class="job-info">
                          <li><span class="icon flaticon-briefcase"></span> 0 candidaturas</li>
                          <li><span class="icon flaticon-map-locator"></span> São Paulo, SP</li>
                          <li><span class="icon flaticon-clock-3"></span> 02 fev 2023</li>
                        </ul>
                        <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>

                        <div class="option-box pb-4">
                          <ul class="option-list">
                            <li class="ml-0"><button data-text="Ver vaga"><span class="la la-eye"></span></button></li>
                            <li><button data-text="Editar vaga"><span class="la la-pencil"></span></button></li>
                            <li><button data-text="Apagar vaga"><span class="la la-trash"></span></button></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Exemplo 3: Recepcionista -->
                  <div class="job-block col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-box">
                      <span class="badge text-bg-danger text-white rounded-start-2" style="position:absolute; bottom:0; right:0;">Não publicada</span>
                      <div class="content">
                        <span class="company-logo"><img src="{{ asset('images/resource/company-logo/1-2.png') }}" alt=""></span>
                        <h4><a href="#">Recepcionista – Amigão PetShop</a></h4>
                        <ul class="job-info">
                          <li><span class="icon flaticon-briefcase"></span> 0 candidaturas</li>
                          <li><span class="icon flaticon-map-locator"></span> São Paulo, SP</li>
                          <li><span class="icon flaticon-clock-3"></span> 15 mar 2023</li>
                        </ul>
                        <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>

                        <div class="option-box pb-4">
                          <ul class="option-list">
                            <li class="ml-0"><button data-text="Ver vaga"><span class="la la-eye"></span></button></li>
                            <li><button data-text="Editar vaga"><span class="la la-pencil"></span></button></li>
                            <li><button data-text="Apagar vaga"><span class="la la-trash"></span></button></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Exemplo 4: Dog Walker -->
                  <div class="job-block col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-box">
                      <span class="badge text-bg-success text-white rounded-start-2" style="position:absolute; bottom:0; right:0;">Ativa</span>
                      <div class="content">
                        <span class="company-logo"><img src="{{ asset('images/resource/company-logo/1-2.png') }}" alt=""></span>
                        <h4><a href="#">Dog Walker / Pet Sitter – Amigão PetShop</a></h4>
                        <ul class="job-info">
                          <li><span class="icon flaticon-briefcase"></span> 7 candidaturas</li>
                          <li><span class="icon flaticon-map-locator"></span> São Paulo, SP</li>
                          <li><span class="icon flaticon-clock-3"></span> 20 mar 2023</li>
                        </ul>
                        <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>

                        <div class="option-box pb-4">
                          <ul class="option-list">
                            <li class="ml-0"><button data-text="Ver vaga"><span class="la la-eye"></span></button></li>
                            <li><button data-text="Editar vaga"><span class="la la-pencil"></span></button></li>
                            <li><button data-text="Apagar vaga"><span class="la la-trash"></span></button></li>
                          </ul>
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
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush
