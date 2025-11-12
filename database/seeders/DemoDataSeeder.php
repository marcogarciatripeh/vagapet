<?php

namespace Database\Seeders;

use App\Models\CompanyProfile;
use App\Models\Favorite;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\ProfessionalProfile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->environment('production')) {
            return;
        }

        $this->command?->warn('Seeding demo dataset...');

        $logoPaths = $this->publishAssets(
            glob(public_path('images/resource/company-logo/*.png')),
            'seed/company-logos'
        );

        $portfolioPaths = $this->publishAssets(
            glob(public_path('images/resource/portfolio-*.jpg')),
            'seed/portfolio'
        );

        $candidatePhotos = $this->publishAssets(
            glob(public_path('images/resource/candidate-*.png')),
            'seed/candidates'
        );

        $this->createAdminUser();

        $companies = $this->seedCompanies($logoPaths, $portfolioPaths);
        $professionals = $this->seedProfessionals($candidatePhotos, $portfolioPaths);

        $this->seedFavorites($professionals, $companies);
        $this->seedJobApplications($professionals, $companies);

        $this->command?->info('Demo dataset seeded successfully.');
    }

    private function publishAssets(array $sourceFiles, string $targetDirectory): Collection
    {
        $disk = Storage::disk('public');
        $disk->makeDirectory($targetDirectory);

        return collect($sourceFiles)
            ->filter(fn ($file) => File::exists($file))
            ->values()
            ->map(function (string $file, int $index) use ($disk, $targetDirectory) {
                $extension = File::extension($file) ?: 'png';
                $target = "{$targetDirectory}/asset-" . ($index + 1) . ".{$extension}";

                if (!$disk->exists($target)) {
                    $disk->put($target, File::get($file));
                }

                return $target;
            });
    }

    private function createAdminUser(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@vagapet.local'],
            [
                'name' => 'Administrador VagaPet',
                'password' => bcrypt('password'),
                'active_profile' => 'company',
                'is_admin' => true,
                'is_active' => true,
                'status' => 'completed',
            ]
        );
    }

    private function seedCompanies(Collection $logoPaths, Collection $portfolioPaths): Collection
    {
        $companiesCount = 8;

        $companies = CompanyProfile::factory()
            ->count($companiesCount)
            ->sequence(fn ($sequence) => [
                'logo' => $logoPaths->get($sequence->index % max($logoPaths->count(), 1)),
                'photos' => $portfolioPaths->shuffle()->take(4)->values()->all(),
            ])
            ->has(
                Job::factory()
                    ->count(fn () => fake()->numberBetween(2, 5))
                    ->state(fn () => [
                        'is_remote' => fake()->boolean(15),
                        'is_hybrid' => fake()->boolean(35),
                    ]),
                'jobs'
            )
            ->create();

        // Atualizar contadores
        $companies->each(function (CompanyProfile $company) {
            $company->updateQuietly([
                'jobs_posted_count' => $company->jobs()->count(),
                'applications_received_count' => 0,
            ]);
        });

        return $companies;
    }

    private function seedProfessionals(Collection $photos, Collection $portfolioPaths): Collection
    {
        $professionalsCount = 20;

        $professionals = ProfessionalProfile::factory()
            ->count($professionalsCount)
            ->sequence(fn ($sequence) => [
                'photo' => $photos->get($sequence->index % max($photos->count(), 1)),
                'education' => $this->shuffleAndTake($this->defaultEducation(), fake()->numberBetween(1, 2)),
                'experiences' => $this->shuffleAndTake($this->defaultExperiences(), fake()->numberBetween(1, 3)),
            ])
            ->create();

        $professionals->each(function (ProfessionalProfile $professional) use ($portfolioPaths) {
            $professional->updateQuietly([
                'applications_count' => $professional->jobApplications()->count(),
            ]);
        });

        return $professionals;
    }

    private function seedFavorites(Collection $professionals, Collection $companies): void
    {
        $professionalUsers = $professionals->map->user;

        // Empresas favoritadas por profissionais
        $professionalUsers->each(function (?User $user) use ($companies) {
            if (!$user) {
                return;
            }

            $favorites = $companies->random(fake()->numberBetween(1, min(4, $companies->count())));
            $favorites->each(function (CompanyProfile $company) use ($user) {
                Favorite::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'favoritable_id' => $company->id,
                        'favoritable_type' => CompanyProfile::class,
                    ],
                    []
                );
            });
        });

        // Profissionais favoritadas por empresas
        $companyUsers = $companies->map->user;
        $companyUsers->each(function (?User $user) use ($professionals) {
            if (!$user) {
                return;
            }

            $favorites = $professionals->random(fake()->numberBetween(2, min(6, $professionals->count())));
            $favorites->each(function (ProfessionalProfile $professional) use ($user) {
                Favorite::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'favoritable_id' => $professional->id,
                        'favoritable_type' => ProfessionalProfile::class,
                    ],
                    []
                );
            });
        });
    }

    private function seedJobApplications(Collection $professionals, Collection $companies): void
    {
        $jobs = $companies->flatMap->jobs;

        $professionals->each(function (ProfessionalProfile $professional) use ($jobs) {
            $applicationsCount = fake()->numberBetween(1, min(4, $jobs->count()));
            $jobs->shuffle()->take($applicationsCount)->each(function (Job $job) use ($professional) {
                JobApplication::factory()
                    ->for($job)
                    ->for($professional)
                    ->create();
            });

            $professional->updateQuietly([
                'applications_count' => $professional->jobApplications()->count(),
            ]);
        });

        $jobs->each(function (Job $job) {
            $job->updateQuietly([
                'applications_count' => $job->applications()->count(),
            ]);
        });

        $companies->each(function (CompanyProfile $company) {
            $company->updateQuietly([
                'jobs_posted_count' => $company->jobs()->count(),
                'applications_received_count' => JobApplication::whereIn('job_id', $company->jobs()->pluck('id'))->count(),
            ]);
        });
    }

    private function shuffleAndTake(array $items, int $limit): array
    {
        return collect($items)->shuffle()->take($limit)->values()->all();
    }

    private function defaultEducation(): array
    {
        return [
            [
                'institution' => 'Instituto Pet Brasil',
                'course' => 'Curso Avançado de Grooming',
                'period' => '2019 - 2020',
                'description' => 'Formação completa em tosa estilizada, banho terapêutico e bem-estar animal.',
            ],
            [
                'institution' => 'Universidade Animal',
                'course' => 'Tecnologia em Veterinária',
                'period' => '2016 - 2018',
                'description' => 'Curso técnico com foco em procedimentos clínicos e primeiros socorros.',
            ],
            [
                'institution' => 'Pet Care Academy',
                'course' => 'Especialização em Comportamento Animal',
                'period' => '2021',
                'description' => 'Treinamentos de adestramento positivo e socialização de cães e gatos.',
            ],
        ];
    }

    private function defaultExperiences(): array
    {
        return [
            [
                'role' => 'Groomer Sênior',
                'company' => 'Pet Friends',
                'period' => '2021 - Atual',
                'description' => 'Responsável por banho e tosa de raças pequenas e médias, com foco em tosa na tesoura.',
            ],
            [
                'role' => 'Cuidador de Pets',
                'company' => 'Hotelzinho Amigo Animal',
                'period' => '2018 - 2021',
                'description' => 'Acompanhamento de pets hospedados, administração de medicamentos e relatórios diários aos tutores.',
            ],
            [
                'role' => 'Auxiliar Veterinário',
                'company' => 'Clínica Bem-Estar',
                'period' => '2016 - 2018',
                'description' => 'Suporte em consultas, aplicação de vacinas e controle de estoque de medicamentos.',
            ],
        ];
    }
}

