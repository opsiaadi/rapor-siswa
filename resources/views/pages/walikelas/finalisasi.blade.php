<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Finalisasi Rapor - {{ $nama ?? 'Siswa' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet"/>
    <script id="tailwind-config"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">

<div class="flex">
    @include('components.sidebar-walikelas', [
        'id' => $id ?? 1,
        'nama' => $walikelas_nama ?? 'Wali Kelas',
        'userName' => $walikelas_nama ?? 'Wali Kelas'
    ])

    <div class="flex-1 lg:ml-64 flex flex-col min-h-screen">
        @include('components.navbar-walikelas', [
            'pageTitle' => 'Finalisasi Rapor',
            'breadcrumb' => 'Siswa: ' . ($nama ?? ''),
            'userName' => $walikelas_nama ?? 'Wali Kelas'
        ])

        <main class="flex-1 p-4 lg:p-6">
            <div class="p-4 mb-6 text-white bg-gradient-to-br from-green-600 via-green-500 to-emerald-600 rounded-lg shadow-sm" role="alert">
                <h2 class="text-xl font-bold">Finalisasi Rapor Siswa</h2>
                <p class="text-sm text-white/80 mt-1">Finalisasi rapor untuk {{ $nama ?? 'Siswa' }}</p>
            </div>

            <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                <form action="{{ route('rapor.simpan') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Siswa</label>
                            <input type="text" name="nama_siswa" value="{{ $nama  ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2" readonly>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan Siswa</label>
                        <textarea name="keterangan" rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="Masukkan keterangan siswa..."></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2"> kegiatan Ekskul</label>
                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" name="kegunaan" class="border border-gray-300 rounded-lg px-3 py-2" placeholder=" Cth: Pramuka">
                            <input type="text" name="ket_kegunaan" class="border border-gray-300 rounded-lg px-3 py-2" placeholder="Keterangan">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Absensi</label>
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label class="text-xs text-gray-500">Izin</label>
                                <input type="number" name="izin" min="0" class="w-full border border-gray-300 rounded-lg px-3 py-2" placeholder="0">
                            </div>
                            <div>
                                <label class="text-xs text-gray-500">Sakit</label>
                                <input type="number" name="sakit" min="0" class="w-full border border-gray-300 rounded-lg px-3 py-2" placeholder="0">
                            </div>
                            <div>
                                <label class="text-xs text-gray-500">Alpha</label>
                                <input type="number" name="alpha" min="0" class="w-full border border-gray-300 rounded-lg px-3 py-2" placeholder="0">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanda Tangan</label>
                        <div class="grid grid-cols-3 gap-4">
                            <input type="text" name="ttd_nama" class="border border-gray-300 rounded-lg px-3 py-2" placeholder="Nama">
                            <input type="text" name="ttd_role" class="border border-gray-300 rounded-lg px-3 py-2" placeholder="Role">
                            <div class="relative">
                                <label for="ttd_file" class="flex items-center justify-center w-full border border-gray-300 rounded-lg px-3 py-2 cursor-pointer hover:bg-gray-50 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="mr-2 text-gray-500" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M14 2H6a2 2 0 0 0 -2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2V8z"/>
                                        <path d="M14 2v6h6"/>
                                        <path d="M12 18v-6"/>
                                        <path d="M9 15h6"/>
                                    </svg>
                                    <span class="text-sm text-gray-500">Pilih File</span>
                                </label>
                                <input type="file" name="ttd_file" id="ttd_file" accept="image/*" class="hidden">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between mt-6">
                        <a href="{{ url()->previous() }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Simpan</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>