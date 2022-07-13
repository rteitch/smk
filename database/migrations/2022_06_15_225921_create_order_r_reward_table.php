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
        Schema::create('order_r_reward', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_r_id');
            $table->unsignedBigInteger('reward_id');
            $table->timestamps();

            $table->foreign('order_r_id')->references('id')->on('order_r_s')->onDelete('cascade');
            $table->foreign('reward_id')->references('id')->on('rewards')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reward_order');
    }
};
