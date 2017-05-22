<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarjetas extends Model
{
    //
    protected $table = 'tarjetas';
    protected $fillable = ['tarjeta', 'nombre', 'mes', 'año'];
    public function user()
       {
         return $this->belongsTo('App\User');
       }
}
