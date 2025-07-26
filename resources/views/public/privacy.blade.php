@extends('layouts.app')

@section('title', 'Aviso de Privacidade - VagaPet')

@section('content')
<div class="page-wrapper dashboard">

  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Cabeçalho Principal -->
  @include('layouts.partials.header-logout')
  <!-- Fim do Cabeçalho Principal -->

  <!-- Painel (Privacidade) -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="row">
        <div class="col-lg-12">
          <!-- Ls widget (Seção de Informações Básicas) -->
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Aviso de Privacidade — VagaPet</h4>
              </div>

              <div class="widget-content">

                <h2>1. Introdução</h2>
                <p>A VagaPet Plataforma Digital Ltda. ("VagaPet") respeita sua privacidade e está comprometida em proteger os dados pessoais que coleta. Este Aviso de Privacidade explica como coletamos, usamos, compartilhamos e protegemos suas informações, conforme a Lei Geral de Proteção de Dados Pessoais (Lei nº 13.709/2018 — LGPD).</p>

                <h2>2. Quem somos</h2>
                <p>A VagaPet é uma plataforma digital que conecta profissionais do setor pet a empresas contratantes, como pet shops, clínicas e hospitais veterinários.</p>

                <h2>3. Quais dados coletamos</h2>
                <ul>
                  <li><strong>Dados cadastrais:</strong> nome, CPF/CNPJ, data de nascimento, e-mail, telefone, endereço;</li>
                  <li><strong>Dados profissionais:</strong> currículo, experiência, especializações, certificações, portfólio;</li>
                  <li><strong>Dados de navegação:</strong> IP, localização aproximada, tipo de dispositivo, cookies e interações na plataforma;</li>
                  <li><strong>Dados financeiros:</strong> informações de pagamento (quando aplicável para planos pagos ou comissão);</li>
                  <li><strong>Outros dados:</strong> avaliações, mensagens enviadas na plataforma, arquivos anexados.</li>
                </ul>

                <h2>4. Finalidade do uso dos dados</h2>
                <p>Seus dados podem ser usados para:</p>
                <ul>
                  <li>Oferecer e aprimorar os serviços da plataforma;</li>
                  <li>Conectar profissionais e empresas com maior assertividade;</li>
                  <li>Gerar recomendações personalizadas por meio de algoritmos e IA;</li>
                  <li>Enviar notificações e alertas sobre oportunidades;</li>
                  <li>Executar obrigações legais e regulatórias;</li>
                  <li>Prevenir fraudes e garantir a segurança da plataforma.</li>
                </ul>

                <h2>5. Compartilhamento de dados</h2>
                <p>Seus dados podem ser compartilhados com:</p>
                <ul>
                  <li>Empresas contratantes e profissionais cadastrados na plataforma (conforme relação de interesse);</li>
                  <li>Prestadores de serviço terceiros (como provedores de nuvem, meios de pagamento);</li>
                  <li>Autoridades públicas, quando exigido por lei ou decisão judicial.</li>
                </ul>

                <h2>6. Direitos dos titulares</h2>
                <p>Você tem o direito de:</p>
                <ul>
                  <li>Acessar seus dados pessoais;</li>
                  <li>Corrigir dados incompletos ou incorretos;</li>
                  <li>Solicitar anonimização, bloqueio ou exclusão de dados desnecessários;</li>
                  <li>Revogar o consentimento, quando aplicável;</li>
                  <li>Solicitar a portabilidade dos dados;</li>
                  <li>Obter informações sobre compartilhamento de dados;</li>
                  <li>Apresentar reclamação à ANPD (Autoridade Nacional de Proteção de Dados).</li>
                </ul>

                <h2>7. Segurança da informação</h2>
                <p>Adotamos medidas técnicas e administrativas para proteger seus dados contra acessos não autorizados, vazamentos, alterações ou perdas.</p>

                <h2>8. Retenção dos dados</h2>
                <p>Os dados são armazenados enquanto forem necessários para as finalidades mencionadas ou conforme exigido por lei.</p>

                <h2>9. Cookies e tecnologias similares</h2>
                <p>Utilizamos cookies para melhorar sua experiência, analisar o uso da plataforma e oferecer conteúdo relevante. Você pode gerenciar suas preferências de cookies a qualquer momento <a href="{{ route('cookies') }}">clicando aqui</a>.</p>

                <h2>10. Alterações neste aviso</h2>
                <p>Este aviso pode ser atualizado a qualquer momento. Recomendamos que você revise periodicamente esta página.</p>

                <h2>11. Contato</h2>
                <p>Para dúvidas, solicitações ou exercício de direitos, entre em contato com nosso Encarregado de Proteção de Dados:</p>
                <p>
                  <strong>E-mail:</strong> <a href="mailto:privacidade@vagapet.com">privacidade@vagapet.com</a><br>
                </p>

                <p><strong>Data da última atualização:</strong> 29/05/2025</p>

              </div>
            </div>
          </div>
          <!-- Fim Ls widget -->

        </div>
      </div>
    </div>
  </section>
  <!-- Fim Painel (Privacidade) -->

  <!-- Main Footer -->
  @include('layouts.partials.footer')
  <!-- End Main Footer -->

</div>
<!-- Fim Page Wrapper -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush
