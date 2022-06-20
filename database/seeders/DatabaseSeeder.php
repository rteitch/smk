<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            JobClassSeeder::class,
            ArtikelSeeder::class,
            QuestSeeder::class,
            RewardSeeder::class,
            SkillSeeder::class
          ]);
    }
}
