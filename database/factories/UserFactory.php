<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Array nama depan Indonesia
        $firstNames = [
            'Adi', 'Budi', 'Citra', 'Dewi', 'Eko', 'Fitri', 'Gading', 'Hadi',
            'Indah', 'Joko', 'Kartika', 'Lina', 'Muhammad', 'Nina', 'Oscar',
            'Putri', 'Rudi', 'Sari', 'Tono', 'Udin', 'Vina', 'Wati', 'Yanto', 'Zahra'
        ];

        // Array nama belakang Indonesia
        $lastNames = [
            'Wijaya', 'Susanto', 'Sanjaya', 'Hutapea', 'Siregar', 'Nasution',
            'Pratama', 'Nugraha', 'Hidayat', 'Kusuma', 'Putra', 'Santoso',
            'Wibowo', 'Saputra', 'Permana', 'Purnama', 'Sugiarto', 'Cahyono'
        ];

        // Array kota di Indonesia
        $cities = [
            'Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Semarang', 'Yogyakarta',
            'Malang', 'Palembang', 'Makassar', 'Denpasar'
        ];

        // Generate tanggal lahir antara 17-30 tahun yang lalu
        $birthDate = fake()->dateTimeBetween('-30 years', '-17 years');

        return [
            'first_name' => fake()->randomElement($firstNames),
            'last_name' => fake()->randomElement($lastNames),
            'birth_date' => $birthDate,
            'email' => fake()->unique()->safeEmail(),
            'whatsapp' => '08' . fake()->numberBetween(1000000000, 9999999999),
            'is_active' => true,
            'profile_image' => null,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'bio' => fake()->paragraph(),
            'education_background' => null,
            'certifications_file' => null,
            'preferred_course' => null,
            'profession' => null,
            'reason' => null
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
