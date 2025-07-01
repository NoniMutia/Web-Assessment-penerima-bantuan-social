<?php

namespace App\Livewire\Kendaraan;

use App\Models\KepemilikanKendaraan;
use App\Models\PenerimaBantuan;
use Livewire\Component;
use Livewire\WithPagination;

class KepemilikanKendaraanList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $nik, $jenis_kendaraan, $jumlah;
    public $updateMode = false;
    public $keyword;
    public $nikToDelete = null;

    public function render()
    {
        $data = KepemilikanKendaraan::where(function ($query) {
            $query->where('nik', 'like', '%' . $this->keyword . '%')
                  ->orWhere('jenis_kendaraan', 'like', '%' . $this->keyword . '%');
        })->paginate(5);

        $penerimas = PenerimaBantuan::all();

        return view('livewire.kendaraan.kepemilikan-kendaraan-list', compact('data', 'penerimas'));
    }

    public function save()
    {
        $this->validate([
            'nik' => 'required|exists:tb_penerima_bantuan,nik|unique:tb_kepemilikan_kendaraan,nik',
            'jenis_kendaraan' => 'required',
            'jumlah' => 'required|numeric|min:0',
        ]);

        KepemilikanKendaraan::create([
            'nik' => $this->nik,
            'jenis_kendaraan' => $this->jenis_kendaraan,
            'jumlah' => $this->jumlah,
        ]);

        session()->flash('message', 'Data kendaraan berhasil disimpan.');
        $this->resetInput();
    }

    public function edit($nik)
    {
        $item = KepemilikanKendaraan::findOrFail($nik);

        $this->nik = $item->nik;
        $this->jenis_kendaraan = $item->jenis_kendaraan;
        $this->jumlah = $item->jumlah;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'jenis_kendaraan' => 'required',
            'jumlah' => 'required|numeric|min:0',
        ]);

        KepemilikanKendaraan::where('nik', $this->nik)->update([
            'jenis_kendaraan' => $this->jenis_kendaraan,
            'jumlah' => $this->jumlah,
        ]);

        session()->flash('message', 'Data kendaraan berhasil diperbarui.');
        $this->resetInput();
        $this->updateMode = false;
    }

    public function deleteConfirmation($nik)
    {
        $this->nikToDelete = $nik;
    }

    public function deleteKendaraan()
    {
        if ($this->nikToDelete) {
            KepemilikanKendaraan::destroy($this->nikToDelete);
            session()->flash('message', 'Data kendaraan berhasil dihapus.');
            $this->nikToDelete = null;
        }
    }

    private function resetInput()
    {
        $this->nik = '';
        $this->jenis_kendaraan = '';
        $this->jumlah = '';
    }
}
