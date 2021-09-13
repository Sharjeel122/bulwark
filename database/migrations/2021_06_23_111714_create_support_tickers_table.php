<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportTickersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_tickers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');

             $table->unsignedBigInteger('website_id')->nullable();
            $table->foreign('website_id')->references('id')->on('websites')->onDelete('cascade');

            $table->longText('subject');
            $table->longText('message');
            $table->string('priority');
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('pre_link')->default(0);

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
        Schema::dropIfExists('support_tickers');
    }
}
