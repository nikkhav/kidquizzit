<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('project')->nullable();
            $table->string('title');
            $table->longText('description')->nullable();
            $table->foreignId('status_id')->nullable()->references('id')->on('statuses')->constrained()->onDelete('cascade');
            $table->foreignId('department_id')->nullable()->references('id')->on('departments')->constrained()->onDelete('cascade');
            $table->foreignId('priority_id')->nullable()->references('id')->on('priorities');
            $table->dateTime('start');
            $table->dateTime('deadline')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
