<?php

namespace App\Livewire\Penerima;

use App\Models\PenerimaBantuan;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

class PenerimaList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $selected_nik;
    public $nik;
    public $nama;
    public $alamat;
    public $tanggal_lahir;
    public $jenis_kelamin;
    public $no_hp;

    public $updateMode = false;
    public $keyword;
    protected $queryString = ['keyword'];

    public function updatedKeyword()
    {
        $this->resetPage();
    }

    #[Title('Data Penerima Bantuan')]
    public function render()
    {
        $keyword = $this->keyword;

        $query = PenerimaBantuan::query();

        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('nik', 'like', '%' . $keyword . '%')
                  ->orWhere('nama', 'like', '%' . $keyword . '%')
                  ->orWhere('no_hp', 'like', '%' . $keyword . '%');
            });
        }

        $data = $query->orderBy('nama')->paginate(5)->withQueryString();

        return view('livewire.penerima.penerima-list', [
            'penerima' => $data
        ]);
    }

    /** Simpan Data */
    public function savePenerima()
    {
        $rules = [
            'nik' => 'required|unique:tb_penerima_bantuan,nik',
            'nama' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required'
        ];

        $messages = [
            'nik.required' => 'NIK wajib diisi',
            'nik.unique' => 'NIK sudah terdaftar',
            'nama.required' => 'Nama wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'no_hp.required' => 'No HP wajib diisi',
        ];

        $this->validate($rules, $messages);

        PenerimaBantuan::create([
            'nik' => $this->nik,
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'tanggal_lahir' => $this->tanggal_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'no_hp' => $this->no_hp,
        ]);

        $this->resetForm();
        session()->flash('message', 'Data berhasil disimpan');
    }

    /** Load Data ke Form */
    public function loadUpdate($nik)
    {
        $data = PenerimaBantuan::where('nik', $nik)->firstOrFail();
        $this->selected_nik = $data->nik;
        $this->nik = $data->nik;
        $this->nama = $data->nama;
        $this->alamat = $data->alamat;
        $this->tanggal_lahir = $data->tanggal_lahir;
        $this->jenis_kelamin = $data->jenis_kelamin;
        $this->no_hp = $data->no_hp;
        $this->updateMode = true;
    }

    /** Update Data */
    public function updatePenerima()
    {
        $rules = [
            'nik' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required'
        ];

        $messages = [
            'nik.required' => 'NIK wajib diisi',
            'nama.required' => 'Nama wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'no_hp.required' => 'No HP wajib diisi',
        ];

        $this->validate($rules, $messages);

        if ($this->selected_nik) {
            PenerimaBantuan::where('nik', $this->selected_nik)->update([
                'nik' => $this->nik,
                'nama' => $this->nama,
                'alamat' => $this->alamat,
                'tanggal_lahir' => $this->tanggal_lahir,
                'jenis_kelamin' => $this->jenis_kelamin,
                'no_hp' => $this->no_hp
            ]);
        }

        $this->resetForm();
        session()->flash('message', 'Data berhasil diperbarui');
    }

    /** Hapus Data */
    public function deleteConfirmation($nik)
    {
        $this->selected_nik = $nik;
    }

    public function deletePenerima()
    {
        if ($this->selected_nik) {
            PenerimaBantuan::where('nik', $this->selected_nik)->delete();
            session()->flash('message', 'Data berhasil dihapus');
            $this->resetForm();
        }
    }

    /** Reset Form */
    private function resetForm()
    {
        $this->selected_nik = null;
        $this->nik = '';
        $this->nama = '';
        $this->alamat = '';
        $this->tanggal_lahir = '';
        $this->jenis_kelamin = '';
        $this->no_hp = '';
        $this->updateMode = false;
    }
}
