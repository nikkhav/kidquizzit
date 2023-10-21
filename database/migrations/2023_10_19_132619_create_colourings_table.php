<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColouringsTable extends Migration
{
    public function up()
    {
        Schema::create('colourings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained();
            $table->string('image', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('colourings');
    }
}
