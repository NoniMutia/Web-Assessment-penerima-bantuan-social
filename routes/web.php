<?php

use App\Livewire\Auth\Login;
use App\Livewire\Dashboard;
use App\Livewire\Machines\MachineList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Penerima\PenerimaList;
use App\Livewire\riwayat\RiwayatBantuanList;
use App\Livewire\Tanggungan\TanggunganAnakList;
use App\Livewire\Rumah\KepemilikanRumahList;
use App\Livewire\Kendaraan\KepemilikanKendaraanList;
use App\Livewire\Pekerjaan\PekerjaanPenghasilanList;
use App\Livewire\Penilaian\PenilaianList;
use App\Http\Controllers\ExportPenilaianController;

Route::get('/penilaian/export', [ExportPenilaianController::class, 'export'])->name('penilaian.export');


Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('components.layouts.auth');
})->middleware('auth');

// Route::get('/', Login::class);
Route::get('/login', Login::class)
    ->middleware('guest')
    ->name('login');

Route::get('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->flush();
    return redirect("/");
})->name('logout');

// Route::get('/dashboard', Dashboard::class)->name('dashboard');
Route::get('/dashboard', Dashboard::class)
    ->middleware(middleware: 'auth')
    ->name(name: 'dashboard'); 

Route::get('/wash_machines', MachineList::class)
    ->middleware(middleware:'auth')
    ->name('wash_machines');

Route::get('/data-penerima', PenerimaList::class)
    ->middleware('auth')
    ->name('data_penerima');

Route::get('/riwayat-bantuan', RiwayatBantuanList::class)
    ->middleware('auth')
    ->name('riwayat_bantuan');

Route::get('/tanggungan-anak', TanggunganAnakList::class)
    ->middleware('auth')
    ->name('tanggungan_anak');

Route::get('/kepemilikan-rumah', KepemilikanRumahList::class)
    ->middleware('auth')
    ->name('kepemilikan_rumah');

Route::get('/kepemilikan-kendaraan', KepemilikanKendaraanList::class)
    ->middleware('auth')
    ->name('kepemilikan_kendaraan');

Route::get('/pekerjaan-penghasilan', PekerjaanPenghasilanList::class)
    ->middleware('auth')
    ->name('pekerjaan_penghasilan');

Route::get('/penilaian', PenilaianList::class)
    ->middleware('auth')
    ->name('penilaian');
