<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HorariosCondominio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('horarios_condominios', function (Blueprint $table) {
          $table->increments('id');
          $table->string('fecha');
          $table->string('horario');
          $table->string('coach');
          $table->string('precio');
          $table->string('cupo');
          $table->string('condominio_id');
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
        Schema::drop('horarios_condominios');
    }
}
