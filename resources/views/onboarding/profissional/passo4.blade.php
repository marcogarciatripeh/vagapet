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
                      <div class="bar progress-line" data-width="60">
                        <div class="skill-percentage">
                          <div class="count-box"><span class="count-text" data-speed="2000" data-stop="60">0</span>% completo</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <form class="default-form" method="POST" action="{{ route('onboarding.profissional.passo4.post') }}">
                  @csrf
                  <div class="row">
                    <div class="ls-widget">
                      <div class="tabs-box">
                        <div class="widget-title">
                          <h4>Experiência e formação</h4>
                        </div>
                        <div class="widget-content">
                          <div class="row">
                            <div class="resume-outer">
                              <div class="upper-title">
                                <h4>Formação profissional</h4>
                                <button class="add-info-btn">
                                  <span class="icon flaticon-plus"></span> Adicionar Formação
                                </button>
                              </div>
                              <!-- Exemplo de Formação 1 -->
                              <div class="resume-block">
                                <div class="inner">
                                  <span class="name">C</span>
                                  <div class="title-box">
                                    <div class="info-box">
                                      <h3>Curso de Auxiliar Veterinário</h3>
                                      <span>Instituto PetCare</span>
                                    </div>
                                    <div class="edit-box">
                                      <span class="year">2021 - 2022</span>
                                      <div class="edit-btns">
                                        <button><span class="la la-pencil"></span></button>
                                        <button><span class="la la-trash"></span></button>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="text">Recebi treinamento prático e teórico em auxílio a veterinários, tratamento de animais domésticos e cuidados específicos pós-operatórios.</div>
                                </div>
                              </div>
                              <!-- Exemplo de Formação 2 -->
                              <div class="resume-block">
                                <div class="inner">
                                  <span class="name">U</span>
                                  <div class="title-box">
                                    <div class="info-box">
                                      <h3>Administração de Pet Shop</h3>
                                      <span>Universidade Animal</span>
                                    </div>
                                    <div class="edit-box">
                                      <span class="year">2019 - 2021</span>
                                      <div class="edit-btns">
                                        <button><span class="la la-pencil"></span></button>
                                        <button><span class="la la-trash"></span></button>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="text">Especialização em gestão de estoque, relacionamento com clientes e cuidados gerais de um pet shop.</div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-6 col-md-6">
                      <a href="{{ route('onboarding.profissional.passo3') }}" class="theme-btn btn-style-one">Voltar</a>
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
  </section>
  @include('layouts.partials.copyright')
</div>
@endsection
@push('scripts')
@include('layouts.partials.scripts')
@endpush
