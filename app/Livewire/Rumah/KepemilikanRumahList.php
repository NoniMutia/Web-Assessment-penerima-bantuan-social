<?php

namespace App\Livewire\Rumah;

use App\Models\KepemilikanRumah;
use App\Models\PenerimaBantuan;
use Livewire\Component;
use Livewire\WithPagination;

class KepemilikanRumahList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $nik, $status_rumah, $status_tanah, $luas_tanah, $luas_bangunan;
    public $updateMode = false;
    public $keyword;

    // Untuk hapus data
    public $nikToDelete = null;

    public function render()
    {
        $data = KepemilikanRumah::where('nik', 'like', '%' . $this->keyword . '%')->paginate(5);
        $penerimas = PenerimaBantuan::all();

        return view('livewire.rumah.kepemilikan-rumah-list', compact('data', 'penerimas'));
    }

    public function save()
    {
        $this->validate([
            'nik' => 'required',
            'status_rumah' => 'required',
            'status_tanah' => 'required',
        ]);

        KepemilikanRumah::create([
            'nik' => $this->nik,
            'status_rumah' => $this->status_rumah,
            'status_tanah' => $this->status_tanah,
            'luas_tanah' => $this->luas_tanah,
            'luas_bangunan' => $this->luas_bangunan,
        ]);

        session()->flash('message', 'Data berhasil disimpan.');
        $this->resetInput();
    }

    public function edit($nik)
    {
        $item = KepemilikanRumah::findOrFail($nik);
        $this->nik = $item->nik;
        $this->status_rumah = $item->status_rumah;
        $this->status_tanah = $item->status_tanah;
        $this->luas_tanah = $item->luas_tanah;
        $this->luas_bangunan = $item->luas_bangunan;
        $this->updateMode = true;
    }

    public function update()
    {
        KepemilikanRumah::where('nik', $this->nik)->update([
            'status_rumah' => $this->status_rumah,
            'status_tanah' => $this->status_tanah,
            'luas_tanah' => $this->luas_tanah,
            'luas_bangunan' => $this->luas_bangunan,
        ]);

        session()->flash('message', 'Data berhasil diperbarui.');
        $this->resetInput();
        $this->updateMode = false;
    }

    // 🔴 Tambahan untuk hapus via modal
    public function deleteConfirmation($nik)
    {
        $this->nikToDelete = $nik;
    }

    public function deleteRumah()
    {
        if ($this->nikToDelete) {
            KepemilikanRumah::destroy($this->nikToDelete);
            session()->flash('message', 'Data berhasil dihapus.');
            $this->nikToDelete = null;
        }
    }

    private function resetInput()
    {
        $this->nik = '';
        $this->status_rumah = '';
        $this->status_tanah = '';
        $this->luas_tanah = '';
        $this->luas_bangunan = '';
    }
}
