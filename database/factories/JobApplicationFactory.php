<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\JobApplication;
use App\Models\ProfessionalProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\JobApplication>
 */
class JobApplicationFactory extends Factory
{
    protected $model = JobApplication::class;

    public function definition(): array
    {
        $status = fake()->randomElement(['pending', 'viewed', 'approved', 'rejected']);

        return [
            'job_id' => Job::factory(),
            'professional_profile_id' => ProfessionalProfile::factory(),
            'status' => $status,
            'cover_letter' => fake()->paragraphs(2, true),
            'resume_file' => null,
            'viewed_at' => $status !== 'pending' ? fake()->dateTimeBetween('-15 days', 'now') : null,
            'responded_at' => in_array($status, ['approved', 'rejected'], true) ? fake()->dateTimeBetween('-10 days', 'now') : null,
            'response_message' => in_array($status, ['approved', 'rejected'], true) ? fake()->sentence() : null,
        ];
    }

    public function pending(): static
    {
        return $this->state(fn () => [
            'status' => 'pending',
            'viewed_at' => null,
            'responded_at' => null,
            'response_message' => null,
        ]);
    }
}

