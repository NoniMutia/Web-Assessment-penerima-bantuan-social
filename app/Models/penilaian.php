<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $table = 'tb_penilaian';
    protected $primaryKey = 'nik';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'nik',
        'skor_penghasilan',
        'skor_tanggungan',
        'skor_rumah',
        'tanggal_penilaian'
    ];

    public function penerima()
    {
        return $this->belongsTo(PenerimaBantuan::class, 'nik', 'nik');
    }

    public function getSkorAkhirAttribute()
    {
        return $this->skor_penghasilan + $this->skor_tanggungan + $this->skor_rumah;
    }

    public function getStatusKelayakanAttribute()
    {
        return $this->skor_akhir >= 80 ? 'Layak' : 'Tidak Layak';
    }

    public static function hitungSkor($nik)
    {
        $penghasilan = Penghasilan::where('nik', $nik)->first();
        $tanggungan = TanggunganAnak::where('nik', $nik)->first();
        $rumah = KepemilikanRumah::where('nik', $nik)->first();

        $skor_penghasilan = match (true) {
            $penghasilan && $penghasilan->jumlah_penghasilan < 1000000 => 40,
            $penghasilan && $penghasilan->jumlah_penghasilan < 2000000 => 30,
            $penghasilan && $penghasilan->jumlah_penghasilan < 3000000 => 20,
            default => 10
        };

        $skor_tanggungan = match (true) {
            $tanggungan && $tanggungan->jumlah_anak + $tanggungan->jumlah_lansia >= 5 => 40,
            $tanggungan && $tanggungan->jumlah_anak + $tanggungan->jumlah_lansia >= 3 => 30,
            $tanggungan && $tanggungan->jumlah_anak + $tanggungan->jumlah_lansia >= 1 => 20,
            default => 10
        };

        $skor_rumah = match (true) {
            $rumah && $rumah->status_rumah === 'Menumpang' => 40,
            $rumah && $rumah->status_rumah === 'Sewa' => 30,
            $rumah && $rumah->status_rumah === 'Milik Sendiri' && $rumah->status_tanah === 'Tidak Milik' => 20,
            default => 10
        };

        return [
            'skor_penghasilan' => $skor_penghasilan,
            'skor_tanggungan' => $skor_tanggungan,
            'skor_rumah' => $skor_rumah,
            'skor_akhir' => $skor_penghasilan + $skor_tanggungan + $skor_rumah,
            'status_kelayakan' => $skor_penghasilan + $skor_tanggungan + $skor_rumah >= 80 ? 'Layak' : 'Tidak Layak'
        ];
    }
}
