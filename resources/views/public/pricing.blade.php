@extends('layouts.app')

@section('title', 'Planos e Preços - VagaPet')

@section('content')
<div class="page-wrapper">

  <!-- Cabeçalho Principal -->
  @include('layouts.partials.header-logout')
  <!-- Fim do Cabeçalho Principal -->

  <!-- Pricing Section -->
  <section class="pricing-section">
    <div class="auto-container">
      <div class="sec-title text-center">
        <h2>Planos e Combinações</h2>
        <div class="text">Compare três formas de combinar nossos serviços para sua empresa</div>
      </div>

      <div class="row justify-content-center">

        <!-- Tabela 1: Empresa -->
        <div class="pricing-table col-lg-4 col-md-6">
          <div class="inner-box">
            <div class="title">Serviços</div>
            <div class="price">Empresas</div>
            <div class="table-content">

              <div class="row border-bottom pb-3">
                <div class="col-8">
                  <p class="text-dark">Publicar vaga:</p>
                  <p class="small">Sua vaga fica visível na plataforma até a data que você definir</p>
                </div>
                <div class="col-4">
                  <p>R$ 9,90</p>
                </div>
              </div>

              <div class="row border-bottom pb-3 pt-3">
                <div class="col-8">
                  <p class="text-dark">Enviar vaga por WhatsApp:</p>
                  <p class="small">Dispare o link da vaga para até 50 profissionais via WhatsApp</p>
                </div>
                <div class="col-4">
                  <p>+R$ 6,90</p>
                </div>
              </div>

              <div class="row border-bottom pb-3 pt-3">
                <div class="col-8">
                  <p class="text-dark">Destacar vaga na plataforma<br>(7 dias):</p>
                  <p class="small">Sua vaga aparece em posição de destaque nas buscas</p>
                </div>
                <div class="col-4">
                  <p>+R$ 19,90</p>
                </div>
              </div>

              <div class="row border-bottom pb-3 pt-3">
                <div class="col-8">
                  <p class="text-dark">Impulsionamento em redes sociais<br>(7 dias):</p>
                  <p class="small">Sua vaga é divulgada nas redes sociais para alcançar mais profissionais</p>
                </div>
                <div class="col-4">
                  <p>+R$ 19,90</p>
                </div>
              </div>

              <div class="row border-bottom pb-3 pt-3">
                <div class="col-8">
                  <p class="text-dark">Seleção Inteligente de Profissionais<br>(por relatório):</p>
                  <p class="small">Relatório com os 10 candidatos mais compatíveis com a vaga</p>
                </div>
                <div class="col-4">
                  <p>+R$ 9,90</p>
                </div>
              </div>

              <div class="row border-bottom pb-3 pt-3">
                <div class="col-8">
                  <p class="text-dark">Checklist de descrição de Vaga e perfil:</p>
                  <p class="small">Avaliação do texto da vaga e relatório de sugestões de melhorias</p>
                </div>
                <div class="col-4">
                  <p>+R$ 49,90</p>
                </div>
              </div>

              <div class="row border-bottom pb-3 pt-3">
                <div class="col-8">
                  <p class="text-dark">Checklist de descrição de Vaga e perfil:</p>
                  <p class="small">Avaliação do texto da vaga e relatório de sugestões de melhorias</p>
                </div>
                <div class="col-4">
                  <p>+R$ 49,90</p>
                </div>
              </div>

            </div>

            <div class="table-footer">
              <a href="{{ route('company.create-job') }}" class="theme-btn btn-style-three">Publicar vaga</a>
            </div>
          </div>
        </div>

        <!-- Tabela 2: Profissionais -->
        <div class="pricing-table col-lg-4 col-md-6">
          <div class="inner-box tagged">
            <div class="title">Serviços</div>
            <div class="price">Profissionais</div>
            <div class="table-content">
              <div class="row border-bottom pb-3">
                <div class="col-8">
                  <p class="text-dark">Acesso Imediato às Vagas<br>(30 dias):</p>
                  <p class="small">Veja todas as vagas publicadas sem esperar 72 h</p>
                </div>
                <div class="col-4">
                  <p>R$ 9,90</p>
                </div>
              </div>

              <div class="row border-bottom pb-3 pt-3">
                <div class="col-8">
                  <p class="text-dark">Destaque de Perfil<br>(7 dias):</p>
                  <p class="small">Seu perfil aparece no topo dos resultados de busca</p>
                </div>
                <div class="col-4">
                  <p>+R$ 9,90</p>
                </div>
              </div>

              <div class="row border-bottom pb-3 pt-3">
                <div class="col-8">
                  <p class="text-dark">Receber Vagas por E-mail/WhatsApp<br>(30 dias):</p>
                  <p class="small">Notificações instantâneas das vagas que batem com seu perfil</p>
                </div>
                <div class="col-4">
                  <p>+R$ 6,90</p>
                </div>
              </div>

              <div class="row border-bottom pb-3 pt-3">
                <div class="col-8">
                  <p class="text-dark">Checklist de descrição de perfil:</p>
                  <p class="small">Avaliação do texto do perfil e relatório de sugestões de melhorias</p>
                </div>
                <div class="col-4">
                  <p>+R$ 49,90</p>
                </div>
              </div>

            </div>

            <div class="table-footer">
              <a href="{{ route('jobs.index') }}" class="theme-btn btn-style-three">Encontrar vaga</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- End Pricing Section -->

  <!-- Main Footer -->
  @include('layouts.partials.footer')
  <!-- End Main Footer -->

</div><!-- End Page Wrapper -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush
