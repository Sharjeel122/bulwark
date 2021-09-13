<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaypalPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paypal_plans', function (Blueprint $table) {
            $table->id();
            $table->string('plan_id');
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->string('price')->nullable();
            $table->string('frequency_month')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('paypal_plans');
    }
}
