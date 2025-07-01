<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PekerjaanPenghasilan extends Model
{
    protected $table = 'tb_pekerjaan_penghasilan';
    protected $primaryKey = 'nik';
    public $incrementing = false;

    protected $fillable = [
        'nik',
        'jenis_pekerjaan',
        'status_pekerjaan',
        'tempat_pekerjaan',
        'lama_bekerja',
        'jumlah_penghasilan',
        'sumber_penghasilan'
    ];
}
