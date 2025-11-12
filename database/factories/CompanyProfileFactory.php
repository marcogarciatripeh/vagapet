<?php

namespace Database\Factories;

use App\Models\CompanyProfile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\CompanyProfile>
 */
class CompanyProfileFactory extends Factory
{
    protected $model = CompanyProfile::class;

    public function definition(): array
    {
        $companyName = fake()->unique()->company();
        $services = [
            'Banho e tosa',
            'Creche e hotel',
            'Veterinária',
            'Adestramento',
            'Transporte Pet',
            'Loja Pet',
            'Farmácia Pet',
        ];

        $specialties = [
            'Cães de pequeno porte',
            'Cães de grande porte',
            'Gatos',
            'Exóticos',
            'Especialistas em felinos',
            'Reabilitação',
        ];

        $username = Str::slug(fake()->unique()->company(), '-');

        return [
            'user_id' => User::factory()->company(),
            'company_name' => $companyName,
            'cnpj' => fake()->numerify('##.###.###/####-##'),
            'phone' => fake()->phoneNumber(),
            'website' => fake()->optional()->url(),
            'description' => fake()->paragraphs(3, true),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'state' => fake()->stateAbbr(),
            'zip_code' => fake()->postcode(),
            'latitude' => fake()->latitude(-33.75, 5.27),
            'longitude' => fake()->longitude(-73.98, -34.79),
            'services' => fake()->randomElements($services, fake()->numberBetween(2, 4)),
            'specialties' => fake()->randomElements($specialties, fake()->numberBetween(1, 3)),
            'employees_count' => fake()->numberBetween(3, 40),
            'company_size' => fake()->randomElement(['micro', 'small', 'medium', 'large']),
            'logo' => null,
            'photos' => [],
            'linkedin' => fake()->boolean(60) ? "https://www.linkedin.com/company/{$username}" : null,
            'instagram' => fake()->boolean(70) ? "https://www.instagram.com/{$username}" : null,
            'facebook' => fake()->boolean(40) ? "https://www.facebook.com/{$username}" : null,
            'youtube' => fake()->boolean(30) ? "https://www.youtube.com/@{$username}" : null,
            'views_count' => fake()->numberBetween(100, 1000),
            'jobs_posted_count' => 0,
            'applications_received_count' => 0,
        ];
    }
}

