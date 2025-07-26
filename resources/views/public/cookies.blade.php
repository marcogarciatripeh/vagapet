@extends('layouts.app')

@section('title', 'Política de Cookies - VagaPet')

@section('content')
<div class="page-wrapper dashboard">

  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Cabeçalho Principal -->
  @include('layouts.partials.header-logout')
  <!-- Fim do Cabeçalho Principal -->

  <!-- Painel (Cookies) -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="row">
        <div class="col-lg-12">
          <!-- Ls widget (Seção de Informações Básicas) -->
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h1>Política de Cookies — VagaPet</h1>
              </div>

              <div class="widget-content">

                <h2>1. O que são cookies?</h2>
                <p>Cookies são pequenos arquivos de texto armazenados no seu navegador quando você visita um site. Eles servem para melhorar sua experiência, lembrar suas preferências e ajudar a entender como você interage com nossos serviços.</p>

                <h2>2. Por que usamos cookies?</h2>
                <p>Utilizamos cookies para:</p>
                <ul>
                  <li>Garantir o funcionamento adequado da plataforma;</li>
                  <li>Salvar suas preferências e configurações;</li>
                  <li>Melhorar sua navegação e experiência;</li>
                  <li>Coletar dados estatísticos sobre o uso da plataforma;</li>
                  <li>Oferecer conteúdos e anúncios personalizados.</li>
                </ul>

                <h2>3. Tipos de cookies utilizados</h2>
                <ul>
                  <li><strong>Cookies estritamente necessários:</strong> Essenciais para o funcionamento do site. Ex: login, segurança.</li>
                  <li><strong>Cookies de desempenho:</strong> Coletam informações sobre como os usuários usam a plataforma (ex: páginas mais acessadas).</li>
                  <li><strong>Cookies de funcionalidade:</strong> Permitem lembrar preferências e personalizar recursos.</li>
                  <li><strong>Cookies de publicidade:</strong> Usados para exibir anúncios relevantes e medir a eficácia de campanhas.</li>
                </ul>

                <h2>4. Gerenciamento de cookies</h2>
                <p>Você pode, a qualquer momento, configurar seu navegador para bloquear ou remover cookies. No entanto, isso pode impactar o funcionamento correto da plataforma.</p>
                <p>Para personalizar suas preferências, acesse nosso <a href="#">Painel de Preferências de Cookies</a>.</p>

                <h2>5. Cookies de terceiros</h2>
                <p>Utilizamos serviços de terceiros que também podem configurar cookies em seu dispositivo, como Google Analytics, Meta, Hotjar, entre outros. Cada um tem sua própria política de privacidade e uso de cookies.</p>

                <h2>6. Alterações nesta política</h2>
                <p>Podemos atualizar esta Política de Cookies a qualquer momento. Recomendamos que você a consulte periodicamente para estar ciente de possíveis alterações.</p>

                <h2>7. Contato</h2>
                <p>Em caso de dúvidas sobre esta política, entre em contato com nosso Encarregado de Dados (DPO) pelo e-mail: <a href="mailto:privacidade@vagapet.com">privacidade@vagapet.com</a></p>

                <p><strong>Última atualização:</strong> 29/05/2025</p>

              </div>
            </div>
          </div>
          <!-- Fim Ls widget -->

        </div>
      </div>
    </div>
  </section>
  <!-- Fim Painel (Cookies) -->

  <!-- Main Footer -->
  @include('layouts.partials.footer')
  <!-- End Main Footer -->

</div>
<!-- Fim Page Wrapper -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush
