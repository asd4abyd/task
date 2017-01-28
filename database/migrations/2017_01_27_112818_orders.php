<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
Schema::create('orders', function (Blueprint $table) {
    $table->increments('id');
    $table->text('products');
    $table->boolean('done');
    $table->integer('status');
    $table->dateTime('status_date');
    $table->integer('user_id');
    $table->decimal('total_price', 10, 2);
    $table->string('keywords');
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
        Schema::dropIfExists('orders');

    }
}
