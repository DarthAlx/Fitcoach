<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
  protected $table = 'ordenes';
  protected $fillable = ['id', 'user_id','name','unit_price', 'metadata'];
  public function user()
     {
       return $this->belongsTo('App\User');
     }
}
