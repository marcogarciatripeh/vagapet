<?php

namespace Database\Factories;

use App\Models\CompanyProfile;
use App\Models\Favorite;
use App\Models\Job;
use App\Models\ProfessionalProfile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Favorite>
 */
class FavoriteFactory extends Factory
{
    protected $model = Favorite::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'favoritable_id' => ProfessionalProfile::factory(),
            'favoritable_type' => ProfessionalProfile::class,
        ];
    }

    public function company(): static
    {
        return $this->state(fn () => [
            'favoritable_id' => CompanyProfile::factory(),
            'favoritable_type' => CompanyProfile::class,
        ]);
    }

    public function job(): static
    {
        return $this->state(fn () => [
            'favoritable_id' => Job::factory(),
            'favoritable_type' => Job::class,
        ]);
    }
}

