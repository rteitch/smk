<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Skill>
 */
class SkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $judul = $this->faker->name();
        $slug = Str::slug($judul, '-');
        return [
            'judul' => $judul,
            'slug' => $slug,
            'deskripsi' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa quas obcaecati enim placeat amet doloribus, repellat sapiente quidem cupiditate? Quae molestiae doloremque veniam accusantium mollitia? Dignissimos cupiditate in veniam eius.",
            'syarat_lv' => $this->faker->numberBetween(1, 99),
            'created_by' => 1,
            'qty' => $this->faker->numberBetween(1, 9999),
            'image' => 'kosong.jpg',
        ];
    }
}
