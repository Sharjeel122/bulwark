<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketers', function (Blueprint $table) {
            $table->id();
            $table->string("user_name");
            $table->string("user_email");
            $table->string("website_url");
            $table->string("front_heading");
            $table->string("future_image");
            $table->string("check_speed_mobile");
            $table->string("check_speed_pc");
            $table->string("gt_matrix_summry");
            $table->string("gt_matrix_highlit_issue");
            $table->string("description");

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
        Schema::dropIfExists('marketers');
    }
}
