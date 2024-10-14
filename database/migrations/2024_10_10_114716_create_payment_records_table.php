<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_records', function (Blueprint $table) {
            Schema::create('payment_records', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('seller_id');
                $table->string('payment_method'); // e.g., Bank Transfer, Cash, etc.
                $table->string('payment_details'); // e.g., bank account number, transaction ID
                $table->string('status')->default('pending'); // pending, completed
                $table->timestamps();
        
                $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_records');
    }
}
