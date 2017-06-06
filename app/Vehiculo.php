<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
  protected $table = 'vehiculos';
  protected $fillable = ['identificador', 'tipo','modelo','color', 'placa','user_id'];
  public function user()
     {
       return $this->belongsTo('App\User');
     }
}
