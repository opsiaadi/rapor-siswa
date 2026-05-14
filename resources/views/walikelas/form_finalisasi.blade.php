@extends('layouts.walikelas', [
    'title' => 'Finalisasi Rapor Wali Kelas',
    'pageTitle' => 'Finalisasi Rapor',
    'breadcrumb' => 'Form finalisasi rapor untuk ' . ($namaGuru ?? 'Wali Kelas'),
    'id' => $id ?? 1,
    'namaGuru' => $namaGuru ?? 'Wali Kelas',
])

@section('content')
<div class="space-y-6">
        {{-- Tabel Daftar Siswa untuk Finalisasi --}}
        <p class="text-sm text-gray-600 mb-2">Jumlah Siswa: {{ $totalSiswa ?? 0 }}</p>
        <div class="rounded-3xl border border-gray-200 bg-white shadow-sm   overflow-hidden">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b border-gray-200  bg-gray-50  px-6 py-4">
            <h3 class="text-base font-semibold text-gray-900 ">
                Daftar Siswa - Finalisasi Rapor
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-gray-200  bg-gray-50 ">
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-gray-500  w-16">No.</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-gray-500 ">Nama Siswa</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-gray-500 ">NIS</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-gray-500 text-center">Status Rapor</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-gray-500 text-center">Lihat Rapor</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-gray-500 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 ">
                    @forelse($siswaList as $index => $siswa)
                    <tr class="hover:bg-gray-50  transition-colors duration-150">
                        <td class="px-6 py-4 text-sm text-gray-500 ">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}.
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-emerald-500 to-cyan-500 text-sm font-semibold text-white">
                                    {{ strtoupper(substr($siswa->nama ?? 'S', 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900 ">{{ $siswa->nama ?? '-' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 ">
                            {{ $siswa->nis ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if(($siswa->status_rapor ?? '') == 'sudah')
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-green-700 border border-green-100   ">
                                <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Sudah
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700 border border-amber-100   ">
                                <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20">
                                    <circle cx="10" cy="10" r="8"/>
                                </svg>
                                Belum
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('walikelas.rapor-lihat', ['siswaId' => $siswa->id]) }}"
                                class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 active:scale-95 px-3 py-1.5 text-xs font-semibold text-white shadow-sm shadow-emerald-500/30 transition-all duration-200 hover:scale-105"
                                title="Lihat Rapor Lengkap">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Lihat
                            </a>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('walikelas.rapor', ['siswaId' => $siswa->id]) }}"
                                class="inline-flex items-center gap-1.5 rounded-lg bg-cyan-800 hover:bg-blue-700 active:scale-95 px-3 py-1.5 text-xs font-semibold text-white shadow-sm shadow-blue-500/30 transition-all duration-200 hover:scale-105"
                                title="Edit Rapor Siswa">
                                <svg class="w-6 h-6 text-slate-950" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03 1.03 0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z" clip-rule="evenodd"/>
                                </svg>
                                Edit
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center">
                            <div class="rounded-2xl border border-dashed border-gray-300  px-4 py-6 mx-4">
                                <p class="text-sm text-gray-500 ">
                                    Data siswa untuk kelas perwalian belum tersedia.
                                </p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection