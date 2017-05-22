<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalles extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'detalles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['dob', 'accept', 'tel', 'rating','user_id'];

    public function user()
       {
         return $this->belongsTo('App\User');
       }

}
