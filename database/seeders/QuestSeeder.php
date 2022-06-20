<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class QuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quest = [
            [
                'judul' => 'Apa itu jaringan?',
                'deskripsi' => 'Jika berbicara perihal jaringan apa jaringan itu?',
                'slug' => \Str::slug('Apa itu jaringan?', '-'),
                'level' => 1,
                'skor' => 300,
                'exp' => 300,
                'image' => "blm-upload.png",
                'pembuat' => "Rizal Admin",
                'batas_waktu' => Carbon::now()->subWeek(),
                'kesulitan' => "D",
                'jawaban_pilgan' => "E",
                'pil_A' => "Apa ya",
                'pil_B' => "Apa Hayo",
                'pil_C' => "Apa Cia",
                'pil_D' => "Apa Jaringan",
                'pil_E' => "Komputer yang sailing terhubung",
                'file_pendukung' => null,
                'jenis_soal' => "PILGANDA",
                'status' => "PUBLISH",
                'created_by' => 1,
                'updated_by' => null,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],

        ];

        \DB::table('quests')->insert($quest);
    }
}
