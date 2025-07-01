<?php

namespace App\Livewire\Pekerjaan;

use App\Models\PekerjaanPenghasilan;
use App\Models\PenerimaBantuan;
use Livewire\Component;
use Livewire\WithPagination;

class PekerjaanPenghasilanList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $nik, $jenis_pekerjaan, $status_pekerjaan, $tempat_pekerjaan, $lama_bekerja, $jumlah_penghasilan, $sumber_penghasilan;
    public $updateMode = false;
    public $keyword;

    public $selected_nik; // untuk keperluan hapus

    public function render()
    {
        $data = PekerjaanPenghasilan::where('nik', 'like', '%' . $this->keyword . '%')->paginate(5);
        $penerimas = PenerimaBantuan::all();

        return view('livewire.pekerjaan.pekerjaan-penghasilan-list', compact('data', 'penerimas'));
    }

    public function save()
    {
        $this->validate([
            'nik' => 'required',
            'jenis_pekerjaan' => 'required',
            'jumlah_penghasilan' => 'required|numeric',
        ]);

        PekerjaanPenghasilan::create([
            'nik' => $this->nik,
            'jenis_pekerjaan' => $this->jenis_pekerjaan,
            'status_pekerjaan' => $this->status_pekerjaan,
            'tempat_pekerjaan' => $this->tempat_pekerjaan,
            'lama_bekerja' => $this->lama_bekerja,
            'jumlah_penghasilan' => $this->jumlah_penghasilan,
            'sumber_penghasilan' => $this->sumber_penghasilan,
        ]);

        session()->flash('message', 'Data berhasil disimpan.');
        $this->resetInput();
    }

    public function edit($nik)
    {
        $item = PekerjaanPenghasilan::findOrFail($nik);
        $this->nik = $item->nik;
        $this->jenis_pekerjaan = $item->jenis_pekerjaan;
        $this->status_pekerjaan = $item->status_pekerjaan;
        $this->tempat_pekerjaan = $item->tempat_pekerjaan;
        $this->lama_bekerja = $item->lama_bekerja;
        $this->jumlah_penghasilan = $item->jumlah_penghasilan;
        $this->sumber_penghasilan = $item->sumber_penghasilan;
        $this->updateMode = true;
    }

    public function update()
    {
        PekerjaanPenghasilan::where('nik', $this->nik)->update([
            'jenis_pekerjaan' => $this->jenis_pekerjaan,
            'status_pekerjaan' => $this->status_pekerjaan,
            'tempat_pekerjaan' => $this->tempat_pekerjaan,
            'lama_bekerja' => $this->lama_bekerja,
            'jumlah_penghasilan' => $this->jumlah_penghasilan,
            'sumber_penghasilan' => $this->sumber_penghasilan,
        ]);

        session()->flash('message', 'Data berhasil diperbarui.');
        $this->resetInput();
        $this->updateMode = false;
    }

    public function deleteConfirmation($nik)
    {
        $this->selected_nik = $nik;
    }

    public function deletePekerjaan()
    {
        if ($this->selected_nik) {
            PekerjaanPenghasilan::destroy($this->selected_nik);
            session()->flash('message', 'Data berhasil dihapus.');
            $this->resetInput();
            $this->selected_nik = null;
        }
    }

    private function resetInput()
    {
        $this->nik = '';
        $this->jenis_pekerjaan = '';
        $this->status_pekerjaan = '';
        $this->tempat_pekerjaan = '';
        $this->lama_bekerja = '';
        $this->jumlah_penghasilan = '';
        $this->sumber_penghasilan = '';
        $this->updateMode = false;
    }
}
