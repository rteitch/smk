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
        Schema::create('order_q_quest', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_q_id');
            $table->unsignedBigInteger('quest_id');
            $table->timestamps();

            $table->foreign('order_q_id')->references('id')->on('order_q_s')->onDelete('cascade');
            $table->foreign('quest_id')->references('id')->on('quests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quest_order');
    }
};
