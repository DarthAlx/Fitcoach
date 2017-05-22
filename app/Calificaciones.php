<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calificaciones extends Model
{
  protected $table = 'calificaciones';
  protected $fillable = ['calificacion'];
  public function user()
     {
       return $this->belongsTo('App\User');
     }
}
