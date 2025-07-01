
# App-Survei - Aplikasi Survei & Penilaian Penerima Bantuan

Aplikasi berbasis web menggunakan Laravel dan Livewire untuk mendata serta menilai kelayakan penerima bantuan. Dilengkapi dengan fitur CRUD, penilaian otomatis berdasarkan kriteria tertentu, dan ekspor hasil penilaian ke PDF.

---

## 🔍 Fitur Utama

- ✅ CRUD Data Penerima Bantuan
- ✅ Input dan Penilaian Berbasis Livewire (Real-time)
- ✅ Perhitungan Otomatis Skor Kelayakan Berdasarkan:
  - Penghasilan
  - Tanggungan Anak
  - Kepemilikan Rumah
  - Kendaraan
  - Riwayat Bantuan Sebelumnya
- ✅ Ekspor Hasil Penilaian ke Format PDF (menggunakan DomPDF)
- ✅ Tampilan hasil penilaian rapi dan responsif

---

## 🛠️ Teknologi yang Digunakan

- [Laravel 10](https://laravel.com/)
- [Livewire](https://livewire.laravel.com/)
- [barryvdh/laravel-dompdf](https://github.com/barryvdh/laravel-dompdf)
- Bootstrap 5
- MySQL

---

## 📦 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/NoniMutia/Web-Assessment-penerima-bantuan-social.git
cd app-survei
```

### 2. Install Dependency

```bash
composer install
```

### 3. Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_survei
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Jalankan Migrasi (jika tidak pakai file SQL)

```bash
php artisan migrate
```

### 5. Jalankan Server Lokal

```bash
php artisan serve
```

Akses di: [http://localhost:8000](http://localhost:8000)

---

## 🖨️ Ekspor PDF

Hasil penilaian dapat diekspor menjadi PDF langsung dari halaman web. Pastikan package DomPDF sudah terinstall:

```bash
composer require barryvdh/laravel-dompdf
```

---

## 📁 Struktur Folder Penting

- `app/Livewire/` – Komponen-komponen Livewire (CRUD, Penilaian)
- `resources/views/` – Blade Templates
- `routes/web.php` – Rute aplikasi
- `database/migrations/` – Struktur tabel
- `database/db_survei.sql` – File database hasil export

---

## 🗄️ Database

Database MySQL disertakan dalam file:

```
database/db_survei.sql
```

### 📥 Cara Import ke phpMyAdmin:
1. Buka [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
2. Buat database baru dengan nama: `db_survei`
3. Klik tab **Import**
4. Pilih file `db_survei.sql` dari folder `database`
5. Klik **Go**

Setelah itu, kamu bisa langsung menjalankan Laravel seperti biasa.

---

## 🙋‍♀️ Penggunaan

1. Input data penerima bantuan.
2. Isi semua kriteria (penghasilan, rumah, kendaraan, dst).
3. Sistem otomatis menghitung skor.
4. Klik tombol **"Download PDF"** untuk mengunduh hasil penilaian.

---

## 📝 Lisensi

Proyek ini bersifat open-source untuk kebutuhan pembelajaran dan pengembangan sistem penilaian sosial berbasis web.

---

## 📫 Kontak

Dikembangkan oleh: **Noni Mutia**  
Email: [nonimutia03@gmail.com](mailto:nonimutia03@gmail.com)  
GitHub: [https://github.com/NoniMutia](https://github.com/NoniMutia)
