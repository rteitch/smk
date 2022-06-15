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
        Schema::create('artikel_skill', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skill_id')->nullable();
            $table->unsignedBigInteger('artikel_id')->nullable();
            $table->timestamps();

            $table->foreign('skill_id')->references('id')->on('skills');
            $table->foreign('artikel_id')->references('id')->on('artikels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('artikels_skill', function(Blueprint $table){
            $table->dropForeign(['skill_id']);
            $table->dropForeign(['artikel_id']);
        });
        Schema::dropIfExists('artikels_skill');
    }
};
