<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JobClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobclass = [
            [
                'name' => 'TKJ',
                'deskripsi' => 'Teknik Komputer dan Jaringan',
                'slug' => \Str::slug('TKJ', '-'),
                'image' => "blm-upload.png",
                'created_by' => 1,
                'pembuat' => "Rizal Admin",
                'updated_by' => null,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => 'RPL',
                'deskripsi' => 'Rekayasa Perangkat Lunak',
                'slug' => \Str::slug('RPL', '-'),
                'image' => "blm-upload.png",
                'created_by' => 1,
                'pembuat' => "Rizal Admin",
                'updated_by' => null,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],

        ];

        \DB::table('job_classes')->insert($jobclass);
    }
}
