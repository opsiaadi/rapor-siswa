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
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-gray-500 ">Status Rapor</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500 ">Aksi</th>
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
                        <td class="px-6 py-4">
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
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('walikelas.rapor', ['siswaId' => $siswa->id]) }}"
                                class="inline-flex items-center gap-1.5 rounded-lg bg-blue-600 hover:bg-blue-700 active:scale-95 px-3 py-1.5 text-xs font-semibold text-white shadow-sm shadow-blue-500/30 transition-all duration-150"
                                title="Edit Rapor Siswa">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.072a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                                Edit
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center">
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