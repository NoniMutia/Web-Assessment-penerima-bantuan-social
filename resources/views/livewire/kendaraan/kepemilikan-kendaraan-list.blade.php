<div>
    <main id="main" class="main">
        <div class="pagetitle">
            <h3>Data Kepemilikan Kendaraan</h3>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <a wire:navigate href="{{ route('kepemilikan_kendaraan') }}">Kepemilikan Kendaraan</a>
                    </li>
                </ol>
            </nav>
        </div>

        <section class="section kendaraan">
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
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-info text-light">
                            <i class="bi bi-truck"></i> Form Kepemilikan Kendaraan
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">NIK</label>
                                    <select wire:model="nik" class="form-select" {{ $updateMode ? 'disabled' : '' }}>
                                        <option value="">-- Pilih NIK --</option>
                                        @foreach($penerimas as $p)
                                            <option value="{{ $p->nik }}">{{ $p->nik }} - {{ $p->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Jenis Kendaraan</label>
                                    <select wire:model="jenis_kendaraan" class="form-select">
                                        <option value="">-- Pilih Jenis --</option>
                                        <option value="Motor">Motor</option>
                                        <option value="Mobil">Mobil</option>
                                        <option value="Tidak Ada">Tidak Ada</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Jumlah Kendaraan</label>
                                    <input type="number" wire:model="jumlah" class="form-control" placeholder="Contoh: 2">
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
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-table"></i> Data Kendaraan</span>
                                <input type="text" class="form-control w-25" wire:model="keyword" placeholder="Cari NIK / Jenis...">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="table-secondary text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Jenis</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data as $i => $item)
                                            <tr>
                                                <td>{{ $data->firstItem() + $i }}</td>
                                                <td>{{ $item->nik }}</td>
                                                <td>{{ $penerimas->where('nik', $item->nik)->first()->nama ?? '-' }}</td>
                                                <td>{{ $item->jenis_kendaraan }}</td>
                                                <td>{{ $item->jumlah }}</td>
                                               <td class="text-center">
    <button wire:click="edit('{{ $item->nik }}')" class="btn btn-warning btn-sm">
        <i class="bi bi-pencil-square"></i>
    </button>
    <button wire:click="deleteConfirmation('{{ $item->nik }}')" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delModal">
        <i class="bi bi-trash"></i>
    </button>
</td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Belum ada data kendaraan</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $data->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

       <!-- Modal Konfirmasi Hapus -->
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                <button type="button" class="btn btn-danger" wire:click="deleteKendaraan" data-bs-dismiss="modal">Ya</button>
            </div>
        </div>
    </div>
</div>

            </div>
        </div>
    </main>
</div>
