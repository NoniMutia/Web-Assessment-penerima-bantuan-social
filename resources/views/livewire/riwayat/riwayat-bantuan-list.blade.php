<div>
    <main id="main" class="main">
        <div class="pagetitle">
            <h3>Riwayat Bantuan</h3>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <a wire:navigate href="{{ route('riwayat_bantuan') }}">Riwayat Bantuan</a>
                    </li>
                </ol>
            </nav>
        </div>

        <section class="section riwayat-bantuan">
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
                        <div class="card-header bg-info text-light">Form Riwayat Bantuan</div>
                        <div class="card-body">
                            <div class="row mt-1">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">NIK</label>
                                        <select wire:model="nik" class="form-select">
                                            <option value="">-- Pilih NIK --</option>
                                            @foreach($penerimas as $p)
                                                <option value="{{ $p->nik }}">{{ $p->nik }} - {{ $p->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Jenis Bantuan</label>
                                        <input type="text" wire:model="jenis_bantuan" class="form-control" placeholder="Masukkan jenis bantuan">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tahun Bantuan</label>
                                        <input type="number" wire:model="tahun_bantuan" class="form-control" placeholder="Contoh: 2024">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Sumber Bantuan</label>
                                        <input type="text" wire:model="sumber_bantuan" class="form-control" placeholder="Contoh: Dana Desa">
                                    </div>
                                </div>
                                <div class="col-md-2 mt-3">
                                    @if ($updateMode)
                                        <button type="button" class="btn btn-info btn-sm text-light" wire:click="updateRiwayat">
                                            <i class="bi bi-check2-square"></i> Update
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-success btn-sm" wire:click="saveRiwayat">
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
                    <div class="card">
                        <div class="card-body">
                            <div class="p-1 mb-1 bg-secondary">
                                <input type="text" class="form-control" placeholder="Cari NIK atau jenis bantuan..." wire:model.live="keyword">
                            </div>
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Jenis Bantuan</th>
                                        <th>Tahun</th>
                                        <th>Sumber</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $i => $item)
                                        <tr>
                                            <td>{{ $data->firstItem() + $i }}</td>
                                            <td>{{ $item->nik }}</td>
                                            <td>{{ $item->jenis_bantuan }}</td>
                                            <td>{{ $item->tahun_bantuan }}</td>
                                            <td>{{ $item->sumber_bantuan }}</td>
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
                    <button type="button" class="btn btn-danger" wire:click="deleteRiwayat" data-bs-dismiss="modal">Ya</button>
                </div>
            </div>
        </div>
    </div>
</div>
