<div>
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Hasil Penilaian Otomatis</h1>
    </div>

    <section class="section dashboard">
      <div class="card">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
          <span><i class="bi bi-table"></i> Data Penilaian</span>
          <a href="{{ $downloadUrl }}" class="btn btn-danger">
            <i class="bi bi-file-earmark-pdf"></i> Download PDF
          </a>
        </div>

        <div class="card-body">
          <input type="text" wire:model="keyword" class="form-control mb-3" placeholder="Cari nama / NIK / status...">

          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead class="table-secondary text-center">
                <tr>
                  <th>#</th>
                  <th>NIK</th>
                  <th>Nama</th>
                  <th>Skor Penghasilan</th>
                  <th>Skor Tanggungan</th>
                  <th>Skor Rumah</th>
                  <th>Skor Riwayat</th>
                  <th>Skor Kendaraan</th>
                  <th>Total</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($data as $i => $item)
                  <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->nik }}</td>
                    <td>{{ $item->nama }}</td>
                    <td class="text-center">{{ $item->skor_penghasilan }}</td>
                    <td class="text-center">{{ $item->skor_tanggungan }}</td>
                    <td class="text-center">{{ $item->skor_rumah }}</td>
                    <td class="text-center">{{ $item->skor_riwayat }}</td>
                    <td class="text-center">{{ $item->skor_kendaraan }}</td>
                    <td class="fw-bold text-center">{{ $item->skor_akhir }}</td>
                    <td class="text-center">
                      <span class="badge {{ $item->status_kelayakan === 'Layak' ? 'bg-success' : 'bg-danger' }}">
                        {{ $item->status_kelayakan }}
                      </span>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="10" class="text-center">Data belum tersedia</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </main>
</div>
