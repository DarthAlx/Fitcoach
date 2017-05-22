<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direcciones extends Model
{
  protected $table = 'direcciones';
  protected $fillable = ['identificador', 'calle','numero', 'colonia', 'delegacion-municipio','estado', 'cp'];
  public function user()
     {
       return $this->belongsTo('App\User');
     }
}
