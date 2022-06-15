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
        Schema::create('quest_skill', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quest_id')->nullable();
            $table->unsignedBigInteger('skill_id')->nullable();
            $table->timestamps();

            $table->foreign('quest_id')->references('id')->on('quests');
            $table->foreign('skill_id')->references('id')->on('skills');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quest_skill', function(Blueprint $table){
            $table->dropForeign(['quest_id']);
            $table->dropForeign(['skill_id']);
        });
        Schema::dropIfExists('quest_skill');
    }
};
