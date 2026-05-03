@extends('layouts.walikelas', [
    'title' => 'Data Siswa Wali Kelas',
    'pageTitle' => 'Data Siswa',
    'breadcrumb' => 'Data siswa kelas perwalian untuk ' . ($namaGuru ?? 'Wali Kelas'),
    'id' => $id ?? 1,
    'namaGuru' => $namaGuru ?? 'Wali Kelas',
])

@section('content')
<div class="space-y-6">
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm
         ">
        <div class="space-y-3">
            <div class="flex gap-2">
                <p class="text-xs font-medium text-gray-500  w-28">Wali Kelas</p>
                <p class="text-sm font-bold text-gray-900 ">: {{ $namaGuru ?? 'Guru' }}</p>
            </div>
            <div class="flex gap-2">
                <p class="text-xs font-medium text-gray-500  w-28">Kelas</p>
                <p class="text-sm font-bold text-gray-900 ">: {{ $kelasUtama->nama_kelas ?? (($assignedClasses->first()->nama_kelas ?? '-')) }}</p>
            </div>
            <div class="flex gap-2">
                <p class="text-xs font-medium text-gray-500  w-28">Semester</p>
                <p class="text-sm font-bold text-gray-900 ">: {{ $semester ?? 'II' }}</p>
            </div>
            <div class="flex gap-2">
                <p class="text-xs font-medium text-gray-500  w-28">Jumlah Siswa</p>
                <p class="text-sm font-bold text-gray-900 ">: {{ count($siswaList ?? []) }} siswa</p>
            </div>
        </div>
    </div>

    <div class="rounded-3xl border border-gray-200 bg-white shadow-sm
          overflow-hidden">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3
            border-b border-gray-200  bg-gray-50  px-6 py-4">
            <h3 class="text-base font-semibold text-gray-900 ">
                Daftar Siswa
            </h3>

            {{-- Search --}}
            <div class="relative w-full sm:w-64">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-4 w-4 text-gray-400 " fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/>
                    </svg>
                </div>
                <input type="text" id="searchSiswa"
                    class="block w-full rounded-xl border border-gray-200 bg-white py-2 pl-9 pr-4
                        text-sm text-gray-700 placeholder-gray-400
                        focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none
                          
                          transition"
                    placeholder="Cari siswa...">
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-gray-200 
                        bg-gray-50 ">
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider
                            text-gray-500  w-16">
                            No.
                        </th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider
                            text-gray-500 ">
                            Nama Siswa
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider
                            text-gray-500 ">
                            Keterangan
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 ">
                    @forelse(($siswaList ?? collect()) as $index => $siswa)
                    <tr class="hover:bg-gray-50  transition-colors duration-150">

                        {{-- No --}}
                        <td class="px-6 py-4 text-sm text-gray-500 ">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}.
                            1
                        </td>

                        {{-- Nama Siswa --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full
                                    bg-gradient-to-br from-emerald-500 to-cyan-500
                                    text-sm font-semibold text-white">
                                    {{ strtoupper(substr($siswa->nama ?? 'S', 0, 1)) }} Andika
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900 ">
                                        {{ $siswa->nama ?? '-' }}
                                    </p>
                                    <p class="text-xs text-gray-500 ">
                                        {{ $siswa->nis ?? '-' }}
                                    </p>
                                </div>
                            </div>
                        </td>

                        {{-- Badge --}}
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('walikelas.rapor', ['siswaId' => $siswa->id]) }}"
                                class="inline-flex items-center gap-1.5 rounded-full
                                    bg-blue-600 hover:bg-blue-700 active:scale-95
                                    px-3 py-1 text-xs font-semibold text-white
                                    shadow-sm shadow-blue-500/30
                                    transition-all duration-150">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Tambah Keterangan
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-10 text-center">
                            <div class="rounded-2xl border border-dashed border-gray-300
                                 px-4 py-6 mx-4">
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

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3
            border-t border-gray-200 
            bg-gray-50  px-6 py-3">
            <p class="text-xs text-gray-500 ">
                Menampilkan {{ count($siswaList ?? []) }} dari {{ count($siswaList ?? []) }} siswa
            </p>

            {{-- Pagination --}}
            <div class="flex gap-1">
                <button class="flex h-8 w-8 items-center justify-center rounded-lg
                    border border-gray-200 
                    bg-white 
                    text-gray-500 
                    hover:bg-gray-100 
                    disabled:opacity-40 disabled:cursor-not-allowed
                    transition" disabled>
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button class="flex h-8 w-8 items-center justify-center rounded-lg
                    border border-gray-200 
                    bg-white 
                    text-gray-500 
                    hover:bg-gray-100  transition">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

    {{-- Action Buttons --}}
    <div class="flex items-center gap-2 mt-6">
        <button type="button"
            class="inline-flex items-center gap-2 rounded-xl
                bg-blue-700 hover:bg-blue-800  
                px-4 py-2 text-sm font-semibold text-white
                shadow-md shadow-blue-700/30
                active:scale-95 transition-all duration-150">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1
                    1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
            </svg>
            Ekspor PDF
        </button>
        <button type="button"
            class="inline-flex items-center gap-2 rounded-xl border border-blue-600
                px-4 py-2 text-sm font-semibold text-blue-600
                hover:bg-blue-50 
                 
                active:scale-95 transition-all duration-150">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
            </svg>
            Bagikan
        </button>
    </div>

{{-- Search filter --}}
<script>
    document.getElementById('searchSiswa').addEventListener('input', function () {
        const keyword = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach(row => {
            const nama = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() ?? '';
            row.style.display = nama.includes(keyword) ? '' : 'none';
        });
    });
</script>
@endsection