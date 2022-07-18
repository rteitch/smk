<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reward = [
            [
                'title' => 'Pulsa 5k',
                'deskripsi' => 'Anda menukarkan skor, dan mendapatkan Pulsa 5k',
                'slug' => \Str::slug('Pulsa 5k', '-'),
                'syarat_skor' => "10000",
                'image' => "blm-upload.png",
                'pembuat' => "Rizal Admin",
                'pembuat' => "Rizal Admin",
                'status' => "PUBLISH",
                'created_by' => 1,
                'updated_by' => null,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'title' => 'Paket Data 10k',
                'deskripsi' => 'Anda menukarkan skor, dan mendapatkan Paket Data 10k',
                'slug' => \Str::slug('Paket Data 10k', '-'),
                'syarat_skor' => "20000",
                'image' => "blm-upload.png",
                'pembuat' => "Rizal Admin",
                'pembuat' => "Rizal Admin",
                'status' => "PUBLISH",
                'created_by' => 1,
                'updated_by' => null,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'title' => 'Paket Data 20k',
                'deskripsi' => 'Anda menukarkan skor, dan mendapatkan Paket Data 20k',
                'slug' => \Str::slug('Paket Data 20k', '-'),
                'syarat_skor' => "40000",
                'image' => "blm-upload.png",
                'pembuat' => "Rizal Admin",
                'pembuat' => "Rizal Admin",
                'status' => "PUBLISH",
                'created_by' => 1,
                'updated_by' => null,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'title' => 'Makan 1x Gratis Dikantin 5k',
                'deskripsi' => 'Anda menukarkan skor, dan mendapatkan Makan 1x Gratis Dikantin 5k',
                'slug' => \Str::slug('Makan 1x Gratis Dikantin 5k', '-'),
                'syarat_skor' => "5000",
                'image' => "blm-upload.png",
                'pembuat' => "Rizal Admin",
                'pembuat' => "Rizal Admin",
                'status' => "PUBLISH",
                'created_by' => 1,
                'updated_by' => null,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'title' => 'Ebook Pembelajaran Premium',
                'deskripsi' => 'Anda menukarkan skor, dan mendapatkan Ebook Pembelajaran Premium',
                'slug' => \Str::slug('Ebook Pembelajaran Premium', '-'),
                'syarat_skor' => "10000",
                'image' => "blm-upload.png",
                'pembuat' => "Rizal Admin",
                'pembuat' => "Rizal Admin",
                'status' => "PUBLISH",
                'created_by' => 1,
                'updated_by' => null,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'title' => 'Voucher Wifi Internet Kecepatan 100mbps',
                'deskripsi' => 'Anda menukarkan skor, dan mendapatkan Voucher Wifi Internet Kecepatan 100mbps',
                'slug' => \Str::slug('Voucher Wifi Internet Kecepatan 100mbps', '-'),
                'syarat_skor' => "1000",
                'image' => "blm-upload.png",
                'pembuat' => "Rizal Admin",
                'pembuat' => "Rizal Admin",
                'status' => "PUBLISH",
                'created_by' => 1,
                'updated_by' => null,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],


        ];

        \DB::table('rewards')->insert($reward);
    }
}
