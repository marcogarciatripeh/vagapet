@extends('layouts.app')

@section('title', 'Formação Profissional - VagaPet')

@section('content')
<div class="page-wrapper">

  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Cabeçalho Principal -->
  <header class="main-header">
    <div class="container-fluid">
      <div class="main-box">
        <div class="nav-outer">
          <!-- Logo -->
          <div class="logo-box">
            <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('images/logo-junto.svg') }}" alt="Junto.pet" title="Junto.pet"></a></div>
          </div>
        </div>

        <div class="outer-box">
          <!-- Placeholder for alignment -->
        </div>
      </div>
    </div>

    <!-- Mobile Header -->
    <div class="mobile-header">
      <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('images/logo-junto.svg') }}" alt="Junto.pet" title="Junto.pet"></a></div>
    </div>

    <!-- Mobile Nav -->
    <div id="nav-mobile"></div>
  </header>
  <!-- Fim do Cabeçalho Principal -->

  <!-- Painel (Meu Perfil) -->
  <section class="user-dashboard row justify-content-center">
    <div class="dashboard-outer col-lg-10 mt-30 mb-50">

      <div class="row">
        <div class="col-lg-12">
          <!-- Ls widget (Seção de Informações Básicas) -->
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Formação Profissional</h4>
              </div>

              <div class="widget-content">

                <!--Skill Item-->
                <div class="bar-item style-two">
                  <div class="skill-bar">
                    <div class="bar-inner">
                      <div class="bar progress-line" data-width="42">
                        <div class="skill-percentage">
                          <div class="count-box"><span class="count-text" data-speed="2000" data-stop="42">0</span>% completo</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <form class="default-form" action="{{ route('onboarding.step4.professional.process') }}" method="post">
                  @csrf
                  <div class="row">

                    <!-- Ls widget (Seção Formação Profissional) -->
                    <div class="ls-widget">
                      <div class="tabs-box">
                        <div class="widget-title">
                          <h4>Formação profissional</h4>
                          <p></p>
                        </div>

                        <div class="widget-content">
                          <div class="row">

                            <!-- Seção Formação Acadêmica -->
                            <div class="resume-outer">
                              <div class="upper-title">
                                <h4>Formação profissional</h4>
                                <button type="button" class="add-info-btn" onclick="addFormation()">
                                  <span class="icon flaticon-plus"></span> Adicionar Formação
                                </button>
                              </div>

                              <div id="formations-container">
                                <!-- Formações serão adicionadas aqui dinamicamente -->
                              </div>
                            </div>

                          </div>

                          <!-- Área botão -->
                          <div class="row">
                            <div class="form-group col-lg-6 col-md-12">
                              <a href="{{ route('onboarding.step3.professional') }}" class="theme-btn btn-style-one text-white">Voltar</a>
                            </div>
                            <div class="form-group col-lg-6 col-md-12 d-flex justify-content-end">
                              <button class="theme-btn btn-style-one text-white">Próximo</button>
                            </div>
                          </div>
                          <!-- Fim área botão -->
                        </div>
                      </div>
                    </div>
                    <!-- Fim Ls widget -->

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

  <!-- Rodapé -->
  @include('layouts.partials.copyright')
  <!-- Fim do Rodapé -->

</div>
<!-- Fim Page Wrapper -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
<script>
let formationCount = 0;

function addFormation() {
    formationCount++;
    const container = document.getElementById('formations-container');
    const formationHtml = `
        <div class="resume-block" id="formation-${formationCount}">
            <div class="inner">
                <div class="title-box">
                    <div class="info-box">
                        <input type="text" name="formations[${formationCount}][title]" placeholder="Nome do curso" class="form-control mb-2">
                        <input type="text" name="formations[${formationCount}][institution]" placeholder="Instituição" class="form-control mb-2">
                    </div>
                    <div class="edit-box">
                        <input type="text" name="formations[${formationCount}][period]" placeholder="Período (ex: 2021-2022)" class="form-control mb-2">
                        <div class="edit-btns">
                            <button type="button" onclick="removeFormation(${formationCount})"><span class="la la-trash"></span></button>
                        </div>
                    </div>
                </div>
                <textarea name="formations[${formationCount}][description]" placeholder="Descrição da formação" class="form-control" rows="3"></textarea>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', formationHtml);
}

function removeFormation(id) {
    document.getElementById(`formation-${id}`).remove();
}
</script>
@endpush
