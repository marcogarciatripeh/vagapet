<?php

namespace Database\Factories;

use App\Models\CompanyProfile;
use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    protected $model = Job::class;

    public function definition(): array
    {
        $title = fake()->jobTitle();
        $city = fake()->city();
        $state = fake()->stateAbbr();

        $contractTypes = ['clt', 'pj', 'freelance', 'internship', 'temporary'];
        $salaryType = fake()->randomElement(['fixed', 'range', 'negotiable']);

        $salaryMin = null;
        $salaryMax = null;

        if ($salaryType === 'fixed') {
            $salaryMin = fake()->numberBetween(1800, 6000);
        } elseif ($salaryType === 'range') {
            $salaryMin = fake()->numberBetween(1800, 4000);
            $salaryMax = $salaryMin + fake()->numberBetween(400, 2500);
        }

        return [
            'company_profile_id' => CompanyProfile::factory(),
            'title' => $title,
            'slug' => Str::slug($title . '-' . fake()->unique()->numerify('###')),
            'description' => fake()->paragraphs(4, true),
            'requirements' => fake()->paragraphs(2, true),
            'benefits' => fake()->sentences(3, true),
            'contract_type' => fake()->randomElement($contractTypes),
            'area' => fake()->randomElement([
                'Banho e Tosa',
                'Recepção',
                'Veterinária',
                'Marketing',
                'Serviços gerais',
            ]),
            'experience_level' => fake()->randomElement(['junior', 'pleno', 'senior', 'lead', 'any']),
            'work_hours' => fake()->numberBetween(20, 44),
            'salary_type' => $salaryType,
            'salary_min' => $salaryMin,
            'salary_max' => $salaryMax,
            'currency' => 'BRL',
            'work_location' => fake()->streetAddress(),
            'city' => $city,
            'state' => $state,
            'is_remote' => fake()->boolean(20),
            'is_hybrid' => fake()->boolean(30),
            'status' => 'active',
            'is_featured' => fake()->boolean(15),
            'is_urgent' => fake()->boolean(10),
            'deadline' => fake()->optional()->dateTimeBetween('now', '+45 days'),
            'published_at' => fake()->dateTimeBetween('-30 days', 'now'),
            'views_count' => fake()->numberBetween(50, 1500),
            'applications_count' => fake()->numberBetween(0, 120),
        ];
    }

    public function draft(): static
    {
        return $this->state(fn () => [
            'status' => 'draft',
            'published_at' => null,
        ]);
    }
}

