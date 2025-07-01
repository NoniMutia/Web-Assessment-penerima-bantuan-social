<?php

namespace App\Livewire\Machines;

use App\Models\TmMachine;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class MachineList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $no_machine;
    public $type_machine;
    public $seri;

    public $updateMode = false;
    public $keyword;
    protected $queryString = ['keyword'];


    public function updateKeyword()
    {
        // Reset pagination ke halaman pertama saat keyword berubah
        $this->resetPage();
    }
    #[Title('Wash Machines')]
    public function render()
    {
        $keyword = $this->keyword;
        if ($keyword!=null) {
            $data = DB::table('tm_machines')
                ->where(function ($query) use ($keyword) {
                    $query->where('no_machine', 'like', '%' . $keyword . '%')
                        ->orWhere('type_machine', 'like', '%' . $keyword . '%')
                        ->orWhere('seri', 'like', '%' . $keyword . '%');
                });
        } else {
            $data = DB::table('tm_machines')
                    ->orderBy('id', 'asc')
                    ->paginate(3)
                    ->withQueryString();
        }
        return view('livewire.machines.machine-list', [
            'tm_machines' => $data
        ]);
    }

    /** Save */
    public function saveMachine()
    {
        $rules = [
            'type_machine'=>'required',
            'seri'=>'required',
        ];
        $err_msg = [
            'type_machine.required'=>'Type must be selected',
            'seri.required'=>'Series can not be empty',
        ];
        $validated = $this->validate($rules,$err_msg);

        /** Generate kode vendor */
        $validated['no_machine'] = $this->generateNoMachine();
        TmMachine::create($validated);
        $this->resetForm();
        session()->flash('message','Data inserted successfully');
    }

    /** Generate No Machine */
    public function generateNoMachine()
    {
        // Hitung jumlah vendor yang sudah ada
        $vendorCount = TmMachine::count();
        
        // // Format XX (2 digit) dari jumlah vendor
        // $xx = str_pad($vendorCount + 1, 2, '0', STR_PAD_LEFT);
        
        // Format 0001 (4 digit) dari jumlah vendor + 1
        $sequence = str_pad($vendorCount + 1, 3, '0', STR_PAD_LEFT);
        
        return "VND{$sequence}";
    }

    /** Reset */
    private function resetForm()
    {
        $this->no_machine = null;
        $this->type_machine = null;
        $this->seri = null;
        $this->updateMode = false;
    }

    /** Population Form */
    public function loadUpdate($paramNoMachine)
    {
        $data = TmMachine::where('no_machine', $paramNoMachine)->firstOrFail();
        $this->no_machine = $data->no_machine;
        $this->type_machine = $data->type_machine;
        $this->seri = $data->seri;
        $this->updateMode = true;
    }

    /** Update  */
    public function updateMachine()
    {
        $rules = [
            'no_machine'=>'required',
            'type_machine'=>'required',
            'seri'=>'required',
        ];
        $err_msg = [
            'no_machine.required'=>'No Machine Code can not be empty',
            'type_machine.required'=>'Type must be selected',
            'seri.required'=>'Series can not be empty',
        ];

        $this->validate($rules,$err_msg);
        TmMachine::where('no_machine', $this->no_machine)->update([
            'type_machine' => $this->type_machine,
            'seri' => $this->seri,
        ]);
    
        $this->resetForm(); // Reset form setelah update
        session()->flash('message', 'Data updated successfully');
    }
}
