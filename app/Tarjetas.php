<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarjetas extends Model
{
    //
    protected $table = 'tarjetas';
    protected $fillable = ['identificador','num', 'mes', 'año', 'nombre', 'user_id'];
    public function user()
       {
         return $this->belongsTo('App\User');
       }
}
