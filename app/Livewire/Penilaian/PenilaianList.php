<?php

// app/Livewire/Penilaian/PenilaianList.php

namespace App\Livewire\Penilaian;

use Livewire\Component;
use App\Models\PenerimaBantuan;
use App\Models\PekerjaanPenghasilan;
use App\Models\TanggunganAnak;
use App\Models\KepemilikanRumah;
use App\Models\RiwayatBantuan;
use App\Models\KepemilikanKendaraan;

class PenilaianList extends Component
{
    public $keyword = '';

    public function render()
    {
        $data = PenerimaBantuan::all()
            ->map(function ($p) {
                $penghasilan = PekerjaanPenghasilan::where('nik', $p->nik)->first();
                $tanggungan = TanggunganAnak::where('nik', $p->nik)->first();
                $rumah = KepemilikanRumah::where('nik', $p->nik)->first();
                $riwayat = RiwayatBantuan::where('nik', $p->nik)->first();
                $kendaraan = KepemilikanKendaraan::where('nik', $p->nik)->first();

                $skor_penghasilan = match (true) {
                    $penghasilan && $penghasilan->jumlah_penghasilan < 1000000 => 40,
                    $penghasilan && $penghasilan->jumlah_penghasilan < 2000000 => 30,
                    $penghasilan && $penghasilan->jumlah_penghasilan < 3000000 => 20,
                    $penghasilan => 10,
                    default => 0,
                };

                $jumlah_tanggungan = ($tanggungan->jumlah_anak ?? 0) + ($tanggungan->jumlah_lansia ?? 0);
                $skor_tanggungan = match (true) {
                    $jumlah_tanggungan >= 5 => 40,
                    $jumlah_tanggungan >= 3 => 30,
                    $jumlah_tanggungan >= 1 => 20,
                    default => 10,
                };

                $skor_rumah = match (true) {
                    $rumah && $rumah->status_rumah === 'Menumpang' => 40,
                    $rumah && $rumah->status_rumah === 'Sewa' => 30,
                    $rumah && $rumah->status_rumah === 'Milik Sendiri' && $rumah->status_tanah === 'Tidak Milik' => 20,
                    $rumah => 10,
                    default => 0,
                };

                $skor_riwayat = $riwayat ? 10 : 40;

                $skor_kendaraan = match (true) {
                    $kendaraan && $kendaraan->jenis_kendaraan === 'Tidak Ada' => 40,
                    $kendaraan && $kendaraan->jenis_kendaraan === 'Motor' => 30,
                    $kendaraan && $kendaraan->jenis_kendaraan === 'Mobil' => 10,
                    $kendaraan => 10,
                    default => 0,
                };

                $skor_akhir = $skor_penghasilan + $skor_tanggungan + $skor_rumah + $skor_riwayat + $skor_kendaraan;
                $status = $skor_akhir >= 80 ? 'Layak' : 'Tidak Layak';

                return (object)[
                    'nik' => $p->nik,
                    'nama' => $p->nama,
                    'skor_penghasilan' => $skor_penghasilan,
                    'skor_tanggungan' => $skor_tanggungan,
                    'skor_rumah' => $skor_rumah,
                    'skor_riwayat' => $skor_riwayat,
                    'skor_kendaraan' => $skor_kendaraan,
                    'skor_akhir' => $skor_akhir,
                    'status_kelayakan' => $status,
                    'riwayat_bantuan' => $riwayat,
                    'kendaraan' => $kendaraan,
                ];
            })
            ->filter(function ($item) {
                return str_contains(strtolower($item->nik), strtolower($this->keyword))
                    || str_contains(strtolower($item->nama), strtolower($this->keyword))
                    || str_contains(strtolower($item->status_kelayakan), strtolower($this->keyword));
            });

        return view('livewire.penilaian.penilaian-list', [
            'data' => $data,
            'downloadUrl' => route('penilaian.export')
        ]);
    }
}
