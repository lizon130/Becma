<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_image')->nullable();   // For profile image (URL or path)
            $table->string('nid')->nullable();             // For National ID (Nid)
            $table->date('dob')->nullable();               // For Date of Birth
            $table->string('address')->nullable();         // For Address
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['profile_image', 'nid', 'dob', 'address']);
        });
    }
}
