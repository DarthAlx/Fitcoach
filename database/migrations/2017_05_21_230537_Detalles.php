<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Detalles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('detalles', function (Blueprint $table) {
          $table->increments('id');
          $table->string('foto');
          $table->string('dob');
          $table->string('accept')->default('Sí');
          $table->string('tel');
          $table->string('rating')->default(0);
          $table->integer('user_id');
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
        Schema::drop('detalles');
    }
}
