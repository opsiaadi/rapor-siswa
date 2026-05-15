@extends('layouts.walikelas', [
    'title' => 'Rapor Lengkap - ' . ($siswa->nama ?? 'Siswa'),
    'pageTitle' => 'Rapor Lengkap',
    'breadcrumb' => 'Finalisasi > Lihat Rapor',
    'id' => $id ?? 1,
    'namaGuru' => $namaGuru ?? 'Wali Kelas',
])

@section('content')
<div class="space-y-6">
    {{-- Semester Selector --}}
    <div class="flex items-center justify-between">
        <form method="GET" action="{{ route('walikelas.rapor-lihat', ['siswaId' => $siswa->id]) }}" class="flex items-center gap-3">
            <label for="semester" class="text-sm font-medium text-gray-700">Semester:</label>
            <select name="semester" id="semester" onchange="this.form.submit()" class="rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                @foreach($semesterList as $key => $val)
                <option value="{{ $key }}" {{ $semester == $key ? 'selected' : '' }}>{{ $val }}</option>
                @endforeach
            </select>
        </form>
        <a href="{{ route('walikelas.finalisasi') }}" class="inline-flex items-center gap-2 rounded-full border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    {{-- Rapor Card --}}
    <div class="rounded-3xl border-2 border-gray-800 bg-white shadow-xl overflow-hidden">
        {{-- Header --}}
        <div class="bg-gray-800 px-8 py-6 text-white">
            <h1 class="text-2xl font-bold text-center tracking-wide">RAPOR SISWA</h1>
            <p class="text-center text-gray-300 mt-1">SDN 1 - Tahun Ajaran {{ $siswa->tahun_ajaran }}</p>
        </div>

        {{-- Data Siswa --}}
        <div class="px-8 py-6 border-b border-gray-200">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                <div>
                    <p class="text-gray-500 text-xs uppercase tracking-wider">Nama Siswa</p>
                    <p class="font-semibold text-gray-900">{{ $siswa->nama ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-xs uppercase tracking-wider">NIS</p>
                    <p class="font-semibold text-gray-900">{{ $siswa->nis ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-xs uppercase tracking-wider">Kelas</p>
                    <p class="font-semibold text-gray-900">{{ $siswa->kelas_nama ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-xs uppercase tracking-wider">Wali Kelas</p>
                    <p class="font-semibold text-gray-900">{{ $wali_kelas->nama ?? '-' }}</p>
                </div>
            </div>
            <div class="mt-3 text-sm">
                <p class="text-gray-500 text-xs uppercase tracking-wider">Semester</p>
                <p class="font-semibold text-gray-900">{{ $semesterList[$semester] ?? '-' }} ({{ $semester }})</p>
            </div>
        </div>

        {{-- Tabel Nilai --}}
        <div class="px-8 py-6 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Nilai Mata Pelajaran</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-100 border border-gray-300">
                            <th class="px-4 py-2 text-left font-semibold text-gray-700 border border-gray-300 w-12">No</th>
                            <th class="px-4 py-2 text-left font-semibold text-gray-700 border border-gray-300">Mata Pelajaran</th>
                            <th class="px-4 py-2 text-center font-semibold text-gray-700 border border-gray-300 w-20">KKM</th>
                            <th class="px-4 py-2 text-center font-semibold text-gray-700 border border-gray-300 w-20">Harian</th>
                            <th class="px-4 py-2 text-center font-semibold text-gray-700 border border-gray-300 w-20">UTS</th>
                            <th class="px-4 py-2 text-center font-semibold text-gray-700 border border-gray-300 w-20">UAS</th>
                            <th class="px-4 py-2 text-center font-semibold text-gray-700 border border-gray-300 w-24">Nilai Akhir</th>
                            <th class="px-4 py-2 text-center font-semibold text-gray-700 border border-gray-300 w-28">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($nilaiList as $index => $nilai)
                        <tr class="border border-gray-300 hover:bg-gray-50">
                            <td class="px-4 py-2 text-center border border-gray-300">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border border-gray-300 font-medium">{{ $nilai->mapel_nama }}</td>
                            <td class="px-4 py-2 text-center border border-gray-300">{{ $nilai->kkm }}</td>
                            <td class="px-4 py-2 text-center border border-gray-300">{{ $nilai->harian }}</td>
                            <td class="px-4 py-2 text-center border border-gray-300">{{ $nilai->uts }}</td>
                            <td class="px-4 py-2 text-center border border-gray-300">{{ $nilai->uas }}</td>
                            <td class="px-4 py-2 text-center border border-gray-300 font-bold">{{ $nilai->nilai_akhir }}</td>
                            <td class="px-4 py-2 text-center border border-gray-300">
                                @if($nilai->status == 'Lulus')
                                <span class="inline-block px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">Lulus</span>
                                @elseif($nilai->status == 'Tidak Lulus')
                                <span class="inline-block px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">Tidak Lulus</span>
                                @else
                                <span class="text-gray-400">-</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-4 py-8 text-center text-gray-500 border border-gray-300">
                                <div class="flex flex-col items-center gap-2">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                    <p>Belum ada nilai untuk semester ini</p>
                                    <p class="text-xs text-gray-400">Nilai akan muncul setelah guru mengirim data</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    @if($nilaiList->count() > 0)
                    <tfoot>
                        <tr class="bg-gray-50">
                            <td colspan="6" class="px-4 py-3 text-right font-bold text-gray-700 border border-gray-300">Rata-rata Nilai</td>
                            <td class="px-4 py-3 text-center font-bold text-lg text-emerald-700 border border-gray-300">{{ $rata_rata }}</td>
                            <td class="border border-gray-300"></td>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
        </div>

        {{-- Absensi --}}
        <div class="px-8 py-6 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Absensi</h3>
            <div class="flex flex-wrap gap-4 sm:gap-8">
                <div class="flex items-center gap-2">
                    <span class="text-gray-600 text-sm">Izin:</span>
                    <span class="font-semibold text-gray-900">{{ $siswa->izin ?? 0 }} hari</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-gray-600 text-sm">Sakit:</span>
                    <span class="font-semibold text-gray-900">{{ $siswa->sakit ?? 0 }} hari</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-gray-600 text-sm">Tanpa Keterangan:</span>
                    <span class="font-semibold text-gray-900">{{ $siswa->alpha ?? 0 }} hari</span>
                </div>
            </div>
        </div>

        {{-- Keterangan --}}
        <div class="px-8 py-6 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Keterangan</h3>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">Deskripsi Siswa</p>
                    <p class="text-gray-900">{{ $siswa->keterangan ?: '-' }}</p>
                </div>
                @if($siswa->kegatan)
                <div>
                    <p class="text-sm text-gray-500">Ekstrakurikuler</p>
                    <p class="text-gray-900">{{ $siswa->kegatan }} - {{ $siswa->ket_kegatan ?: '-' }}</p>
                </div>
                @endif
            </div>
        </div>

        {{-- Tanda Tangan --}}
        <div class="px-8 py-6 flex justify-between items-end">
            <div class="text-center">
                <p class="text-sm text-gray-500 mb-8">Wali Kelas</p>
                <p class="font-semibold text-gray-900 underline">{{ $wali_kelas->nama ?? '-' }}</p>
            </div>
            <div class="text-center">
                <p class="text-sm text-gray-500 mb-8">Mengetahui,</p>
                <p class="font-semibold text-gray-900 underline">Kepala Sekolah</p>
            </div>
        </div>
    </div>

    {{-- Print Button --}}
    <div class="flex justify-center">
        <button class="inline-flex items-center gap-2 rounded-full bg-emerald-600 hover:bg-emerald-700 px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all hover:scale-105">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
            </svg>
            Cetak Rapor
        </button>
    </div>
</div>
@endsection