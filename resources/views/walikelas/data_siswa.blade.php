@extends('layouts.walikelas', [
    'title' => 'Data Siswa Wali Kelas',
    'pageTitle' => 'Data Siswa',
    'breadcrumb' => 'Data siswa kelas perwalian untuk ' . ($namaGuru ?? 'Wali Kelas'),
    'id' => $id ?? 1,
    'namaGuru' => $namaGuru ?? 'Wali Kelas',
])

@section('content')
<div class="space-y-6">
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
        <div class="space-y-3">
            <div class="flex gap-2">
                <p class="text-xs font-medium text-gray-500 w-28">Wali Kelas</p>
                <p class="text-sm font-bold text-gray-900">{{ $namaGuru ?? 'Wali Kelas' }}</p>
            </div>
            <div class="flex gap-2">
                <p class="text-xs font-medium text-gray-500 w-28">Kelas</p>
                <p class="text-sm font-bold text-gray-900">XII IPA 1</p>
            </div>
            <div class="flex gap-2">
                <p class="text-xs font-medium text-gray-500 w-28">Semester</p>
                <p class="text-sm font-bold text-gray-900">II</p>
            </div>
            <div class="flex gap-2">
                <p class="text-xs font-medium text-gray-500 w-28">Jumlah Siswa</p>
                <p class="text-sm font-bold text-gray-900">{{ $totalSiswa ?? 0 }} siswa</p>
            </div>
        </div>
    </div>

    <div class="rounded-3xl border border-gray-200 bg-white shadow-sm overflow-hidden">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b border-gray-200 bg-gray-50 px-6 py-4">
            <h3 class="text-base font-semibold text-gray-900">Daftar Siswa</h3>
        
            {{-- Search --}}
            <div class="relative w-full sm:w-64">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" id="searchSiswa" class="block w-full rounded-xl border border-gray-200 bg-white py-2 pl-9 pr-4 text-sm text-gray-700 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition" placeholder="Cari siswa...">
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-gray-200 bg-gray-50">
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-gray-500 w-16">No.</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-gray-500">Nama Siswa</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-gray-500 text-right">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @foreach($siswaList as $siswa)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    {{-- No --}}
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                    
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-emerald-500 to-cyan-500 text-sm font-semibold text-white">{{ strtoupper(substr($siswa->nama ?? 'U', 0, 1)) }}</div>
                            <div>
                                <p class="font-medium text-gray-900">{{ $siswa->nama }}</p>
                                <p class="text-xs text-gray-500">{{ $siswa->nis }}</p>
                            </div>
                        </div>
                    </td>
                    
                    <td class="px-6 py-4 text-right">
<a href="{{ route('walikelas.rapor', ['siswaId' => $siswa->id]) }}" class="inline-flex items-center gap-1.5 rounded-full bg-blue-600 hover:bg-blue-700 active:scale-95 px-3 py-1 text-xs font-semibold text-white shadow-sm shadow-blue-500/30 transition-all duration-200 hover:scale-105">
                            Tambah Keterangan
                        </a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-t border-gray-200 bg-gray-50 px-6 py-3">
            <p class="text-xs text-gray-500">Menampilkan 2 dari 2 siswa</p>
        </div>
    </div>
</div>

    {{-- Action Buttons --}}
    <div class="flex items-center gap-2 mt-6">
<button type="button" class="inline-flex items-center gap-2 rounded-xl bg-blue-700 hover:bg-blue-800 px-4 py-2 text-sm font-semibold text-white shadow-md shadow-blue-700/30 active:scale-95 transition-all duration-200 hover:scale-105">
            <svg class="w-6 h-6 text-cyan-100" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2 2 2 0 0 0 2 2h12a2 2 0 0 0 2-2 2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V4a2 2 0 0 0-2-2h-7Zm-6 9a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h.5a2.5 2.5 0 0 0 0-5H5Zm1.5 3H6v-1h.5a.5.5 0 0 1 0 1Zm4.5-3a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h1.376A2.626 2.626 0 0 0 15 15.375v-1.75A2.626 2.626 0 0 0 12.375 11H11Zm1 5v-3h.375a.626.626 0 0 1 .625.626v1.748a.625.625 0 0 1-.626.626H12Zm5-5a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h1.376A2.626 2.626 0 0 0 15 15.375v-1.75A2.626 2.626 0 0 0 12.375 11H11Zm1 5v-3h.375a.626.626 0 0 1 .625.626v1.748a.625.625 0 0 1-.626.626H12Zm5-5a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h1.376A2.626 2.626 0 0 0 15 15.375v-1.75A2.626 2.626 0 0 0 12.375 11H11Zm1 5v-3h.375a.626.626 0 0 1 .625.626v1.748a.625.625 0 0 1-.626.626H12Zm5-5a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h1.376A2.626 2.626 0 0 0 15 15.375v-1.75A2.626 2.626 0 0 0 12.375 11H11Zm1 5v-3h.375a.626.626 0 0 1 .625.626v1.748a.625.625 0 0 1-.626.626H12Z" clip-rule="evenodd"/>
            </svg>
            Ekspor PDF
        </button>
        <button type="button" class="inline-flex items-center gap-2 rounded-xl border border-blue-600 px-4 py-2 text-sm font-semibold text-blue-600 hover:bg-blue-50 active:scale-95 transition-all duration-200 hover:scale-105">
            <svg class="w-6 h-6 text-slate-600/70" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M7.926 10.898 15 7.727m-7.074 5.39L15 16.29M8 12a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm12 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm0-11a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z"/>
            </svg>

        Bagikan
        </button>
    </div>
@endsection