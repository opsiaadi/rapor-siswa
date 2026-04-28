@extends('layouts.guru')

@section('content')
<div class="space-y-6">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 hover:shadow-lg transition-shadow border border-gray-200 dark:border-gray-700">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-xl font-bold text-gray-950">Input Nilai Siswa</h2>
                    <p class="text-sm font-medium text-gray-700">Masukkan nilai harian, UTS, dan UAS untuk setiap siswa</p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-sm text-gray-600 dark:text-gray-300">{{ $namaGuru ?? 'Guru Mapel' }}</span>
                    <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-semibold">
                        {{ strtoupper(substr($namaGuru ?? 'G', 0, 1)) }}
                    </div>
                </div>
            </div>

            <!-- Mapel yang Diajarkan -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Mata Pelajaran yang Diajarkan</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($guruMapel as $mapel)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4 hover:shadow-lg transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-bold text-gray-800 dark:text-white">{{ $mapel['nama_mapel'] }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">KKM: {{ $mapel['kkm'] }}</p>
                            </div>
                            <div class="p-2 bg-blue-100 dark:bg-blue-900/20 rounded-full">
                                <span class="text-blue-600 dark:text-blue-400 font-semibold">{{ $mapel['kode_mapel'] }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection