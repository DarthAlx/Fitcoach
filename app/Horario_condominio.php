<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario_condominio extends Model
{
  protected $table = 'condominios';
  protected $fillable = ['fecha','horario', 'coach','precio','cupo','condominio_id', 'clases_id'];
  public function clase(){
       return $this->belongsTo('App\Clases');
  }
  public function condominio(){
       return $this->belongsTo('App\Condominio');
  }
}
