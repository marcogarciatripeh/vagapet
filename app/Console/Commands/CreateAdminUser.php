<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create-user 
                            {--email= : Email do usuário admin}
                            {--name= : Nome do usuário admin}
                            {--password= : Senha do usuário admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria um usuário administrador para acessar o Filament';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== Criar Usuário Administrador ===');
        $this->newLine();

        // Coletar dados
        $email = $this->option('email') ?: $this->ask('Email do administrador');
        $name = $this->option('name') ?: $this->ask('Nome do administrador');
        $password = $this->option('password') ?: $this->secret('Senha do administrador');

        // Validar dados
        $validator = Validator::make([
            'email' => $email,
            'name' => $name,
            'password' => $password,
        ], [
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string|min:3',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            $this->error('Erros de validação:');
            foreach ($validator->errors()->all() as $error) {
                $this->error("  - {$error}");
            }
            return Command::FAILURE;
        }

        // Verificar se email já existe
        if (User::where('email', $email)->exists()) {
            $this->warn("Usuário com email {$email} já existe.");
            if (!$this->confirm('Deseja tornar este usuário administrador?', false)) {
                return Command::FAILURE;
            }

            $user = User::where('email', $email)->first();
            $user->update([
                'is_admin' => true,
                'is_active' => true,
                'status' => 'completed',
            ]);

            $this->info("✓ Usuário {$user->name} agora é administrador!");
            $this->newLine();
            $this->info("Acesse o Filament em: /admin");
            $this->info("Email: {$user->email}");
            return Command::SUCCESS;
        }

        // Criar usuário
        try {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'is_admin' => true,
                'is_active' => true,
                'status' => 'completed',
                'active_profile' => 'professional',
            ]);

            $this->info("✓ Usuário administrador criado com sucesso!");
            $this->newLine();
            $this->table(
                ['Campo', 'Valor'],
                [
                    ['ID', $user->id],
                    ['Nome', $user->name],
                    ['Email', $user->email],
                    ['Admin', $user->is_admin ? 'Sim' : 'Não'],
                    ['Ativo', $user->is_active ? 'Sim' : 'Não'],
                ]
            );
            $this->newLine();
            $this->info("Acesse o Filament em: /admin");
            $this->info("Email: {$user->email}");
            $this->info("Senha: (a senha que você informou)");

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error("Erro ao criar usuário: {$e->getMessage()}");
            return Command::FAILURE;
        }
    }
}

