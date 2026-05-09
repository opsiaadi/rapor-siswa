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
        <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 ">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
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
        <a href="{{ route('admin.siswa.create') }}" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-semibold rounded-full text-sm px-5 py-2.5 flex items-center justify-center gap-2 transition-all shadow-sm hover:shadow-md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>Tambah Siswa
        </a>
    </div>
</div>

<!-- Table -->
<div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="relative overflow-x-auto">
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
                            <button onclick="openDetailModal('{{ strtoupper(substr($siswa->nama ?? 'S', 0, 1)) }}', '{{ $siswa->nama ?? '-' }}', '{{ $siswa->nis ?? '-' }}', '{{ $siswa->jenis_kelamin ?? '-' }}', '{{ $siswa->tahun_ajaran ?? '-' }}', '{{ $siswa->kelas->nama_kelas ?? '-' }}', '{{ $siswa->kelas->waliKelas->nama ?? '-' }}')" class="text-gray-500 hover:text-blue-600 p-1.5 rounded-lg hover:bg-blue-50 transition-colors" title="Detail Siswa">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                            <a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="text-gray-500 hover:text-amber-600 p-1.5 rounded-lg hover:bg-amber-50 transition-colors" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus siswa ini?')">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="text-gray-500 hover:text-red-600 p-1.5 rounded-lg hover:bg-red-50 transition-colors" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
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
                    <p class="text-xs text-blue-100/80" id="modalClass">Kelas -</p>
                </div>
            </div>
            <button onclick="closeDetailModal()" class="text-white hover:bg-white/20 rounded-lg p-2 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

    <!-- Modal Body -->
    <div class="p-6 space-y-5 max-h-[60vh] overflow-y-auto">
        <div class="bg-gray-50 rounded-lg p-4">
            <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-3 flex items-center gap-2">
                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
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
        <button onclick="closeDetailModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 transition-colors">
        Tutup
        </button>
    </div>
</div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/detail-modal.js') }}"></script>
@endpush

