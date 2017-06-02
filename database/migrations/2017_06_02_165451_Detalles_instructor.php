<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetallesInstructor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('detalles_instructor', function (Blueprint $table) {
          $table->increments('id');
          $table->string('photo');
          $table->string('rfc');
          $table->string('dob');
          $table->string('tel');
          $table->string('user_id');
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
        Schema::drop('detalles_instructor');
    }
}
