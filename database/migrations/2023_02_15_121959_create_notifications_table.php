<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete()->comment('Auth id');   
            $table->foreignId('receiver_id')->nullable()->references('id')->on('users')->cascadeOnUpdate()->nullOnDelete()->comment('Receiver id');   
            $table->foreignId('task_id')->references('id')->on('tasks')->cascadeOnDelete();
            $table->string('action');
            $table->timestamp('read_at')->nullable();

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
        Schema::dropIfExists('notifications');
    }
}
