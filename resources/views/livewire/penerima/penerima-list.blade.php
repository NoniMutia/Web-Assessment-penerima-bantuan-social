<div>
    <main id="main" class="main">
        <div class="pagetitle">
            <h3>Data Penerima Bantuan</h3>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <a wire:navigate href="{{ route('data_penerima') }}">Penerima Bantuan</a>
                    </li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section data-penerima">
            {{-- Alert for Validation --}}
            @if ($errors->any())
                <div class="pt-3">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- Success Alert --}}
            @if (session()->has('message'))
                <div class="pt-3">
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                </div>
            @endif

            <!-- Form Input -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-info text-light">Form Penerima</div>
                        <div class="card-body">
                            <div class="row mt-1">
                                <div class="row g-3">
                                <div class="col-md-6">
                                <label class="form-label">NIK</label>
                                <input type="text" wire:model="nik" class="form-control" placeholder="Masukkan NIK">
                                </div>
                                <div class="col-md-6">
                                <label class="form-label">Nama</label>
                                <input type="text" wire:model="nama" class="form-control" placeholder="Masukkan Nama Lengkap">
                                </div>
                                <div class="col-md-12">
                                <label class="form-label">Alamat</label>
                                <textarea wire:model="alamat" class="form-control" rows="2" placeholder="Contoh: Jl. Merdeka No. 12"></textarea>
                                </div>
                                <div class="col-md-6">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" wire:model="tanggal_lahir" class="form-control">
                                </div>
                                <div class="col-md-6">
                                <label class="form-label">Jenis Kelamin</label>
                                <select wire:model="jenis_kelamin" class="form-select">
                                    <option value="">Pilih</option>
                                    <option>Laki-laki</option>
                                    <option>Perempuan</option>
                                </select>
                                </div>
                                <div class="col-md-6">
                                <label class="form-label">No HP</label>
                                <input type="text" wire:model="no_hp" class="form-control" placeholder="Contoh: 08xxxxxxxxxx">
                                </div>
                                <div class="col-md-6">
                                <label class="form-label">Tanggal Survei</label>
                                <input type="date" wire:model="tanggal_survei" class="form-control">
                                </div>
                            </div>
                                <div class="col-md-2">
                                    @if ($updateMode)
                                        <button type="button" class="btn btn-info btn-sm text-light" wire:click="updatePenerima">
                                            <i class="bi bi-check2-square"></i> Update
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-success btn-sm" wire:click="savePenerima">
                                            <i class="bi bi-sd-card"></i> Simpan
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Table -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="p-1 mb-1 bg-secondary">
                                <input type="text" class="form-control" placeholder="Cari Data..." wire:model.live="keyword">
                            </div>
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Tanggal Lahir</th>
                                        <th>JK</th>
                                        <th>No HP</th>
                                        <th>Survei</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($penerima as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nik }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->tanggal_lahir }}</td>  
                                        <td>{{ $item->jenis_kelamin }}</td>
                                        <td>{{ $item->no_hp }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_survei)->translatedFormat('d F Y') }}</td>
                                        <td>
                                            <a wire:click="loadUpdate('{{ $item->nik }}')" class="btn btn-warning btn-sm">
                                                <i class="bi bi-upload"></i>
                                            </a>
                                            <a wire:click="deleteConfirmation('{{ $item->nik }}')" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delModal">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $penerima->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Modal Hapus -->
    <div wire:ignore.self class="modal fade" id="delModal" tabindex="-1" aria-labelledby="delModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info text-light">
                    <h1 class="modal-title fs-5">Konfirmasi Hapus</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    Apakah yakin ingin menghapus data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Tidak</button>
                    <button type="button" class="btn btn-danger" wire:click="deletePenerima" data-bs-dismiss="modal">Ya</button>
                </div>
            </div>
        </div>
    </div>
</div>
