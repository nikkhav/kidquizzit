<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->nullable()->references('id')->on('customer_types')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->text('customer_number');
            $table->string('fullname');
            $table->string('voen');
            $table->string('phone');
            $table->string('email');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
