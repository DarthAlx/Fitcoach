<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalles_instructor extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'detalles_instructor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['photo','rfc','dob', 'tel','user_id'];

    public function user()
       {
         return $this->belongsTo('App\User');
       }
}
