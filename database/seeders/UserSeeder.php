<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'username' => 'Pengajar',
                'name' => 'Pengajar',
                'email' => 'pengajar@a.com',
                'password' => \Hash::make("password"),
                'roles' => json_encode(["1"]),
                'avatar' => "blm-upload.png",
                'gender' => "Laki-Laki",
                'alamat' => "Surakarta",
                'tempat_lahir' => "Surakarta",
                'phone' => 821212,
                'nomor_induk' => 12312312,
                'tanggal_lahir' => Carbon::create('2000', '03', '03'),
                'level' => 99,
                'skor' => 0,
                'exp' => 0,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'username' => 'Siswa',
                'name' => 'Siswa',
                'email' => 'siswa@a.com',
                'password' => \Hash::make("password"),
                'roles' => json_encode(["2"]),
                'avatar' => "blm-upload.png",
                'gender' => "Laki-Laki",
                'alamat' => "Surakarta",
                'tempat_lahir' => "Surakarta",
                'phone' => 8333,
                'nomor_induk' => 33123,
                'tanggal_lahir' => Carbon::create('2010', '04', '04'),
                'level' => 99,
                'skor' => 0,
                'exp' => 0,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],

        ];

        \DB::table('users')->insert($users);
    }
}
