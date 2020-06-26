<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->String("name");
            $table->String("phone");
            $table->String("email");
            $table->String("note");
            $table->String("address");
            $table->integer('payment_id')->unsigned();
            $table->foreign('payment_id')->references('id')->on('method_payment');
            $table->integer('ship_id')->unsigned();
            $table->foreign('ship_id')->references('id')->on('method_ship');
            $table->integer("user_id")->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
}
