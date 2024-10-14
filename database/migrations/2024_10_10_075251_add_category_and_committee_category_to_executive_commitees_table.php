<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryAndCommitteeCategoryToExecutiveCommiteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('executive_commitees', function (Blueprint $table) {
            $table->string('committee_category')->nullable(); // Add committee_category column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('executive_commitees', function (Blueprint $table) {
            $table->dropColumn('committee_category');
        });
    }
}
