<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('websites', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->longText('website');
            $table->string('payment')->default('Un-Paid');
            $table->string('amount')->nullable();
            $table->string('subscription_date');
            $table->tinyInteger('status')->default(1)->comment("0:active, 1:lead");
            $table->string('plan')->nullable();
            $table->longText('subscription_id')->nullable();
            $table->longText('token_id')->nullable();
            $table->longText('website_data')->nullable();
            $table->tinyInteger('verification')->nullable()->comment('0:Incomplete, 1: Verified');

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
        Schema::dropIfExists('websites');
    }
}
