@extends('layouts.admin', [
    'title' => 'Data Siswa',
    'pageTitle' => 'Data Siswa',
    'breadcrumb' => 'Kelola data siswa seluruh kelas',
    'userName' => session('user.name', 'Admin TU')
])

@section('content')
<div class="space-y-6">

<!-- Toolbar Card -->
<div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <div class="flex items-center gap-4">
        <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center text-white ">
            <svg class="w-6 h-6 text-blue-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd"/>
            </svg>
        </div>
        <div>
            <h3 class="text-base font-bold text-gray-900 tracking-tight">Manajemen Data Siswa</h3>
            <p class="text-sm text-gray-500 ">Total <span class="text-blue-600 font-bold">{{ $data->count() }}</span> Siswa terdaftar</p>
        </div>
    </div>
    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full md:w-auto">
        <form class="flex-1 sm:flex-initial" action="{{ route('admin.siswa.index') }}" method="GET">
            <label for="simple-search" class="sr-only">Cari</label>
            <div class="relative w-full sm:w-64">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" id="simple-search" name="search" value="{{ request('search', '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full ps-10 p-2.5 transition-colors" placeholder="Cari siswa...">
            </div>
        </form>
        <a href="{{ route('admin.siswa.create') }}" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-semibold rounded-full text-sm px-5 py-2.5 flex items-center justify-center gap-2 transition-all duration-200 hover:scale-105 hover:shadow-lg active:scale-95">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>Tambah Siswa
        </a>
    </div>
</div>

<!-- Table (Desktop) -->
<div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="relative overflow-x-auto hidden md:block">
        <table class="w-full text-sm text-left text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-200 ">
                <tr>
                    <th scope="col" class="px-6 py-4 font-bold tracking-wider">No</th>
                    <th scope="col" class="px-6 py-4 font-bold tracking-wider">NIS</th>
                    <th scope="col" class="px-6 py-4 font-bold tracking-wider">Nama Siswa</th>
                    <th scope="col" class="px-6 py-4 font-bold tracking-wider">Jenis Kelamin</th>
                    <th scope="col" class="px-6 py-4 font-bold tracking-wider">Tahun Ajaran</th>
                    <th scope="col" class="px-6 py-4 font-bold tracking-wider text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse($data as $index => $siswa)
                <tr class="bg-white border-b border-gray-100 hover:bg-gray-50 transition-colors group">
                    <td class="px-6 py-4 text-gray-500 font-medium">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                    <td class="px-6 py-4 font-mono text-gray-900 font-semibold tracking-tight">{{ $siswa->nis ?? '-' }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold">
                                {{ strtoupper(substr($siswa->nama ?? 'S', 0, 1)) }}
                            </div>
                            <span class="font-semibold text-gray-900">{{ $siswa->nama ?? '-' }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-xs font-bold uppercase tracking-tighter">{{ $siswa->jenis_kelamin ?? '-' }}</span>
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $siswa->tahun_ajaran ?? '-' }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-1">
                            <button type="button"
                                    data-modal-target="detailModal"
                                    data-modal-toggle="detailModal"
                                    onclick="openDetailModal('{{ strtoupper(substr($siswa->nama ?? 'S', 0, 1)) }}', '{{ $siswa->nama ?? '-' }}', '{{ $siswa->nis ?? '-' }}', '{{ $siswa->jenis_kelamin ?? '-' }}', '{{ $siswa->tahun_ajaran ?? '-' }}', '{{ $siswa->kelas->nama_kelas ?? '-' }}', '{{ $siswa->kelas->waliKelas->nama ?? '-' }}')" class="text-gray-500 hover:text-blue-600 p-1.5 rounded-lg hover:bg-blue-50 transition-all duration-200 hover:scale-110 active:scale-95" title="Detail Siswa">
                                <svg class="w-6 h-6 text-sky-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M4.998 7.78C6.729 6.345 9.198 5 12 5c2.802 0 5.27 1.345 7.002 2.78a12.713 12.713 0 0 1 2.096 2.183c.253.344.465.682.618.997.14.286.284.658.284 1.04s-.145.754-.284 1.04a6.6 6.6 0 0 1-.618.997 12.712 12.712 0 0 1-2.096 2.183C17.271 17.655 14.802 19 12 19c-2.802 0-5.27-1.345-7.002-2.78a12.712 12.712 0 0 1-2.096-2.183 6.6 6.6 0 0 1-.618-.997C2.144 12.754 2 12.382 2 12s.145-.754.284-1.04c.153-.315.365-.653.618-.997A12.714 12.714 0 0 1 4.998 7.78ZM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                            <a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="text-gray-500 hover:text-amber-600 p-1.5 rounded-lg hover:bg-amber-50 transition-all duration-200 hover:scale-110 active:scale-95" title="Edit">
                                <svg class="w-6 h-6 text-sky-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03 1.03 0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z" clip-rule="evenodd"/>
                                </svg>
                            </a>
                            <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus siswa ini?')">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="text-gray-500 hover:text-red-600 p-1.5 rounded-lg hover:bg-red-50 transition-all duration-200 hover:scale-110 active:scale-95" title="Hapus">
                                    <svg class="w-6 h-6 text-sky-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5v14m-6-8h6m-6 4h6m4.506-1.494L15.012 12m0 0 1.506-1.506M15.012 12l1.506 1.506M15.012 12l-1.506-1.506M20 19H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1Z"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                        Tidak ada data siswa tersedia
                    </td>
                </tr>
                @endforelse
            </tbody>
     </table>
</div>

    <!-- Card View (Mobile) -->
    <div class="block md:hidden divide-y divide-gray-100">
        @forelse($data as $index => $siswa)
        <div class="p-4 hover:bg-gray-50 transition-colors">
            <div class="flex items-start justify-between mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-sm font-bold">
                        {{ strtoupper(substr($siswa->nama ?? 'S', 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">{{ $siswa->nama ?? '-' }}</p>
                        <p class="text-xs text-gray-500">#{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-1">
                    <button type="button"
                            data-modal-target="detailModal"
                            data-modal-toggle="detailModal"
                            onclick="openDetailModal('{{ strtoupper(substr($siswa->nama ?? 'S', 0, 1)) }}', '{{ $siswa->nama ?? '-' }}', '{{ $siswa->nis ?? '-' }}', '{{ $siswa->jenis_kelamin ?? '-' }}', '{{ $siswa->tahun_ajaran ?? '-' }}', '{{ $siswa->kelas->nama_kelas ?? '-' }}', '{{ $siswa->kelas->waliKelas->nama ?? '-' }}')" class="text-gray-500 hover:text-blue-600 p-2 rounded-lg hover:bg-blue-50 transition-all" title="Detail Siswa">
                        <svg class="w-5 h-5 text-sky-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M4.998 7.78C6.729 6.345 9.198 5 12 5c2.802 0 5.27 1.345 7.002 2.78a12.713 12.713 0 0 1 2.096 2.183c.253.344.465.682.618.997.14.286.284.658.284 1.04s-.145.754-.284 1.04a6.6 6.6 0 0 1-.618.997 12.712 12.712 0 0 1-2.096 2.183C17.271 17.655 14.802 19 12 19c-2.802 0-5.27-1.345-7.002-2.78a12.712 12.712 0 0 1-2.096-2.183 6.6 6.6 0 0 1-.618-.997C2.144 12.754 2 12.382 2 12s.145-.754.284-1.04c.153-.315.365-.653.618-.997A12.714 12.714 0 0 1 4.998 7.78ZM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                    <a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="text-gray-500 hover:text-amber-600 p-2 rounded-lg hover:bg-amber-50 transition-all" title="Edit">
                        <svg class="w-5 h-5 text-sky-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03 1.03 0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                    <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus siswa ini?')">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="text-gray-500 hover:text-red-600 p-2 rounded-lg hover:bg-red-50 transition-all" title="Hapus">
                            <svg class="w-5 h-5 text-sky-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5v14m-6-8h6m-6 4h6m4.506-1.494L15.012 12m0 0 1.506-1.506M15.012 12l1.506 1.506M15.012 12l-1.506-1.506M20 19H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1Z"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-2 text-xs">
                <div>
                    <span class="text-gray-400">NIS</span>
                    <p class="font-medium text-gray-900 font-mono">{{ $siswa->nis ?? '-' }}</p>
                </div>
                <div>
                    <span class="text-gray-400">JK</span>
                    <p><span class="px-2 py-0.5 bg-blue-50 text-blue-700 rounded-full text-xs font-bold">{{ $siswa->jenis_kelamin ?? '-' }}</span></p>
                </div>
                <div>
                    <span class="text-gray-400">Tahun Ajaran</span>
                    <p class="font-medium text-gray-900">{{ $siswa->tahun_ajaran ?? '-' }}</p>
                </div>
                <div>
                    <span class="text-gray-400">Kelas</span>
                    <p class="font-medium text-gray-900">{{ $siswa->kelas->nama_kelas ?? '-' }}</p>
                </div>
            </div>
        </div>
        @empty
        <div class="p-6 text-center text-gray-500 text-sm">
            Tidak ada data siswa tersedia
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
        <p class="text-xs text-gray-500 font-medium">
            Showing <span class="font-bold text-gray-900">1-{{ $data->count() }}</span> of 
            <span class="font-bold text-gray-900">{{ $data->count() }}</span> students
        </p>
        <div class="flex gap-2">
            <button class="px-3 py-1.5 rounded-lg bg-gray-200 text-gray-400 font-bold text-xs cursor-not-allowed">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <button class="px-4 py-1.5 rounded-lg bg-blue-600 text-white font-bold text-xs shadow-sm">1</button>
            <button class="px-3 py-1.5 rounded-lg bg-white text-gray-700 font-bold text-xs hover:bg-gray-100 transition-colors border border-gray-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
    </div>
    </div>
    
    <!-- Detail Modal -->
<div id="detailModal" tabindex="-1" class="hidden fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm overflow-y-auto">
    <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-2xl mx-4 border border-gray-200">
    <!-- Modal Header -->
        <div class="flex items-center justify-between p-5 border-b border-gray-200 bg-gradient-to-r from-blue-600 to-blue-700 rounded-t-xl">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white font-bold text-lg ring-2 ring-white/30" id="modalAvatar">A</div>
                <div>
                    <h3 class="text-lg font-bold text-white" id="modalName">Nama Siswa</h3>
                </div>
            </div>
            <button type="button" data-modal-hide="detailModal" class="text-white hover:bg-white/20 rounded-lg p-2 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

    <!-- Modal Body -->
    <div class="p-6 space-y-5 max-h-[60vh] overflow-y-auto">
        <div class="bg-gray-50 rounded-lg p-4">
            <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-3 flex items-center gap-2">
                <svg class="w-6 h-6 text-blue-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
                </svg>
                Detail Siswa
            </h4>
            <div class="space-y-3 text-sm">
                <div class="flex items-start gap-3">
                    <span class="text-xs font-medium text-gray-500 w-32 shrink-0">NIS</span>
                    <span class="font-semibold text-gray-900 font-mono" id="modalNIS">-</span>
            </div>
            <div class="border-t border-gray-100"></div>
            <div class="flex items-start gap-3">
                <span class="text-xs font-medium text-gray-500 w-32 shrink-0">Nama Siswa</span>
                <span class="font-semibold text-gray-900" id="modalName2">-</span>
            </div>
            <div class="border-t border-gray-100"></div>
            <div class="flex items-start gap-3">
                <span class="text-xs font-medium text-gray-500 w-32 shrink-0">Jenis Kelamin</span>
                <span class="font-semibold text-gray-900" id="modalGender">-</span>
            </div>
            <div class="border-t border-gray-100"></div>
            <div class="flex items-start gap-3">
                <span class="text-xs font-medium text-gray-500 w-32 shrink-0">Tahun Ajaran</span>
                <span class="font-semibold text-gray-900" id="modalTahunAjaran">-</span>
            </div>
            <div class="border-t border-gray-100"></div>
            <div class="flex items-start gap-3">
                <span class="text-xs font-medium text-gray-500 w-32 shrink-0">Kelas</span>
                <span class="font-semibold text-gray-900" id="modalKelas">-</span>
            </div>
            <div class="border-t border-gray-100"></div>
            <div class="flex items-start gap-3">
                <span class="text-xs font-medium text-gray-500 w-32 shrink-0">Wali Kelas</span>
                <span class="font-semibold text-gray-900" id="modalWaliKelas">-</span>
            </div>
            <div class="border-t border-gray-100"></div>
            <div class="flex items-start gap-3">
                <span class="text-xs font-medium text-gray-500 w-32 shrink-0">Status</span>
                <span class="inline-flex items-center gap-1 bg-green-100 text-green-800 text-xs font-medium px-2.5 py-1 rounded-full">
                    <div class="w-2 h-2 rounded-full bg-green-500"></div>
                    Aktif
                </span>
            </div>
        </div>
    </div>
</div>

    <!-- Modal Footer -->
    <div class="flex items-center justify-end p-5 border-t border-gray-200 bg-gray-50 rounded-b-xl">
        <button type="button" data-modal-hide="detailModal" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 transition-colors">
        Tutup
        </button>
    </div>
</div>
</div>
@endsection
