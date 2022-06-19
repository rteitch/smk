<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = new \App\Models\User();
        $admin->username = "rizal-admin";
        $admin->name = "Rizal Admin";
        $admin->email = "rizal@a.com";
        // 0 = admin, 1 = pengajar, 2 = siswa
        $admin->roles = json_encode(["0"]);
        $admin->password = \Hash::make("rizal");
        $admin->avatar = "blm-upload.png";
        $admin->alamat = "Gondangrejo, Karanganyar, Jawa Tengah";
        $admin->tempat_lahir = "Karanganyar";
        $admin->phone = 9192831;
        $admin->gender = "Laki-Laki";
        $admin->tanggal_lahir = Carbon::create('2000', '03', '03');
        $admin->level = 100;
        $admin->exp = 134700;
        $admin->skor = 0;
        $admin->nomor_induk = 100;
        $admin->save();
        $this->command->info("User admin berhasil ditambahkan");
    }
}
