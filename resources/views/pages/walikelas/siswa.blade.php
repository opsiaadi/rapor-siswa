<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Siswa Kelas - {{ $nama ?? 'Wali Kelas' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
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
            'pageTitle' => 'Data Siswa Kelas',
            'breadcrumb' => 'Kelas ' . ($kelas['nama_kelas'] ?? ''),
            'userName' => $nama ?? 'Wali Kelas'
        ])

        <main class="flex-1 p-4 lg:p-6">
            <div class="p-4 mb-6 text-white bg-gradient-to-br from-green-600 via-green-500 to-emerald-600 rounded-lg shadow-sm" role="alert">
                <h2 class="text-xl font-bold">Data Siswa Kelas {{ $kelas['nama_kelas'] ?? '-' }}</h2>
                <p class="text-sm text-white/80 mt-1">Kelola data siswa kelas {{ $kelas['nama_kelas'] ?? '-' }}</p>
            </div>

            <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold">Daftar Siswa</h3>
                    <span class="text-sm text-gray-500">Total: {{ count($siswa) }} siswa</span>
                </div>
                
                @if(count($siswa) > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-100 border-b border-gray-200">
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">NIS</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Nama</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">JK</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Tahun Ajaran</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($siswa as $siswaItem)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3 text-sm">{{ $siswaItem['nis'] }}</td>
                                <td class="px-4 py-3 text-sm font-medium">{{ $siswaItem['nama'] }}</td>
                                <td class="px-4 py-3 text-center text-sm">{{ $siswaItem['jenis_kelamin'] === 'L' ? 'L' : 'P' }}</td>
                                <td class="px-4 py-3 text-sm">{{ $siswaItem['tahun_ajaran'] }}</td>
                                <td class="px-4 py-3 text-sm">{{ $siswaItem['kelas_nama'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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