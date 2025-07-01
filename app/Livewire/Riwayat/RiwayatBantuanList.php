<?php

namespace App\Livewire\Riwayat;

use Livewire\Component;
use App\Models\RiwayatBantuan;
use App\Models\PenerimaBantuan;
use Livewire\WithPagination;

class RiwayatBantuanList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $nik, $jenis_bantuan, $tahun_bantuan, $sumber_bantuan;
    public $selected_nik;
    public $updateMode = false;
    public $keyword = '';

    public function render()
    {
        $data = RiwayatBantuan::where(function ($query) {
            $query->where('nik', 'like', '%' . $this->keyword . '%')
                  ->orWhere('jenis_bantuan', 'like', '%' . $this->keyword . '%');
        })->orderByDesc('tahun_bantuan')->paginate(5);

        return view('livewire.riwayat.riwayat-bantuan-list', [
            'data' => $data,
            'penerimas' => PenerimaBantuan::all()
        ]);
    }

    public function saveRiwayat()
    {
        $this->validate([
            'nik' => 'required|exists:tb_penerima_bantuan,nik|unique:tb_riwayat_bantuan,nik',
            'jenis_bantuan' => 'required|string|max:50',
            'tahun_bantuan' => 'required|digits:4|integer',
            'sumber_bantuan' => 'required|string|max:50',
        ]);

        RiwayatBantuan::create([
            'nik' => $this->nik,
            'jenis_bantuan' => $this->jenis_bantuan,
            'tahun_bantuan' => $this->tahun_bantuan,
            'sumber_bantuan' => $this->sumber_bantuan,
        ]);

        session()->flash('message', 'Riwayat bantuan berhasil disimpan.');
        $this->resetForm();
    }

    public function loadUpdate($nik)
    {
        $data = RiwayatBantuan::where('nik', $nik)->firstOrFail();
        $this->selected_nik = $nik;
        $this->nik = $data->nik;
        $this->jenis_bantuan = $data->jenis_bantuan;
        $this->tahun_bantuan = $data->tahun_bantuan;
        $this->sumber_bantuan = $data->sumber_bantuan;
        $this->updateMode = true;
    }

    public function updateRiwayat()
    {
        $this->validate([
            'jenis_bantuan' => 'required|string|max:50',
            'tahun_bantuan' => 'required|digits:4|integer',
            'sumber_bantuan' => 'required|string|max:50',
        ]);

        RiwayatBantuan::where('nik', $this->selected_nik)->update([
            'jenis_bantuan' => $this->jenis_bantuan,
            'tahun_bantuan' => $this->tahun_bantuan,
            'sumber_bantuan' => $this->sumber_bantuan,
        ]);

        session()->flash('message', 'Riwayat bantuan berhasil diperbarui.');
        $this->resetForm();
    }

    public function deleteConfirmation($nik)
    {
        $this->selected_nik = $nik;
    }

    public function deleteRiwayat()
    {
        RiwayatBantuan::where('nik', $this->selected_nik)->delete();
        session()->flash('message', 'Riwayat bantuan berhasil dihapus.');
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->nik = '';
        $this->jenis_bantuan = '';
        $this->tahun_bantuan = '';
        $this->sumber_bantuan = '';
        $this->selected_nik = '';
        $this->updateMode = false;
    }
}
