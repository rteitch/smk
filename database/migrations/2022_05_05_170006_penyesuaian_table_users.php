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
        Schema::table('users', function (Blueprint $table){
            $table->string("username")->unique();
            $table->string("roles");
            $table->text("alamat")->nullable();
            // nomor induk siswa / pegawai (nis/nip)
            $table->integer("nomor_induk")->nullable();
            $table->string("phone")->nullable();
            $table->string("tempat_lahir")->nullable();
            $table->date("tanggal_lahir")->nullable();
            $table->integer("level");
            $table->bigInteger("skor");
            $table->bigInteger("exp");
            $table->string("gender");
            $table->string("avatar")->nullable();
            $table->string("background")->nullable();
            // 0 = Tidak Aktif, 1 = Aktif
            $table->enum("status", ["on", "off"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
