<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArtikelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $artikel = [
            [
                'title' => 'Artikel 1',
                'konten' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Saepe, culpa reprehenderit quisquam ipsam consequatur earum laboriosam omnis excepturi perferendis aliquam, non aut repellendus libero harum cum ipsa sint architecto consectetur?',
                'slug' => \Str::slug('Artikel 1', '-'),
                'image' => "blm-upload.png",
                'file_pendukung' => null,
                'status' => "PUBLISH",
                'user_id' => 1,
                'created_by' => 1,
                'updated_by' => null,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'title' => 'Artikel 2',
                'konten' => 'dolor sit, amet consectetur adipisicing elit. Saepe, culpa reprehenderit quisquam ipsam consequatur earum laboriosam omnis excepturi perferendis aliquam, non aut repellendus libero harum cum ipsa sint architecto consectetur?',
                'slug' => \Str::slug('Artikel 2', '-'),
                'image' => "blm-upload.png",
                'file_pendukung' => null,
                'status' => "PUBLISH",
                'user_id' => 1,
                'created_by' => 1,
                'updated_by' => null,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'title' => 'Artikel 3',
                'konten' => 'amet consectetur adipisicing elit. Saepe, culpa reprehenderit quisquam ipsam consequatur earum laboriosam omnis excepturi perferendis aliquam, non aut repellendus libero harum cum ipsa sint architecto consectetur?',
                'slug' => \Str::slug('Artikel 3', '-'),
                'image' => "blm-upload.png",
                'file_pendukung' => null,
                'status' => "PUBLISH",
                'user_id' => 1,
                'created_by' => 1,
                'updated_by' => null,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'title' => 'Artikel 4',
                'konten' => 'adipisicing elit. Saepe, culpa reprehenderit quisquam ipsam consequatur earum laboriosam omnis excepturi perferendis aliquam, non aut repellendus libero harum cum ipsa sint architecto consectetur?',
                'slug' => \Str::slug('Artikel 4', '-'),
                'image' => "blm-upload.png",
                'file_pendukung' => null,
                'status' => "PUBLISH",
                'user_id' => 1,
                'created_by' => 1,
                'updated_by' => null,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'title' => 'Artikel 5',
                'konten' => 'Saepe, culpa reprehenderit quisquam ipsam consequatur earum laboriosam omnis excepturi perferendis aliquam, non aut repellendus libero harum cum ipsa sint architecto consectetur?',
                'slug' => \Str::slug('Artikel 5', '-'),
                'image' => "blm-upload.png",
                'file_pendukung' => null,
                'status' => "PUBLISH",
                'user_id' => 1,
                'created_by' => 1,
                'updated_by' => null,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'title' => 'Artikel 6',
                'konten' => 'culpa reprehenderit quisquam ipsam consequatur earum laboriosam omnis excepturi perferendis aliquam, non aut repellendus libero harum cum ipsa sint architecto consectetur?',
                'slug' => \Str::slug('Artikel 6', '-'),
                'image' => "blm-upload.png",
                'file_pendukung' => null,
                'status' => "PUBLISH",
                'user_id' => 1,
                'created_by' => 1,
                'updated_by' => null,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'title' => 'Artikel 7',
                'konten' => 'quisquam ipsam consequatur earum laboriosam omnis excepturi perferendis aliquam, non aut repellendus libero harum cum ipsa sint architecto consectetur?',
                'slug' => \Str::slug('Artikel 7', '-'),
                'image' => "blm-upload.png",
                'file_pendukung' => null,
                'status' => "PUBLISH",
                'user_id' => 1,
                'created_by' => 1,
                'updated_by' => null,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],

        ];

        \DB::table('artikels')->insert($artikel);
    }
}
