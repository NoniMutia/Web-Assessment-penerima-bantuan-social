<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatBantuan extends Model
{
    use HasFactory;

    // Nama tabel jika tidak pakai konvensi plural Laravel
    protected $table = 'tb_riwayat_bantuan';

    // Kolom yang dapat diisi
    protected $fillable = [
        'nik',
        'jenis_bantuan',
        'tahun_bantuan',
        'sumber_bantuan',
    ];

    // Jika tidak menggunakan timestamp created_at & updated_at
    public $timestamps = false;

    /**
     * Relasi ke penerima (optional jika ingin ambil nama penerima dari nik)
     */
    public function penerima()
    {
        return $this->belongsTo(PenerimaBantuan::class, 'nik', 'nik');
    }
}
