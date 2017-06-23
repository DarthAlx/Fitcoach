<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
  protected $table = 'zonas';
  protected $fillable = ['identificador', 'direccion','horario', 'coach', 'clases_id'];
  public function clase()
     {
       return $this->belongsTo('App\Clases');
     }
}
