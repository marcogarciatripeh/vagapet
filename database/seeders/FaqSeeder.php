<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            // Conta & Acesso
            [
                'question' => 'Como crio minha conta?',
                'answer' => 'Clique em "Login / Cadastro", escolha "Profissional" ou "Empresa", informe e-mail e senha e confirme através do link que receber.',
                'category' => 'account',
                'sort_order' => 1,
            ],
            [
                'question' => 'Posso usar WhatsApp em vez de e-mail?',
                'answer' => 'Sim—ao criar conta, selecione "WhatsApp" e informe o número. Você receberá código de verificação por SMS/WhatsApp.',
                'category' => 'account',
                'sort_order' => 2,
            ],
            [
                'question' => 'Como altero meu e-mail ou senha?',
                'answer' => 'No menu "Configurações" → "Segurança", você pode atualizar e-mail ou redefinir senha. Um link será enviado para confirmação.',
                'category' => 'account',
                'sort_order' => 3,
            ],

            // Vagas & Candidaturas
            [
                'question' => 'Como me candidato a uma vaga?',
                'answer' => 'Encontre a vaga desejada, clique em "Candidatar-se", escreva uma carta de apresentação (opcional) e envie seu currículo.',
                'category' => 'jobs',
                'sort_order' => 1,
            ],
            [
                'question' => 'Posso me candidatar a quantas vagas quiser?',
                'answer' => 'Sim, não há limite de candidaturas. Mas recomendamos focar em vagas que realmente se adequem ao seu perfil.',
                'category' => 'jobs',
                'sort_order' => 2,
            ],
            [
                'question' => 'Como acompanho o status da minha candidatura?',
                'answer' => 'No seu painel profissional, vá em "Minhas Candidaturas" para ver o status: Pendente, Visualizada, Aprovada ou Rejeitada.',
                'category' => 'jobs',
                'sort_order' => 3,
            ],

            // Empresas
            [
                'question' => 'Como publico uma vaga?',
                'answer' => 'No painel da empresa, clique em "Gerenciar Vagas" → "Nova Vaga". Preencha todos os campos obrigatórios e publique.',
                'category' => 'company',
                'sort_order' => 1,
            ],
            [
                'question' => 'Quanto custa publicar vagas?',
                'answer' => 'Temos planos gratuitos e premium. Consulte nossa página de preços para ver os benefícios de cada plano.',
                'category' => 'company',
                'sort_order' => 2,
            ],
            [
                'question' => 'Como gerencio os candidatos?',
                'answer' => 'No painel da empresa, vá em "Candidatos" para ver todas as candidaturas, aprovar, rejeitar ou entrar em contato.',
                'category' => 'company',
                'sort_order' => 3,
            ],

            // Profissionais
            [
                'question' => 'Como faço meu perfil aparecer nas buscas?',
                'answer' => 'Complete todas as informações do perfil, adicione foto, currículo e mantenha os dados sempre atualizados.',
                'category' => 'professional',
                'sort_order' => 1,
            ],
            [
                'question' => 'Posso ter perfis de profissional e empresa?',
                'answer' => 'Sim! Você pode alternar entre os perfis no menu superior. Cada perfil tem suas próprias configurações.',
                'category' => 'professional',
                'sort_order' => 2,
            ],

            // Pagamentos
            [
                'question' => 'Quais formas de pagamento aceitam?',
                'answer' => 'Aceitamos cartão de crédito, débito, PIX e boleto bancário. Todos os pagamentos são processados com segurança.',
                'category' => 'payment',
                'sort_order' => 1,
            ],
            [
                'question' => 'Posso cancelar minha assinatura?',
                'answer' => 'Sim, você pode cancelar a qualquer momento. O acesso será mantido até o final do período pago.',
                'category' => 'payment',
                'sort_order' => 2,
            ],

            // Suporte Técnico
            [
                'question' => 'O site não está carregando, o que fazer?',
                'answer' => 'Verifique sua conexão com internet, limpe o cache do navegador ou tente em modo incógnito. Se persistir, entre em contato.',
                'category' => 'technical',
                'sort_order' => 1,
            ],
            [
                'question' => 'Como reporto um problema?',
                'answer' => 'Use o formulário de contato ou envie um e-mail para suporte@vagapet.com com detalhes do problema.',
                'category' => 'technical',
                'sort_order' => 2,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
