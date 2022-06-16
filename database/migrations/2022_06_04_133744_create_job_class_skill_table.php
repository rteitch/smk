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
        Schema::create('job_class_skill', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_class_id')->nullable();
            $table->unsignedBigInteger('skill_id')->nullable();
            $table->timestamps();

            $table->foreign('job_class_id')->references('id')->on('job_classes');
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
        Schema::dropIfExists('job_class_skill');
    }
};
