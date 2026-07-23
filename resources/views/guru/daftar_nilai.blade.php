@extends('layouts.guru', [
    'title' => 'Daftar Nilai Siswa',
    'pageTitle' => 'Daftar Nilai Siswa',
    'breadcrumb' => 'Lihat Nilai',
    'id' => $id ?? 1,
    'namaGuru' => $namaGuru ?? 'Guru Mapel',
])

@section('content')
<div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="bg-gray-800 px-6 py-4">
        <h2 class="text-lg font-bold text-white">Nilai Siswa</h2>
        <p class="text-sm text-gray-300">Pilih siswa untuk melihat nilai</p>
    </div>

    <div class="p-6">
        @if($siswaList->isEmpty())
            <div class="text-center py-12 text-gray-500">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                </svg>
                <p class="text-lg font-medium">Tidak ada siswa</p>
                <p class="text-sm mt-1">Belum ada siswa di kelas yang Anda ajar.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="py-3 px-4 text-left font-semibold text-gray-600 w-12">No</th>
                            <th class="py-3 px-4 text-left font-semibold text-gray-600">NIS</th>
                            <th class="py-3 px-4 text-left font-semibold text-gray-600">Nama Siswa</th>
                            <th class="py-3 px-4 text-left font-semibold text-gray-600">Kelas</th>
                            <th class="py-3 px-4 text-center font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswaList as $i => $siswa)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                            <td class="py-3 px-4 text-gray-500">{{ $i + 1 }}</td>
                            <td class="py-3 px-4 font-mono text-gray-700">{{ $siswa->nis }}</td>
                            <td class="py-3 px-4 font-medium text-gray-900">{{ $siswa->nama }}</td>
                            <td class="py-3 px-4 text-gray-600">{{ $siswa->kelas_nama }}</td>
                            <td class="py-3 px-4 text-center">
                                <a href="{{ route('guru.nilai.lihat', ['siswaId' => $siswa->id]) }}" class="inline-flex items-center gap-1.5 rounded-full border border-blue-300 bg-blue-50 px-4 py-1.5 text-sm font-medium text-blue-700 hover:bg-blue-100 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Lihat Nilai
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-gray-500">Tidak ada data siswa.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
