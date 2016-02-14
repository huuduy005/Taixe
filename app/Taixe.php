<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taixe extends Model
{
    protected $fillable = [
        'bienso',
        'loaixe_id'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function rate_users()
    {
        return $this->belongsToMany('App\User');
    }

    public function loaixe()
    {
        return $this->belongsTo('App\Loaixe');
    }
}
