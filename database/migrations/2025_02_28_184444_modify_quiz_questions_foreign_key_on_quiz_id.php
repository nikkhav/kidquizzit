<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyQuizQuestionsForeignKeyOnQuizId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quiz_questions', function (Blueprint $table) {
            // Drop the existing foreign key
            $table->dropForeign(['quiz_id']);

            // Re-add the foreign key with cascading delete
            $table->foreign('quiz_id')
                ->references('id')
                ->on('quizzes')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quiz_questions', function (Blueprint $table) {
            // Drop the foreign key with cascade
            $table->dropForeign(['quiz_id']);

            // Re-add the original foreign key without cascade
            $table->foreign('quiz_id')
                ->references('id')
                ->on('quizzes');
        });
    }
}
