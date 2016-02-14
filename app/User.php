<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin', 'email', 'password','hoten','SDT'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public $timestamps = false;

    public function is($input){
        if($this->attributes[$input] == true){
            return true;
        }
        return false;
    }


    public function taixe()
    {
        return $this->hasOne('App\Taixe');
    }


    public function tindangs()
    {
        return $this->hasMany('App\Tindang');
    }

    public function rate_taixes()
    {
        return $this->belongsToMany('App\Taixe');
    }

    public function save_tindangs()
    {
        return $this->belongsToMany('App\Tindang');
    }

}
