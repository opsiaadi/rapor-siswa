<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lapor Siswa - Digital Academic Portal</title>
      @vite(['resources/css/app.css', 'resources/js/app.js'])
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Inter:wght@400;500;600&amp;family=JetBrains+Mono:wght@500&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
</head>
<body class="bg-gray-100">

<header class="bg-green-700 text-white flex justify-between items-center px-6 py-3">
    <div class="flex items-center gap-3">
        <div class="text-2xl">🎓</div>
        <div>
            <h1 class="font-bold">Data Siswa</h1>
            <p class="text-sm">Kelola data siswa</p>
        </div>
    </div>
    <div class="flex items-center gap-4">
        <span>🔆</span>
        <span>🔔</span>
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-white rounded-full"></div>
            <span>Admin TU</span>
        </div>
    </div>
</header>

<div class="flex">

    <-- Sidebar -->
    <aside class="w-56 bg-gray-200 min-h-screen p-4">
        <h2 class="font-bold mb-4">Menu Utama</h2>
        <ul class="space-y-2">
            <li class="bg-blue-600 text-white px-3 py-2 rounded">Data Siswa</li>
            <li class="px-3 py-2 hover:bg-gray-300 rounded">Data Guru</li>
            <li class="px-3 py-2 hover:bg-gray-300 rounded">Kelas</li>
            <li class="px-3 py-2 hover:bg-gray-300 rounded">Mata Pelajaran</li>
            <li class="px-3 py-2 hover:bg-gray-300 rounded">Lihat Nilai</li>
            <li class="px-3 py-2 hover:bg-gray-300 rounded">Lihat Rapot</li>
        </ul>

        <div class="mt-10 text-red-600 cursor-pointer">🚪 Log Out</div>
    </aside>

    {{-- Content --}}
    <main class="flex-1 flex justify-center items-start p-8">
        <div class="bg-gray-200 rounded-2xl p-6 w-[500px] shadow">
            <h2 class="text-center font-bold text-lg mb-4">Finalisasi Rapor Siswa</h2>

            <button class="bg-blue-600 text-white px-4 py-2 rounded-full mb-4">Lihat Disini >></button>

            <form action="{{ route('rapor.simpan') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Keterangan --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Keterangan Siswa</label>
                    <input type="text" name="keterangan" class="w-full rounded-full border-gray-300" />
                </div>

                {{-- Kegiatan --}}
                <div class="mb-4">
                    <label class="font-semibold">Kegiatan</label>
                    <div class="flex gap-2 mt-2">
                        <input type="text" name="kegiatan" class="w-1/2 rounded-full border-gray-300" placeholder="Pramuka">
                        <input type="text" name="ket_kegiatan" class="w-1/2 rounded-full border-gray-300" placeholder="Keterangan">
                    </div>
                </div>

                {{-- Absensi --}}
                <div class="mb-4">
                    <label class="font-semibold">Absensi</label>
                    <div class="flex gap-2 mt-2">
                        <input type="number" name="izin" class="w-1/3 rounded-full border-gray-300" placeholder="Izin">
                        <input type="number" name="sakit" class="w-1/3 rounded-full border-gray-300" placeholder="Sakit">
                        <input type="number" name="alpha" class="w-1/3 rounded-full border-gray-300" placeholder="Tanpa Keterangan">
                    </div>
                </div>

                {{-- TTD --}}
                <div class="mb-4">
                    <label class="font-semibold">Tanda Tangan</label>
                    <div class="flex gap-2 mt-2">
                        <input type="text" name="nama" class="w-1/3 rounded-full border-gray-300" placeholder="Nama">
                        <input type="text" name="role" class="w-1/3 rounded-full border-gray-300" placeholder="Role">
                        <input type="file" name="ttd" class="w-1/3">
                    </div>
                </div>

                <div class="flex justify-between mt-6">
                    <a href="{{ url()->previous() }}" class="text-red-600">Batal</a>
                    <button type="submit" class="text-blue-600 font-semibold">Simpan</button>
                </div>
            </form>
        </div>
    </main>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>

{{-- Route::get('/rapor/finalisasi', fn() => view('rapor.finalisasi')); --}}
{{-- Route::post('/rapor/simpan', [RaporController::class, 'simpan'])->name('rapor.simpan'); --}}

{{-- CONTROLLER (app/Http/Controllers/RaporController.php) --}}
{{--
public function simpan(Request $request)
{
    $data = $request->all();

    if ($request->hasFile('ttd')) {
        $data['ttd'] = $request->file('ttd')->store('ttd', 'public');
    }

    return back()->with('success', 'Data berhasil disimpan');
}
--}}