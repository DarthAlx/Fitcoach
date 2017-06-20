<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horarios extends Model
{
  protected $table = 'horarios';
  protected $fillable = ['user_id', 'clases_id','hora','fecha','recurrencia'];
  public function clases()
     {
       return $this->belongsTo('App\Clases');
     }

     public function user()
        {
          return $this->belongsTo('App\User');
        }

}
