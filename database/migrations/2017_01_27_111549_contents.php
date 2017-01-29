<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Contents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->string('title_en', 100);
            $table->string('title_ar', 100);
            $table->text('body_en');
            $table->text('body_ar');
            $table->string('excerpt_en', 200)->nullable();
            $table->string('excerpt_ar', 200)->nullable();
            $table->string('keywords')->nullable();
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
        //
        Schema::dropIfExists('contents');
    }
}
