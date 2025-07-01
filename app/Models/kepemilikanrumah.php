<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KepemilikanRumah extends Model
{
    protected $table = 'tb_kepemilikan_rumah';
    protected $primaryKey = 'nik';
    public $incrementing = false;

    protected $fillable = [
        'nik',
        'status_rumah',
        'status_tanah',
        'luas_tanah',
        'luas_bangunan'
    ];
}
