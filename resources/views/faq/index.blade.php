@extends('layouts.app')

@section('title', 'FAQ - VagaPet')

@section('content')
    <!-- Header Span -->
    <span class="header-span"></span>

    <!-- Cabeçalho Principal -->
    @include('layouts.partials.header')

    <!-- Faqs Section -->
    <section class="faqs-section">
        <div class="auto-container">
            <div class="sec-title text-center">
                <h2>Perguntas Frequentes</h2>
                <div class="text">Home / FAQ</div>
            </div>

            <!-- Seção: Conta & Acesso -->
            <h3>Conta & Acesso</h3>
            <ul class="accordion-box">
                <li class="accordion block active-block">
                    <div class="acc-btn active">Como crio minha conta? <span class="icon flaticon-add"></span></div>
                    <div class="acc-content current">
                    <div class="content">
                        <p>Clique em “Login / Cadastro”, escolha “Profissional” ou “Empresa”, informe e-mail e senha e confirme através do link que receber.</p>
                    </div>
                    </div>
                </li>
                <li class="accordion block">
                    <div class="acc-btn">Posso usar WhatsApp em vez de e-mail? <span class="icon flaticon-add"></span></div>
                    <div class="acc-content">
                    <div class="content">
                        <p>Sim—ao criar conta, selecione “WhatsApp” e informe o número. Você receberá código de verificação por SMS/WhatsApp.</p>
                    </div>
                    </div>
                </li>
                <li class="accordion block">
                    <div class="acc-btn">Como altero meu e-mail ou senha? <span class="icon flaticon-add"></span></div>
                    <div class="acc-content">
                    <div class="content">
                        <p>No menu “Configurações” → “Segurança”, você pode atualizar e-mail ou redefinir senha. Um link será enviado para confirmação.</p>
                    </div>
                    </div>
                </li>
                <li class="accordion block">
                    <div class="acc-btn">Como removo minha conta? <span class="icon flaticon-add"></span></div>
                    <div class="acc-content">
                    <div class="content">
                        <p>Em “Configurações” → “Privacidade”, clique em “Excluir conta”. O processo de exclusão é reversível em até 30 dias.</p>
                    </div>
                    </div>
                </li>
            </ul>

            <!-- Seção: Publicação de Vagas -->
            <h3>Publicação de Vagas</h3>
            <ul class="accordion-box">
                <li class="accordion block active-block">
                    <div class="acc-btn active">Quanto custa publicar uma vaga? <span class="icon flaticon-add"></span></div>
                    <div class="acc-content current">
                    <div class="content">
                        <p>Custa R$ 9,90 por vaga, válida por 30 dias. Para repostar após expirar, basta pagar novamente.</p>
                    </div>
                    </div>
                </li>
                <li class="accordion block">
                    <div class="acc-btn">Como destaco minha vaga? <span class="icon flaticon-add"></span></div>
                    <div class="acc-content">
                    <div class="content">
                        <p>No painel de vagas publicadas, ative “Destacar Vaga” e confirme pagamento de R$ 19,90 para 7 dias de destaque.</p>
                    </div>
                    </div>
                </li>
                <li class="accordion block">
                    <div class="acc-btn">Posso editar uma vaga já publicada? <span class="icon flaticon-add"></span></div>
                    <div class="acc-content">
                    <div class="content">
                        <p>Sim—acesse “Minhas Vagas”, clique em “Editar” na vaga desejada, faça as alterações e salve. Não há custo adicional.</p>
                    </div>
                    </div>
                </li>
            <li class="accordion block">
                <div class="acc-btn">Como excluo uma vaga? <span class="icon flaticon-add"></span></div>
                <div class="acc-content">
                <div class="content">
                    <p>No painel “Minhas Vagas”, clique em “Excluir”. A vaga sai do ar imediatamente, sem reembolso.</p>
                </div>
                </div>
            </li>
            </ul>

            <!-- Seção: Candidaturas & Perfis -->
            <h3>Candidaturas & Perfis</h3>
            <ul class="accordion-box">
                <li class="accordion block active-block">
                    <div class="acc-btn active">Como me candidato a uma vaga? <span class="icon flaticon-add"></span></div>
                    <div class="acc-content current">
                    <div class="content">
                        <p>Acesse o detalhe da vaga e clique em “Quero me candidatar”. Confirme seu currículo e responda perguntas de triagem (se houver).</p>
                    </div>
                    </div>
                </li>
                <li class="accordion block">
                    <div class="acc-btn">O que é o Acesso Imediato? <span class="icon flaticon-add"></span></div>
                    <div class="acc-content">
                    <div class="content">
                        <p>Vagas novas aparecem após 72h. Para vê-las na hora, pague R$ 9,90 no seu painel e tenha acesso instantâneo.</p>
                    </div>
                    </div>
                </li>
                <li class="accordion block">
                    <div class="acc-btn">Como funciona o Teste de Skills? <span class="icon flaticon-add"></span></div>
                    <div class="acc-content">
                    <div class="content">
                        <p>Você faz uma avaliação online (R$ 7,90) e recebe um badge de competência no perfil que aumenta sua relevância.</p>
                    </div>
                    </div>
                </li>
                <li class="accordion block">
                    <div class="acc-btn">Como vejo quem visitou meu perfil? <span class="icon flaticon-add"></span></div>
                    <div class="acc-content">
                    <div class="content">
                        <p>Ative “Quem Viu Meu Perfil” por R$ 4,90 para visualizar até 30 dias de histórico de visitas no seu painel.</p>
                    </div>
                    </div>
                </li>
            </ul>

            <!-- Seção: Pagamentos & Add-Ons -->
            <h3>Pagamentos & Add-Ons</h3>
            <ul class="accordion-box">
                <li class="accordion block active-block">
                    <div class="acc-btn active">Quais métodos de pagamento são aceitos? <span class="icon flaticon-add"></span></div>
                    <div class="acc-content current">
                    <div class="content">
                        <p>Aceitamos cartão de crédito, PIX e boleto. Cartão e PIX são processados instantaneamente; boleto em até 3 dias úteis.</p>
                    </div>
                    </div>
                </li>
                <li class="accordion block">
                    <div class="acc-btn">Como adiciono um add-on ao meu pedido? <span class="icon flaticon-add"></span></div>
                    <div class="acc-content">
                    <div class="content">
                        <p>Na tela de publicação ou no checkout, marque os serviços extras desejados e finalize o pagamento junto com a vaga ou contratação.</p>
                    </div>
                    </div>
                </li>
                <li class="accordion block">
                    <div class="acc-btn">Posso parcelar pagamentos? <span class="icon flaticon-add"></span></div>
                    <div class="acc-content">
                    <div class="content">
                        <p>Sim—parcelamos em até 3x sem juros no cartão de crédito para valores acima de R$ 50.</p>
                    </div>
                    </div>
                </li>
            </ul>

            <!-- Seção: Suporte -->
            <h3>Suporte & Ajuda</h3>
            <ul class="accordion-box">
                <li class="accordion block active-block">
                    <div class="acc-btn active">Como abrir um chamado? <span class="icon flaticon-add"></span></div>
                    <div class="acc-content current">
                    <div class="content">
                        <p>Em “Ajuda” clique em “Abrir Ticket”, descreva seu problema e envie. Você receberá resposta por e-mail e verá atualizações no painel.</p>
                    </div>
                    </div>
                </li>
                <li class="accordion block">
                    <div class="acc-btn">Qual o horário de atendimento? <span class="icon flaticon-add"></span></div>
                    <div class="acc-content">
                    <div class="content">
                        <p>Nosso suporte funciona de segunda a sexta, das 9h às 18h. Chamados enviados fora desse horário são atendidos no próximo dia útil.</p>
                    </div>
                    </div>
                </li>
                <li class="accordion block">
                    <div class="acc-btn">Posso falar via WhatsApp? <span class="icon flaticon-add"></span></div>
                    <div class="acc-content">
                    <div class="content">
                        <p>Sim—encontre nosso número na seção “Contato” e envie uma mensagem. Resposta em até 2 horas úteis.</p>
                    </div>
                    </div>
                </li>
            </ul>

        </div>
    </section>

    <!-- Main Footer -->
    @include('layouts.partials.footer')
@endsection

@push('scripts')
    @include('layouts.partials.scripts')
@endpush
