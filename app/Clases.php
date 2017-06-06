<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clases extends Model
{
  protected $table = 'clases';
  protected $fillable = ['nombre', 'tipo','descripcion','imagen', 'precio', 'precio_especial'];
  public function horarios()
     {
       return $this->hasMany('App\Horarios');
     }
}
