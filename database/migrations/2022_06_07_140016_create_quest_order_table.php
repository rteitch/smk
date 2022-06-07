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
        Schema::create('quest_order', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_q_s_id');
            $table->unsignedBigInteger('quest_id');
            $table->string('file_jawab')->nullable();
            $table->string('jawaban_pilgan')->nullable();
            $table->timestamps();

            $table->foreign('order_q_s_id')->references('id')->on('order_q_s');
            $table->foreign('quest_id')->references('id')->on('quests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quest_order', function(Blueprint $table){
            $table->dropForeign(['order_q_id']);
            $table->dropForeign(['quest_id']);
        });
        Schema::dropIfExists('quest_order');
    }
};
