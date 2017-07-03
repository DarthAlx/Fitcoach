<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ordenes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('ordenes', function (Blueprint $table) {
        $table->increments('id');
          $table->string('order_id');
          $table->string('user_id');
          $table->string('name');
          $table->string('unit_price');
          $table->string('metadata');
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
        Schema::drop('ordenes');
    }
}
