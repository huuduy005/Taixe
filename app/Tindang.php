<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Tindang extends Model
{
    protected $fillable=[
        'tieude',
        'noidi',
        'thanhphonoidi',
        'noiden',
        'thanhphonoiden',
        'noidung',
        'user_id',
        'giokhoihanh',
        'ngaykhoihanh',
        'khoihanh',
        'giave',
        'loaixe_id',
        'loaitin_id'
    ];

    public $timestamps = false;

    protected $dates = ['ngaydang', 'TG_capnhatlotrinh'];

    public function getNgaydangAttribute($date) {
        return Carbon::parse($date)->format('H:i - d/m/Y');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function loaitin()
    {
        return $this->belongsTo('App\Loaitin');
    }

    public function save_users()
    {
        return $this->belongsToMany('App\User');
    }

}
