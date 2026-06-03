@extends('layouts.guru')

@section('content')
<div class="space-y-6">
    <!-- Header Card -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Dashboard Guru Mapel</h2>
                <p class="text-sm font-medium text-gray-500 mt-1">Masukkan nilai harian, UTS, dan UAS untuk setiap siswa</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-sm text-gray-600">{{ $namaGuru ?? 'Guru Mapel' }}</span>
                <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-semibold">
                    {{ strtoupper(substr($namaGuru ?? 'G', 0, 1)) }}
                </div>
            </div>
        </div>
    </div>

    <!-- Mapel Cards -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Mata Pelajaran yang Diajarkan</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($guruMengajar as $mengajar)
            <div class="p-4 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold text-gray-900">{{ $mengajar->mapel_nama }}</p>
                        <p class="text-xs text-gray-500 mt-1">Kelas: {{ $mengajar->kelas_nama }} | Semester: {{ $mengajar->semester }}</p>
                    </div>
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <span class="text-blue-600 text-xs font-semibold">{{ $mengajar->kelas_nama }}</span>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-8">
                <p class="text-gray-500">Belum ada mata pelajaran yang diajarkan</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection