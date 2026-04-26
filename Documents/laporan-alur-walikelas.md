# Laporan Alur Kode Wali Kelas

## Tujuan

Modul wali kelas dipakai untuk membuka dashboard perwalian, melihat ringkasan kelas dan siswa yang menjadi tanggung jawab wali kelas, lalu mengirim data finalisasi rapor ke endpoint penyimpanan.

## Alur Request

1. User masuk dari halaman login.
2. `LoginController::authenticate()` mengarahkan role wali kelas ke named route `walikelas.dashboard`.
3. Named route itu didefinisikan di `routes/web.php` pada prefix `finalisasi_walikelas`.
4. Route memanggil `WalikelasController::finalisasi_walikelas()`.
5. Controller mengambil data guru, kelas, dan siswa dari `FakeDataHelper`.
6. Controller menyaring kelas yang sesuai dengan `wali_kelas_id`.
7. Controller menyaring siswa yang berada di kelas perwalian tersebut.
8. Controller mengirim data ke view `dashboard_walikelas`.
9. View `dashboard_walikelas` memakai `layouts.walikelas`.
10. Layout memuat navbar, sidebar, footer, dan area `@yield('content')`.
11. Isi halaman utama diambil dari partial `resources/views/walikelas/content.blade.php`.
12. Saat form disubmit, request dikirim ke route `rapor.simpan`.
13. Route `rapor.simpan` ditangani `RaporController::simpan()`.
14. `RaporController` menerima seluruh input form dan menyimpan file tanda tangan jika ada upload.
15. Setelah itu controller melakukan `return back()->with('success', ...)` agar user kembali ke dashboard dengan pesan berhasil.

## Struktur File

- `routes/web.php`
  Menyimpan definisi URL, prefix, dan named route untuk area wali kelas.

- `app/Http/Controllers/WalikelasController.php`
  Menjadi pusat logika halaman wali kelas. Di sini data dirakit sebelum dikirim ke Blade.

- `app/Helpers/FakeDataHelper.php`
  Menyediakan data dummy berbasis session untuk guru, kelas, mapel, dan siswa.

- `resources/views/layouts/walikelas.blade.php`
  Kerangka halaman: sidebar, navbar, dark mode toggle, footer, dan slot content.

- `resources/views/dashboard_walikelas.blade.php`
  Entry view untuk route utama wali kelas. File ini hanya mewarisi layout dan memanggil partial konten.

- `resources/views/walikelas/content.blade.php`
  Isi utama halaman: hero banner, statistik, form finalisasi, ringkasan kelas, dan daftar siswa.

- `app/Http/Controllers/RaporController.php`
  Endpoint tujuan form finalisasi.

## Cara Data Disusun di Controller

Controller wali kelas bekerja dalam urutan ini:

1. Menerima parameter `id` dan `namaGuru` dari route.
2. Jika `id` numerik, controller mencari data guru dengan `FakeDataHelper::findById()`.
3. Nama tampilan wali kelas diambil dari data guru. Jika tidak ada, dipakai `namaGuru` dari URL.
4. Semua kelas diambil dari `FakeDataHelper::getKelasOptions()`.
5. Kelas disaring berdasarkan `wali_kelas_id` yang cocok dengan `id`.
6. Jika hasil filter kosong, controller memakai satu kelas pertama sebagai fallback agar halaman tetap bisa dirender.
7. Semua siswa diambil dari `FakeDataHelper::getSiswa()`.
8. Siswa disaring berdasarkan `kelas_id` yang termasuk ke kelas perwalian.
9. Controller membuat ringkasan statistik:
   - jumlah kelas perwalian
   - jumlah siswa
   - jumlah mapel yang diampu
   - nama kelas utama

## Cara Layout Bekerja

Layout `walikelas` meniru pola `admin` dan `guru`:

1. Menyediakan mobile header.
2. Menyediakan sidebar responsif.
3. Menyediakan navbar desktop.
4. Menyediakan tombol dark mode.
5. Menampilkan avatar dan identitas user.
6. Menyediakan area `@yield('content')` untuk isi halaman.

Keuntungannya:

- halaman lebih konsisten
- sidebar dan navbar tidak perlu ditulis ulang di setiap view
- perubahan tampilan global cukup dilakukan dari satu file layout

## Cara Form Finalisasi Bekerja

Form di partial `walikelas/content.blade.php` mengirim data berikut:

- `wali_kelas_id`
- `wali_kelas_nama`
- `kelas_id`
- `semester`
- `keterangan`
- `kegiatan`
- `ket_kegiatan`
- `izin`
- `sakit`
- `alpha`
- `nama`
- `role`
- `ttd`

Semua field dikirim ke `route('rapor.simpan')`.

## Perbaikan Yang Dilakukan

Perubahan yang dibuat pada modul wali kelas:

1. Route wali kelas dirapikan agar URL tidak dobel prefix.
2. Controller wali kelas sekarang merakit data khusus perwalian, bukan hanya melempar view kosong.
3. Dibuat layout baru `layouts/walikelas.blade.php`.
4. Sidebar dan navbar disamakan polanya dengan modul admin/guru.
5. Ikon sidebar dibuat sesuai tema wali kelas dengan nuansa emerald, teal, dan amber.
6. Halaman wali kelas dipecah menjadi layout dan partial agar lebih mudah dirawat.
7. Dokumentasi alur kerja modul ditambahkan dalam file ini.

## Kesimpulan

Sekarang modul wali kelas berjalan dengan pola yang lebih sehat:

- route jelas
- controller menyiapkan data
- layout mengatur kerangka tampilan
- partial mengatur isi halaman
- form memiliki endpoint yang valid

Kalau modul ini ingin dikembangkan lagi, langkah berikutnya yang paling masuk akal adalah mengganti `FakeDataHelper` dengan model database sungguhan agar data wali kelas, kelas, dan siswa tidak lagi bergantung pada session dummy.
