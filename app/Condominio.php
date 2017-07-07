<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Condominio extends Model
{
  protected $table = 'condominios';
  protected $fillable = ['identificador', 'direccion','imagen','fecha','horario', 'coach','precio','cupo', 'clases_id'];
  public function clase()
     {
       return $this->belongsTo('App\Clases');
     }
}
