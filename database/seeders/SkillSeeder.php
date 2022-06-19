<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $skill = [
            [
                'judul' => 'Komputer dan Jaringan Dasar',
                'deskripsi' => 'Komputer dan Jaringan Dasar',
                'slug' => \Str::slug('Komputer dan Jaringan Dasar', '-'),
                'syarat_lv' => 0,
                'image' => "blm-upload.png",
                'pembuat' => "Rizal Admin",
                'created_by' => 1,
                'updated_by' => null,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'judul' => 'Pemrograman Dasar',
                'deskripsi' => 'Pemrograman Dasar',
                'slug' => \Str::slug('Pemrograman Dasar', '-'),
                'syarat_lv' => 0,
                'image' => "blm-upload.png",
                'pembuat' => "Rizal Admin",
                'created_by' => 1,
                'updated_by' => null,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'judul' => 'Desain Grafis',
                'deskripsi' => 'Desain Grafis',
                'slug' => \Str::slug('Desain Grafis', '-'),
                'syarat_lv' => 0,
                'image' => "blm-upload.png",
                'pembuat' => "Rizal Admin",
                'created_by' => 1,
                'updated_by' => null,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'judul' => 'Teknologi Jaringan Berbasis Luas',
                'deskripsi' => 'Teknologi Jaringan Berbasis Luas',
                'slug' => \Str::slug('Teknologi Jaringan Berbasis Luas', '-'),
                'syarat_lv' => 0,
                'image' => "blm-upload.png",
                'pembuat' => "Rizal Admin",
                'created_by' => 1,
                'updated_by' => null,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'judul' => 'Administrasi Infrastruktur Jaringan',
                'deskripsi' => 'Administrasi Infrastruktur Jaringan',
                'slug' => \Str::slug('Administrasi Infrastruktur Jaringan', '-'),
                'syarat_lv' => 0,
                'image' => "blm-upload.png",
                'pembuat' => "Rizal Admin",
                'created_by' => 1,
                'updated_by' => null,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'judul' => 'Administrasi Sistem Jaringan',
                'deskripsi' => 'Administrasi Sistem Jaringan',
                'slug' => \Str::slug('Administrasi Sistem Jaringan', '-'),
                'syarat_lv' => 0,
                'image' => "blm-upload.png",
                'pembuat' => "Rizal Admin",
                'created_by' => 1,
                'updated_by' => null,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'judul' => 'Teknologi Layanan Jaringan',
                'deskripsi' => 'Teknologi Layanan Jaringan',
                'slug' => \Str::slug('Teknologi Layanan Jaringan', '-'),
                'syarat_lv' => 0,
                'image' => "blm-upload.png",
                'pembuat' => "Rizal Admin",
                'created_by' => 1,
                'updated_by' => null,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'judul' => 'Produk Kreatifdan Kewirausahaan',
                'deskripsi' => 'Produk Kreatifdan Kewirausahaan',
                'slug' => \Str::slug('Produk Kreatifdan Kewirausahaan', '-'),
                'syarat_lv' => 0,
                'image' => "blm-upload.png",
                'pembuat' => "Rizal Admin",
                'created_by' => 1,
                'updated_by' => null,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],

        ];

        \DB::table('skills')->insert($skill);
    }
}
