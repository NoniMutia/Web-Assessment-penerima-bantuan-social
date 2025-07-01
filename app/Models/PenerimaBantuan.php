<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaBantuan extends Model
{
    use HasFactory;

    protected $table = 'tb_penerima_bantuan'; // Pastikan nama tabel sesuai

    // Tambahkan atribut yang dapat diisi secara massal
    protected $fillable = [
        'nik', // Nomor Induk Kependudukan
        'nama', // Nama penerima
        'alamat', // Alamat penerima
        'tanggal_lahir', // tanggal lahir
        'jenis_kelamin', // Jenis kelamin
        'no_hp', // Nomor HP
        'tanggal_survei' // Tanggal survei
    ];
}
