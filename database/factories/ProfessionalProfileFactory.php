<?php

namespace Database\Factories;

use App\Models\ProfessionalProfile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\ProfessionalProfile>
 */
class ProfessionalProfileFactory extends Factory
{
    protected $model = ProfessionalProfile::class;

    public function definition(): array
    {
        $firstName = fake()->firstName();
        $lastName = fake()->lastName();

        $areas = [
            'Banho e tosa',
            'Creche e hotel',
            'Adestramento',
            'Veterinária',
            'Recepção',
            'Marketing',
            'Serviços gerais',
        ];

        $skills = [
            'Comunicação',
            'Empatia com pets',
            'Higienização',
            'Primeiros socorros pet',
            'Gestão de agenda',
            'Atendimento ao cliente',
            'Vendas',
            'Criação de conteúdo',
        ];

        $educations = [
            [
                'title' => 'Curso de Banho e Tosa',
                'institution' => 'Instituto Pet Brasil',
                'period' => '2019 - 2020',
                'description' => 'Formação completa em higienização, tosa estilizada e cuidados gerais.',
            ],
            [
                'title' => 'Atendimento ao Cliente',
                'institution' => 'Senac',
                'period' => '2021',
                'description' => 'Curso focado em experiência do cliente no segmento pet.',
            ],
        ];

        $experiences = [
            [
                'title' => 'Groomer',
                'company' => fake()->company(),
                'period' => '2021 - Atual',
                'description' => 'Responsável por banho, tosa e atendimento aos tutores.',
            ],
            [
                'title' => 'Assistente Veterinário',
                'company' => fake()->company(),
                'period' => '2019 - 2021',
                'description' => 'Auxílio em consultas, aplicação de medicações e triagem inicial.',
            ],
        ];

        $selectedAreas = fake()->randomElements($areas, fake()->numberBetween(2, 4));
        $selectedSkills = fake()->randomElements($skills, fake()->numberBetween(3, 6));

        return [
            'user_id' => User::factory()->professional(),
            'first_name' => $firstName,
            'last_name' => $lastName,
            'phone' => fake()->phoneNumber(),
            'birth_date' => fake()->dateTimeBetween('-40 years', '-18 years'),
            'gender' => fake()->randomElement(['male', 'female', 'other']),
            'address' => fake()->streetAddress(),
            'neighborhood' => fake()->citySuffix(),
            'city' => fake()->city(),
            'state' => fake()->stateAbbr(),
            'zip_code' => fake()->postcode(),
            'latitude' => fake()->latitude(-33.75, 5.27),
            'longitude' => fake()->longitude(-73.98, -34.79),
            'bio' => fake()->paragraphs(2, true),
            'title' => fake()->randomElement([
                'Groomer Especialista',
                'Veterinário(a)',
                'Dog Walker',
                'Cuidador(a) de Pets',
                'Recepcionista de Pet Shop',
            ]),
            'experience_level' => fake()->randomElement(['estagio', 'junior', 'pleno', 'senior']),
            'areas' => array_values($selectedAreas),
            'skills' => array_values($selectedSkills),
            'education' => Arr::random([$educations, array_slice($educations, 0, 1)]),
            'experiences' => Arr::random([$experiences, array_slice($experiences, 0, 1)]),
            'years_experience' => fake()->numberBetween(1, 15),
            'photo' => null,
            'resume' => null,
            'linkedin' => fake()->boolean(50) ? 'https://www.linkedin.com/in/' . strtolower($firstName . '-' . $lastName) : null,
            'instagram' => fake()->boolean(40) ? 'https://www.instagram.com/' . strtolower(Str::slug($firstName . $lastName)) : null,
            'facebook' => fake()->boolean(30) ? 'https://www.facebook.com/' . strtolower(Str::slug($firstName . $lastName)) : null,
            'website' => fake()->boolean(10) ? fake()->url() : null,
            'views_count' => fake()->numberBetween(50, 800),
            'applications_count' => fake()->numberBetween(0, 30),
        ];
    }
}

