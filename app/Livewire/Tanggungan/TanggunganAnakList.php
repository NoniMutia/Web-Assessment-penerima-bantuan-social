<?php

namespace App\Livewire\Tanggungan;

use App\Models\TanggunganAnak;
use App\Models\PenerimaBantuan;
use Livewire\Component;
use Livewire\WithPagination;

class TanggunganAnakList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $nik, $jumlah_anak, $jumlah_lansia, $usia_anak, $status_pendidikan_anak;
    public $updateMode = false;
    public $keyword;

    // Tambahan untuk hapus
    public $nikToDelete = null;

    public function render()
    {
        $data = TanggunganAnak::where('nik', 'like', '%' . $this->keyword . '%')->paginate(5);
        $penerimas = PenerimaBantuan::all();
        return view('livewire.tanggungan.tanggungan-anak-list', compact('data', 'penerimas'));
    }

    public function save()
    {
        $this->validate([
            'nik' => 'required|numeric',
        ]);

        TanggunganAnak::create([
            'nik' => $this->nik,
            'jumlah_anak' => $this->jumlah_anak,
            'jumlah_lansia' => $this->jumlah_lansia,
            'usia_anak' => $this->usia_anak,
            'status_pendidikan_anak' => $this->status_pendidikan_anak
        ]);

        session()->flash('message', 'Data berhasil disimpan');
        $this->resetInput();
    }

    public function edit($id)
    {
        $data = TanggunganAnak::findOrFail($id);
        $this->nik = $data->nik;
        $this->jumlah_anak = $data->jumlah_anak;
        $this->jumlah_lansia = $data->jumlah_lansia;
        $this->usia_anak = $data->usia_anak;
        $this->status_pendidikan_anak = $data->status_pendidikan_anak;
        $this->updateMode = true;
    }

    public function update()
    {
        TanggunganAnak::where('nik', $this->nik)->update([
            'jumlah_anak' => $this->jumlah_anak,
            'jumlah_lansia' => $this->jumlah_lansia,
            'usia_anak' => $this->usia_anak,
            'status_pendidikan_anak' => $this->status_pendidikan_anak
        ]);

        session()->flash('message', 'Data berhasil diperbarui');
        $this->resetInput();
        $this->updateMode = false;
    }

    // Tambahan untuk hapus via modal
    public function deleteConfirmation($nik)
    {
        $this->nikToDelete = $nik;
    }

    public function deleteTanggungan()
    {
        if ($this->nikToDelete) {
            TanggunganAnak::destroy($this->nikToDelete);
            session()->flash('message', 'Data berhasil dihapus');
            $this->nikToDelete = null;
        }
    }

    private function resetInput()
    {
        $this->nik = '';
        $this->jumlah_anak = '';
        $this->jumlah_lansia = '';
        $this->usia_anak = '';
        $this->status_pendidikan_anak = '';
    }
}
