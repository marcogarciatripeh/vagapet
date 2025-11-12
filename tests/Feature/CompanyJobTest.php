<?php

namespace Tests\Feature;

use App\Models\CompanyProfile;
use App\Models\ProfessionalProfile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyJobTest extends TestCase
{
    use RefreshDatabase;

    public function test_company_can_create_job_from_dashboard_form(): void
    {
        $user = User::factory()->company()->create();
        $company = CompanyProfile::factory()->for($user)->create();

        $payload = [
            'title' => 'Especialista em Banho e Tosa',
            'description' => 'Responsável por banho, tosa e atendimento ao tutor.',
            'requirements' => 'Experiência mínima de 2 anos.',
            'benefits' => 'VT, VR, Plano de saúde.',
            'contract_type' => 'clt',
            'area' => 'Banho e tosa',
            'experience_level' => 'junior',
            'work_hours' => 44,
            'salary_type' => 'range',
            'salary_min' => 2200,
            'salary_max' => 2800,
            'work_location' => 'Unidade Moema',
            'city' => 'São Paulo',
            'state' => 'SP',
            'is_remote' => false,
            'is_hybrid' => true,
            'is_featured' => true,
            'is_urgent' => false,
            'deadline' => now()->addWeeks(2)->format('Y-m-d'),
        ];

        $response = $this->actingAs($user)
            ->post(route('company.create-job.process'), $payload);

        $response->assertRedirect(route('company.manage-jobs'));

        $this->assertDatabaseHas('vagas', [
            'company_profile_id' => $company->id,
            'title' => 'Especialista em Banho e Tosa',
            'contract_type' => 'clt',
            'salary_type' => 'range',
            'is_hybrid' => true,
        ]);

        $this->assertDatabaseCount('vagas', 1);
    }

    public function test_company_can_toggle_professional_favorite(): void
    {
        $user = User::factory()->company()->create();
        CompanyProfile::factory()->for($user)->create();
        $professional = ProfessionalProfile::factory()->create();

        $this->actingAs($user)
            ->post(route('company.toggle-favorite'), [
                'favoritable_type' => ProfessionalProfile::class,
                'favoritable_id' => $professional->id,
            ])
            ->assertJson(['action' => 'added']);

        $this->assertDatabaseHas('favorites', [
            'user_id' => $user->id,
            'favoritable_type' => ProfessionalProfile::class,
            'favoritable_id' => $professional->id,
        ]);

        $this->actingAs($user)
            ->post(route('company.toggle-favorite'), [
                'favoritable_type' => ProfessionalProfile::class,
                'favoritable_id' => $professional->id,
            ])
            ->assertJson(['action' => 'removed']);

        $this->assertDatabaseMissing('favorites', [
            'user_id' => $user->id,
            'favoritable_type' => ProfessionalProfile::class,
            'favoritable_id' => $professional->id,
        ]);
    }
}
