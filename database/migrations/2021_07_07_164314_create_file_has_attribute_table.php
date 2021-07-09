<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileHasAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_has_attribute', function (Blueprint $table) {
            $table->unsignedBigInteger('file_id');
            $table->unsignedBigInteger('attribute_id');
            $table->unsignedSmallInteger('order')->default(0);

            $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('RESTRICT');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_has_attribute');
    }
}
