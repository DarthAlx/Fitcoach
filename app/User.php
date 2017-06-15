<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'role','clases'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    public function detalles()
    {
        return $this->hasOne('App\Detalles');
    }
    public function direcciones()
    {
        return $this->hasMany('App\Direcciones');
    }
    public function tarjetas()
    {
        return $this->hasMany('App\Tarjetas');
    }
    public function detalles_instructor()
    {
        return $this->hasOne('App\Detalles_instructor');
    }
    public function vehiculos()
    {
        return $this->hasMany('App\Vehiculo');
    }
    public function horarios()
     {
       return $this->hasMany('App\Horarios');
     }
/*
    public function calificaciones()
    {
        return $this->hasMany('App\Calificaciones');
    }
    */
}
