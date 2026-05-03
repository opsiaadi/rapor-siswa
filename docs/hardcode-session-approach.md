# SiRapor — Hardcode Data di Blade + Controller Session

## Konsep Utama

Kombinasi antara data hardcode langsung di HTML `<td>` Blade dan fitur CRUD yang berfungsi menggunakan Controller Laravel + Session.

---

## Cara Kerja

### 1. Data Awal (Hardcode di Blade)

2 siswa ditulis langsung di dalam tag `<tr>` dan `<td>` tanpa menggunakan variabel, loop, atau `@php` block.

```blade
<tbody>
    <tr>
        <td>1001</td>
        <td>Ahmad Fauzi</td>
        <td>XII IPA 1</td>
        <td>
            <button>Lihat</button>
            <a href="#">Edit</a>
            <button>Hapus</button>
        </td>
    </tr>
    <tr>
        <td>1002</td>
        <td>Siti Nurhaliza</td>
        <td>XII IPA 1</td>
        <td>
            <button>Lihat</button>
            <a href="#">Edit</a>
            <button>Hapus</button>
        </td>
    </tr>
    
    {{-- data tambahan dari session di-render di sini --}}
</tbody>
```

### 2. Data Tambahan (dari Controller + Session)

Ketika pengguna klik tombol Tambah Siswa, isi form, dan submit:

- Data dikirim ke Controller via POST
- Controller simpan ke session Laravel
- Redirect kembali ke halaman index
- Data tambahan di-render via foreach di bawah 2 baris hardcode

---

## Struktur Controller

Controller minimal butuh 4 method:

**index()**
Tampilkan halaman dengan data dari session.

**store()**
Terima data dari form Tambah, simpan ke session, redirect ke index.

**update($id)**
Cari data di session berdasarkan ID, update, simpan ulang session, redirect.

**destroy($id)**
Cari data di session berdasarkan ID, hapus dari array, simpan ulang session, redirect.

---

## Alur Lengkap

```
Buka /admin/siswa
→ 2 baris hardcode langsung tampil
→ Data session kosong (belum ada yang ditambah)

Klik Tambah Siswa
→ Form muncul
→ Isi NIS, Nama, Kelas
→ POST ke /admin/siswa

Controller terima data
→ Ambil session('siswa') atau []
→ Push data baru ke array
→ Simpan ulang ke session
→ Redirect ke /admin/siswa

Halaman reload
→ 2 baris hardcode tetap tampil
→ Data dari session di-render via @foreach
→ Sekarang ada 3 baris total
```

---

## Komponen yang Dibutuhkan

| Komponen | Fungsi |
|---|---|
| Blade view (index) | Tampilkan 2 hardcode + loop data session |
| Blade view (create) | Form tambah siswa |
| Blade view (edit) | Form edit siswa |
| Controller | Handle index, store, update, destroy |
| Routes | GET/POST untuk CRUD |
| Session Laravel | Penyimpanan sementara data tambahan |

---

## Yang TIDAK Dibutuhkan

- Database atau migration
- Model Eloquent
- Seeder atau factory
- localStorage JavaScript
- AJAX atau fetch API
- File JavaScript custom (form submit langsung ke Controller)

---

## Kelebihan Pendekatan Ini

- 2 data hardcode selalu muncul (tidak bisa dihapus)
- Fitur Tambah/Edit/Hapus berfungsi penuh
- Tidak perlu setup database sama sekali
- Cocok untuk demo atau presentasi PBL
- Data tambahan hilang saat browser ditutup (sesuai sifat session)
- Tidak perlu JavaScript custom

---

## Catatan Penting

Data yang di-hardcode di `<td>` **tidak bisa di-edit atau dihapus** kecuali edit kode Blade-nya langsung. Hanya data yang disimpan via session yang bisa di-CRUD.

Jika ingin semua data bisa di-CRUD, jangan pakai hardcode `<td>` — pakai `@php` block dengan array awal, lalu manipulasi array tersebut di Controller.

---

## Implementasi

### Controller: SiswaHardcodeController
- index(): Tampilkan view dengan data session
- store(Request $request): Simpan data baru ke session
- update(Request $request, $id): Update data di session
- destroy($id): Hapus data dari session

### Routes
```php
Route::prefix('admin/siswa-hardcode')->group(function () {
    Route::get('/', [SiswaHardcodeController::class, 'index'])->name('admin.siswa-hardcode.index');
    Route::get('/create', [SiswaHardcodeController::class, 'create'])->name('admin.siswa-hardcode.create');
    Route::post('/', [SiswaHardcodeController::class, 'store'])->name('admin.siswa-hardcode.store');
    Route::get('/{id}/edit', [SiswaHardcodeController::class, 'edit'])->name('admin.siswa-hardcode.edit');
    Route::put('/{id}', [SiswaHardcodeController::class, 'update'])->name('admin.siswa-hardcode.update');
    Route::delete('/{id}', [SiswaHardcodeController::class, 'destroy'])->name('admin.siswa-hardcode.destroy');
});
```

### Blade: 2 Baris Hardcode + Session Loop
```blade
<tbody>
    {{-- 2 baris hardcode --}}
    <tr>
        <td>1001</td>
        <td>Ahmad Fauzi</td>
        <td>XII IPA 1</td>
        <td>
            <a href="#" class="text-blue-600">Edit</a>
            <form action="" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600">Hapus</button>
            </form>
        </td>
    </tr>
    <tr>
        <td>1002</td>
        <td>Siti Nurhaliza</td>
        <td>XII IPA 1</td>
        <td>
            <a href="#" class="text-blue-600">Edit</a>
            <form action="" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600">Hapus</button>
            </form>
        </td>
    </tr>
    
    {{-- Loop data dari session --}}
    @forelse(session('siswa_hardcode', []) as $siswa)
    <tr>
        <td>{{ $siswa['nis'] }}</td>
        <td>{{ $siswa['nama'] }}</td>
        <td>{{ $siswa['kelas'] }}</td>
        <td>
            <a href="{{ route('admin.siswa-hardcode.edit', $siswa['id']) }}" class="text-blue-600">Edit</a>
            <form action="{{ route('admin.siswa-hardcode.destroy', $siswa['id']) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600" onsubmit="return confirm('Hapus?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforelse
</tbody>
```
