<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loaixe extends Model
{
    protected $fillable = ['tenLX'];
    public $timestamps = false;

    public function taixes()
    {
        return $this->hasMany('App\Taixe');
    }
}
