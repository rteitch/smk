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
        Schema::create('artikels', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("konten");
            $table->string("slug")->unique();
            $table->string("image")->nullable()->comment("berisi nama file image saja tanpa path");
            $table->string("file_pendukung")->nullable()->comment("berisi nama file pendukung saja tanpa path");
            $table->enum('status', ['PUBLISH', 'DRAFT']);
            $table->foreignId("user_id")->constrained();
            $table->integer("created_by");
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
        Schema::table('artikels', function(Blueprint $table){
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('artikels');
    }
};
