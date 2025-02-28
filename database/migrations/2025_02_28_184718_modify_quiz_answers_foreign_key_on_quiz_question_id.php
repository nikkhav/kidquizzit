<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyQuizAnswersForeignKeyOnQuizQuestionId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quiz_answers', function (Blueprint $table) {
            // Drop the existing foreign key constraint
            $table->dropForeign(['quiz_question_id']);

            // Re-add the foreign key with cascade on delete
            $table->foreign('quiz_question_id')
                ->references('id')
                ->on('quiz_questions')
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
        Schema::table('quiz_answers', function (Blueprint $table) {
            // Drop the foreign key with cascade
            $table->dropForeign(['quiz_question_id']);

            // Re-add the original foreign key without cascade
            $table->foreign('quiz_question_id')
                ->references('id')
                ->on('quiz_questions');
        });
    }
}
