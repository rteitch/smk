<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

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
    public function definition()
    {

        $roles = $this->faker->randomElement(['0', '1', '2']);
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'username' => $this->faker->unique()->name(),
            'roles' => json_encode([$roles]),
            'alamat' => $this->faker->randomElement(['Karanganyar', 'Surakarta', 'Boyolali']),
            'nomor_induk' => 1,
            'phone' => $this->faker->numberBetween(1, 9999),
            'tempat_lahir' => $this->faker->randomElement(['Karanganyar', 'Surakarta', 'Boyolali']),
            'gender' => $this->faker->randomElement(['Laki-Laki', 'Perempuan']),
            'tanggal_lahir' => $this->faker->date('Y_m_d'),
            'level' => $this->faker->numberBetween(1, 99),
            'skor' => $this->faker->numberBetween(1, 9999),
            'exp' => $this->faker->numberBetween(1, 9999),
            'avatar' => 'kosong.jpg',
            'background' => 'kosong.jpg',
            'status' => $this->faker->randomElement(['on', 'off']),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
