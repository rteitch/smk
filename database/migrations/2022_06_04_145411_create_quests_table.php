<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quests', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('deskripsi');
            $table->string('slug')->unique();
            $table->integer('level');
            $table->bigInteger('skor');
            $table->bigInteger('exp');
            $table->string('image')->nullable();
            $table->string('pembuat');
            $table->dateTime("batas_waktu")->nullable();
            // Event, SSS+, SSS, SS, S, A, B, C, D
            $table->string('kesulitan');
            $table->string('jawaban_pilgan')->nullable();
            $table->string('file_pendukung')->nullable();
            $table->enum('jenis_soal', ['PILGANDA', 'LAPORAN']);
            $table->enum('status', ['PUBLISH', 'DRAFT']);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quests');
    }
};
