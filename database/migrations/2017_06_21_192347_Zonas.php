<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Zonas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('zonas', function (Blueprint $table) {
          $table->increments('id');
          $table->string('identificador');
          $table->string('direccion');
          $table->string('latitud');
          $table->string('longitud');
          $table->string('clases_id');
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
        Schema::drop('zonas');
    }
}
