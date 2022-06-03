<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobClass>
 */
class JobClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->name();
        $slug = Str::slug($name, '-');
        return [
            'name' => $name,
            'slug' => $slug,
            'deskripsi' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa quas obcaecati enim placeat amet doloribus, repellat sapiente quidem cupiditate? Quae molestiae doloremque veniam accusantium mollitia? Dignissimos cupiditate in veniam eius.",
            'created_by' => 1,
            'image' => 'kosong.jpg',
        ];
    }
}
