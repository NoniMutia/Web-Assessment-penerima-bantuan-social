<div>
    <main id="main" class="main">
        <div class="pagetitle">
            <h3>Data Kepemilikan Rumah</h3>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <a wire:navigate href="{{ route('kepemilikan_rumah') }}">Kepemilikan Rumah</a>
                    </li>
                </ol>
            </nav>
        </div>

        <section class="section kepemilikan-rumah">
            {{-- Alert Validasi --}}
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

            {{-- Alert Sukses --}}
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
                    <div class="card shadow-sm">
                        <div class="card-header bg-info text-light">Form Kepemilikan Rumah</div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">NIK</label>
                                    <select wire:model="nik" class="form-select">
                                        <option value="">-- Pilih NIK --</option>
                                        @foreach ($penerimas as $p)
                                            <option value="{{ $p->nik }}">{{ $p->nik }} - {{ $p->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Status Rumah</label>
                                    <select wire:model="status_rumah" class="form-select">
                                        <option value="">-- Pilih --</option>
                                        <option value="Milik Sendiri">Milik Sendiri</option>
                                        <option value="Sewa">Sewa</option>
                                        <option value="Menumpang">Menumpang</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Status Tanah</label>
                                    <select wire:model="status_tanah" class="form-select">
                                        <option value="">-- Pilih --</option>
                                        <option value="Milik">Milik</option>
                                        <option value="Tidak Milik">Tidak Milik</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Luas Tanah (m<sup>2</sup>)</label>
                                    <input type="number" wire:model="luas_tanah" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Luas Bangunan (m<sup>2</sup>)</label>
                                    <input type="number" wire:model="luas_bangunan" class="form-control">
                                </div>
                                <div class="col-md-2 mt-4">
                                    @if ($updateMode)
                                        <button type="button" class="btn btn-info btn-sm text-light" wire:click="update">
                                            <i class="bi bi-check2-square"></i> Update
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-success btn-sm" wire:click="save">
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
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Cari NIK..." wire:model.live="keyword">
                            </div>
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Status Rumah</th>
                                        <th>Status Tanah</th>
                                        <th>Luas Tanah</th>
                                        <th>Luas Bangunan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $i => $item)
                                        <tr>
                                            <td>{{ $data->firstItem() + $i }}</td>
                                            <td>{{ $item->nik }}</td>
                                            <td>{{ $item->status_rumah }}</td>
                                            <td>{{ $item->status_tanah }}</td>
                                            <td>{{ $item->luas_tanah }} m<sup>2</sup></td>
                                            <td>{{ $item->luas_bangunan }} m<sup>2</sup></td>
                                            <td>
                                                <a wire:click="edit('{{ $item->nik }}')" class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a wire:click="deleteConfirmation('{{ $item->nik }}')" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delModal">
    <i class="bi bi-trash"></i>
</a>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Data belum tersedia</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $data->links() }}
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
                <button type="button" class="btn btn-danger" wire:click="deleteRumah" data-bs-dismiss="modal">Ya</button>
            </div>
        </div>
    </div>
</div>
</div>
