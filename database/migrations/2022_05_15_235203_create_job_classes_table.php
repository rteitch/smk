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
        Schema::create('job_classes', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("deskripsi");
            $table->string("slug")->unique();
            $table->string("image")->nullable()->comment("berisi nama file image saja tanpa path");
            $table->integer("created_by");
            $table->string('pembuat');
            $table->integer("updated_by")->nullable();
            $table->integer("deleted_by")->nullable();
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
        Schema::dropIfExists('job_classes');
    }
};
