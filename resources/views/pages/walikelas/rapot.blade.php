<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lihat Rapot - {{ $nama ?? 'Wali Kelas' }}</title>
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
        'id' => $id,
        'nama' => $nama,
        'userName' => $nama ?? 'Wali Kelas'
    ])

    <div class="flex-1 lg:ml-64 flex flex-col min-h-screen">
        @include('components.navbar-walikelas', [
            'pageTitle' => 'Lihat Rapot',
            'breadcrumb' => 'Kelas ' . ($kelas['nama_kelas'] ?? ''),
            'userName' => $nama ?? 'Wali Kelas'
        ])

        <main class="flex-1 p-4 lg:p-6">
            <div class="p-4 mb-6 text-white bg-gradient-to-br from-green-600 via-green-500 to-emerald-600 rounded-lg shadow-sm" role="alert">
                <h2 class="text-xl font-bold">Lihat Rapot Siswa</h2>
                <p class="text-sm text-white/80 mt-1">Lihat rapot siswa kelas {{ $kelas['nama_kelas'] ?? '-' }}</p>
            </div>

            <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                <h3 class="text-lg font-bold mb-4">Pilih Siswa</h3>
                
                @if(count($siswa) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($siswa as $siswaItem)
                    <a href="{{ route('rapor.finalisasi', ['id' => $siswaItem['id'], 'nama' => $siswaItem['nama']]) }}" class="block p-4 border border-gray-200 rounded-lg hover:border-green-500 hover:bg-green-50 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 font-semibold">
                                {{ strtoupper(substr($siswaItem['nama'], 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">{{ $siswaItem['nama'] }}</p>
                                <p class="text-sm text-gray-500">NIS: {{ $siswaItem['nis'] }}</p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                @else
                <p class="text-gray-500 text-center py-4">Belum ada siswa di kelas ini.</p>
                @endif
            </div>
        </main>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>