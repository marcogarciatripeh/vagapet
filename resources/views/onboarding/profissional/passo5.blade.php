@extends('layouts.app')

@section('content')
<div class="page-wrapper">
  <!-- Preloader -->
  <div class="preloader"></div>
  <!-- Header Span -->
  <span class="header-span"></span>
  <!-- Cabeçalho Principal -->
  @include('layouts.partials.header-onboarding')
  <!-- Fim do Cabeçalho Principal -->
  <section class="user-dashboard row justify-content-center">
    <div class="dashboard-outer col-lg-10 mt-30">
      <div class="row">
        <div class="col-lg-12">
          <div class="ls-widget">
            <div class="tabs-box">
                <div class="widget-title">
                  <h4>Cadastro</h4>
                </div>
              <div class="widget-content">
                <div class="bar-item style-two">
                  <div class="skill-bar">
                    <div class="bar-inner">
                      <div class="bar progress-line" data-width="80">
                        <div class="skill-percentage">
                          <div class="count-box"><span class="count-text" data-speed="2000" data-stop="80">0</span>% completo</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="ls-widget">
                    <div class="tabs-box">
                      <div class="widget-title">
                        <h4>Experiência e formação</h4>
                      </div>
                      <div class="widget-content">
                        <form class="default-form" method="POST" action="{{ route('onboarding.profissional.passo5.post') }}">
                          @csrf
                          <div class="row">
                            <div class="resume-outer theme-blue">
                              <div class="upper-title">
                                <h4>Experiência profissional</h4>
                                <button class="add-info-btn">
                                  <span class="icon flaticon-plus"></span> Adicionar Experiência
                                </button>
                              </div>
                              <!-- Exemplo de Experiência 1 -->
                              <div class="resume-block">
                                <div class="inner">
                                  <span class="name">P</span>
                                  <div class="title-box">
                                    <div class="info-box">
                                      <h3>Groomer Sênior</h3>
                                      <span>Pet4U</span>
                                    </div>
                                    <div class="edit-box">
                                      <span class="year">2022 - Atual</span>
                                      <div class="edit-btns">
                                        <button><span class="la la-pencil"></span></button>
                                        <button><span class="la la-trash"></span></button>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="text">Responsável por cuidar da aparência dos pets, incluindo tosa higiênica e estilos avançados, além de garantir o bem-estar dos animais durante o processo.</div>
                                </div>
                              </div>
                              <!-- Exemplo de Experiência 2 -->
                              <div class="resume-block">
                                <div class="inner">
                                  <span class="name">A</span>
                                  <div class="title-box">
                                    <div class="info-box">
                                      <h3>Auxiliar Veterinário</h3>
                                      <span>Clínica Happy Pets</span>
                                    </div>
                                    <div class="edit-box">
                                      <span class="year">2020 - 2021</span>
                                      <div class="edit-btns">
                                        <button><span class="la la-pencil"></span></button>
                                        <button><span class="la la-trash"></span></button>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="text">Auxiliava o veterinário em procedimentos, monitorava animais em recuperação e orientava clientes sobre cuidados pós-consulta.</div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-lg-6 col-md-6">
                              <a href="{{ route('onboarding.profissional.passo4') }}" class="theme-btn btn-style-one">Voltar</a>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 text-right">
                              <button class="theme-btn btn-style-one pull-right" type="submit">Próximo</button>
                            </div>
                          </div>
                        </form>
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
  @include('layouts.partials.copyright')
</div>
@endsection
@push('scripts')
@include('layouts.partials.scripts')
@endpush
