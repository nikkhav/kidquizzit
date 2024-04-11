<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyDifferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('differences', function (Blueprint $table) {
            // Check if the column exists before trying to drop it
            if (Schema::hasColumn('differences', 'image1')) {
                $table->dropColumn('image1');
            }
            if (Schema::hasColumn('differences', 'image2')) {
                $table->dropColumn('image2');
            }

            // Add the new 'image' column
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('differences', function (Blueprint $table) {
            //
        });
    }
}
