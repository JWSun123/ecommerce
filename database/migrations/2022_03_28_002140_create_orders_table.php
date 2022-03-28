<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('apartment')->default('NULL')->nullable();
            $table->string('city');
            $table->string('province');
            $table->string('country');
            $table->string('postalcode');
            $table->string('total_amount');
            $table->string('payment_mode')->nullable();
            $table->string('payment_id')->nullable();
            $table->tinyInteger('status')->default('0'); //processing: 0, shipped: 1
            $table->string('message')->nullable();
            $table->string('tracking_no');
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
        Schema::dropIfExists('orders');
    }
};
