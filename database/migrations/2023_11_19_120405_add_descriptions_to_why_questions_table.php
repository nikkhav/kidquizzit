<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescriptionsToWhyQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('why_questions', function (Blueprint $table) {
            $table->text('description2')->nullable()->after('description');
            $table->text('description3')->nullable()->after('description2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('why_questions', function (Blueprint $table) {
            $table->dropColumn('description2');
            $table->dropColumn('description3');
        });
    }
}
