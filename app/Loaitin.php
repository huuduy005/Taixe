<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loaitin extends Model
{
    public $timestamps = false;

    protected $fillable = [
      'tenLT', 'giatien'
    ];

    public function tindangs()
    {
        return $this->hasMany('App\Tindang');
    }
}
