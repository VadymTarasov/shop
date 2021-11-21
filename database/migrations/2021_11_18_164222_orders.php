<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->integer('id')->index()->autoIncrement();
            $table->integer('user_id')->index();
            $table->longText('cart_data');
            $table->string('address');
            $table->float('total_sum');
            $table->string('phone');
            $table->timestamps();

            $table->primary('id');
        });
    }

   /* { мой вариант
        Schema::create('orders', function (Blueprint $table) {
            $table->string('id')->index();
            $table->longText('cart_data');
            $table->float('total_sum');
            $table->string('phone');
            $table->timestamps();

            $table->primary('id');
        });
    }*/

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
