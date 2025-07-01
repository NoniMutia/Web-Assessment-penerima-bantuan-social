<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepemilikanKendaraan extends Model
{
    use HasFactory;

    protected $table = 'tb_kepemilikan_kendaraan';
    protected $primaryKey = 'nik';
    public $incrementing = false;
    protected $keyType = 'string'; // ← penting agar tidak error
    public $timestamps = false;

    protected $fillable = [
        'nik',
        'jenis_kendaraan',
        'jumlah',
    ];
}
