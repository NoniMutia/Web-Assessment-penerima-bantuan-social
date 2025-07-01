<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TanggunganAnak extends Model
{
    protected $table = 'tb_tanggungan_anak';
    protected $primaryKey = 'nik';
    public $incrementing = false;

    protected $fillable = [
        'nik',
        'jumlah_anak',
        'jumlah_lansia',
        'usia_anak',
        'status_pendidikan_anak'
    ];
}
