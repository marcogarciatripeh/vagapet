@extends('layouts.app')

@section('title', 'Termos e Condições - VagaPet')

@section('content')
<div class="page-wrapper dashboard">

  <!-- Preloader -->
  <div class="preloader"></div>

  <!-- Header Span -->
  <span class="header-span"></span>

  <!-- Cabeçalho Principal -->
  @include('layouts.partials.header-logout')
  <!-- Fim do Cabeçalho Principal -->

  <!-- Painel (Termos) -->
  <section class="user-dashboard">
    <div class="dashboard-outer">
      <div class="row">
        <div class="col-lg-12">
          <!-- Ls widget (Seção de Informações Básicas) -->
          <div class="ls-widget">
            <div class="tabs-box">
              <div class="widget-title">
                <h4>Termos e Condições de Uso- VagaPet</h4>
              </div>

              <div class="widget-content">

                <h2>1. Introdução</h2>
                <p>Estes Termos e Condições ("Termos") regulam o uso das plataformas, sites, aplicativos, produtos, conteúdos e serviços (coletivamente, "Serviços") oferecidos pela VagaPet Plataforma Digital Ltda. ("VagaPet").</p>
                <p>Ao acessar ou utilizar os Serviços, você concorda com estes Termos, estabelecendo relação contratual com a VagaPet. Caso não concorde, não poderá usar os Serviços. A VagaPet poderá alterar estes Termos a qualquer momento, sendo sua responsabilidade revisá-los periodicamente. O uso contínuo após alterações implica aceitação.</p>

                <h2>2. Definições</h2>
                <ul>
                  <li><strong>Profissional:</strong> Pessoa que busca oportunidades de trabalho no setor pet.</li>
                  <li><strong>Empresa:</strong> Pet shop, clínica, hospital veterinário ou estabelecimento que publica vagas na plataforma.</li>
                  <li><strong>Serviços:</strong> Produtos, recursos e funcionalidades oferecidos pela VagaPet.</li>
                  <li><strong>Usuário:</strong> Qualquer pessoa que utilize a plataforma, seja profissional ou empresa.</li>
                  <li><strong>Plataforma:</strong> Sites, sistemas e aplicativos mantidos pela VagaPet para conectar profissionais e empresas.</li>
                </ul>

                <h2>3. Escopo dos Serviços</h2>
                <p>A VagaPet oferece:</p>
                <ul>
                  <li>Publicação e divulgação de vagas no setor pet;</li>
                  <li>Criação e exibição de perfis profissionais;</li>
                  <li>Correspondência automatizada entre perfis e vagas (matching);</li>
                  <li>Serviços pagos (planos premium, destaques, entre outros);</li>
                  <li>Avaliações mútuas entre profissionais e empresas;</li>
                  <li>Alertas e notificações sobre oportunidades;</li>
                  <li>Ferramentas para facilitar processos seletivos (como chat e agendamento).</li>
                </ul>

                <h2>4. Condições de Uso</h2>
                <p>A plataforma é destinada apenas a pessoas maiores de 18 anos. Usuários garantem fornecer informações verídicas, manter a confidencialidade de suas credenciais e usar a plataforma de forma ética e legal. A VagaPet poderá suspender contas em caso de uso inadequado.</p>

                <h2>5. Funcionalidades</h2>
                <ul>
                  <li><strong>Comunicação:</strong> Permite comunicação entre profissionais e empresas, devendo ser usado com responsabilidade.</li>
                  <li><strong>Matching digital:</strong> Oportunidades são encontradas com base no perfil e preferências, mas não substituem avaliação humana e pessoal.</li>
                  <li><strong>Planos Pagos:</strong> Usuários podem adquirir recursos adicionais. Detalhes e valores estão disponíveis na plataforma.</li>
                </ul>

                <h2>6. Responsabilidades</h2>
                <p>A VagaPet não se responsabiliza por:</p>
                <ul>
                  <li>Contratações feitas diretamente entre usuários;</li>
                  <li>Qualidade ou resultado dos serviços prestados por profissionais ou empresas;</li>
                  <li>Dados desatualizados ou incorretos fornecidos pelos usuários;</li>
                  <li>Eventuais indisponibilidades da plataforma;</li>
                  <li>Obrigações fiscais ou trabalhistas entre profissionais e empresas.</li>
                </ul>

                <h2>7. Preços e Comissionamento</h2>
                <p>A plataforma poderá cobrar taxas ou comissões por serviços oferecidos. As condições serão detalhadas no momento da contratação. Empresas e profissionais são responsáveis por cumprir suas obrigações fiscais.</p>

                <h2>8. Privacidade e Proteção de Dados</h2>
                <p>A VagaPet trata dados pessoais conforme a LGPD. Para mais detalhes, consulte nosso <a href="{{ route('privacy') }}">Aviso de Privacidade</a>. Usuários são responsáveis por garantir a veracidade das informações fornecidas e podem, a qualquer momento, exercer seus direitos previstos na legislação.</p>

                <h2>9. Propriedade Intelectual</h2>
                <p>Todo o conteúdo da plataforma (logotipos, textos, imagens, código-fonte, banco de dados) é propriedade da VagaPet e protegido por lei. O uso não autorizado é proibido. Usuários possuem uma licença limitada para utilizar os serviços exclusivamente conforme estes Termos.</p>

                <h2>10. Inteligência Artificial e Recomendações</h2>
                <p>A plataforma utiliza recursos de IA para sugerir vagas e perfis. Apesar dos esforços para oferecer sugestões precisas, podem ocorrer erros ou limitações.</p>

                <h2>11. Contato</h2>
                <p>Para dúvidas ou solicitações, entre em contato pelo e-mail <a href="mailto:atendimento@vagapet.com">atendimento@vagapet.com</a>.</p>

                <h2>12. Aceitação</h2>
                <p>O uso da plataforma implica aceitação plena destes Termos. É responsabilidade do usuário revisar periodicamente os Termos e estar ciente de suas obrigações.</p>

                <h2>13. Anticorrupção e Compliance</h2>
                <p>As partes declaram cumprir integralmente a legislação aplicável, incluindo normas anticorrupção, prevenção à lavagem de dinheiro e sanções internacionais. A VagaPet poderá, a seu critério, suspender ou encerrar contas envolvidas em atividades suspeitas.</p>

                <h2>14. Disposições Gerais</h2>
                <p>Estes Termos são regidos pela legislação brasileira. Eventuais controvérsias serão dirimidas no foro da Comarca de São Paulo/SP, salvo direito do consumidor de optar por seu domicílio.</p>

                <h3>Leia também:</h3>
                <ul>
                  <li><a href="{{ route('privacy') }}">Aviso de Privacidade</a></li>
                  <li><a href="{{ route('cookies') }}">Política de Cookies</a></li>
                  <li><a href="{{ route('help') }}">Manual do Usuário</a></li>
                </ul>

                <p><strong>Data da última atualização:</strong> 29/05/2025</p>

              </div>
            </div>
          </div>
          <!-- Fim Ls widget -->

        </div>
      </div>
    </div>
  </section>
  <!-- Fim Painel (Termos) -->

  <!-- Main Footer -->
  @include('layouts.partials.footer')
  <!-- End Main Footer -->

</div>
<!-- Fim Page Wrapper -->
@endsection

@push('scripts')
@include('layouts.partials.scripts')
@endpush
