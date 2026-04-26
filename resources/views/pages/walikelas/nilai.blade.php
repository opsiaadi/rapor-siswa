<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Input Nilai - {{ $nama ?? 'Wali Kelas' }}</title>
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
            'pageTitle' => 'Input Nilai',
            'breadcrumb' => 'Kelas ' . ($kelas['nama_kelas'] ?? ''),
            'userName' => $nama ?? 'Wali Kelas'
        ])

        <main class="flex-1 p-4 lg:p-6">
            @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
            @endif

            <div class="p-4 mb-6 text-white bg-gradient-to-br from-green-600 via-green-500 to-emerald-600 rounded-lg shadow-sm" role="alert">
                <h2 class="text-xl font-bold">Input Nilai Siswa</h2>
                <p class="text-sm text-white/80 mt-1">Input nilai siswa kelas {{ $kelas['nama_kelas'] ?? '-' }}</p>
            </div>

            <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                <form action="{{ route('walikelas.nilai.post', ['id' => $id, 'nama' => $nama]) }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Mata Pelajaran</label>
                            <select name="mapel_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                <option value="">-- Pilih Mata Pelajaran --</option>
                                @foreach($mapel as $m)
                                <option value="{{ $m['id'] }}">{{ $m['nama_mapel'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Semester</label>
                            <select name="semester" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                <option value="ganjil">Ganjil</option>
                                <option value="genap">Genap</option>
                            </select>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-100 border-b border-gray-200">
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">NIS</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Nama</th>
                                    <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Jenis Kelamin</th>
                                    <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Nilai UH</th>
                                    <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Nilai PTS</th>
                                    <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Nilai PAS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($siswa as $siswaItem)
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm">{{ $siswaItem['nis'] }}</td>
                                    <td class="px-4 py-3 text-sm font-medium">{{ $siswaItem['nama'] }}</td>
                                    <td class="px-4 py-3 text-center text-sm">{{ $siswaItem['jenis_kelamin'] === 'L' ? 'L' : 'P' }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <input type="number" name="nilai[{{ $siswaItem['id'] }}][uh]" min="0" max="100" placeholder="-" value="{{ old('nilai.'.$siswaItem['id'].'.uh', $savedNilai['nilai'][$siswaItem['id']]['uh'] ?? '') }}" class="w-20 border border-gray-300 rounded px-2 py-1 text-center">
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <input type="number" name="nilai[{{ $siswaItem['id'] }}][pts]" min="0" max="100" placeholder="-" value="{{ old('nilai.'.$siswaItem['id'].'.pts', $savedNilai['nilai'][$siswaItem['id']]['pts'] ?? '') }}" class="w-20 border border-gray-300 rounded px-2 py-1 text-center">
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <input type="number" name="nilai[{{ $siswaItem['id'] }}][pas]" min="0" max="100" placeholder="-" value="{{ old('nilai.'.$siswaItem['id'].'.pas', $savedNilai['nilai'][$siswaItem['id']]['pas'] ?? '') }}" class="w-20 border border-gray-300 rounded px-2 py-1 text-center">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 flex justify-end gap-2">
                        <button type="reset" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Reset</button>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Simpan Nilai</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>