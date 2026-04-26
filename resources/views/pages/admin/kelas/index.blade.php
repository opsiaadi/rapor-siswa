@extends('layouts.admin', [
    'title' => 'Data Kelas',
    'pageTitle' => 'Data Kelas',
    'breadcrumb' => 'Kelola data kelas dan wali kelas',
    'userName' => 'Admin TU'
])

@section('page-content')
<div class="space-y-6">

    <!-- Toolbar Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-5 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div class="flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-emerald-50 dark:bg-emerald-900/20 flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="flex-shrink-0" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 20v-9l-4 1.125V20h4Zm0 0h8m-8 0V6.66667M16 20v-9l4 1.125V20h-4Zm0 0V6.66667M18 8l-6-4-6 4m5 1h2m-2 3h2"/></svg>
            </div>
            <div>
                <h3 class="text-base font-bold text-gray-900 dark:text-gray-100 tracking-tight">Manajemen Data Kelas</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total <span class="text-emerald-600 dark:text-emerald-400 font-bold">{{ count($data ?? []) }}</span> Kelas</p>
            </div>
        </div>
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full md:w-auto">
            <form class="flex-1 sm:flex-initial" action="{{ route('admin.kelas.index') }}" method="GET">
                <label for="simple-search" class="sr-only">Cari</label>
                <div class="relative w-full sm:w-64">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" id="simple-search" name="search" value="{{ request('search', '') }}" class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 text-sm rounded-full focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 block w-full ps-10 p-2.5 transition-colors" placeholder="Cari kelas...">
                </div>
            </form>
            <a href="{{ route('admin.kelas.create') }}" class="text-white bg-emerald-600 hover:bg-emerald-700 focus:ring-4 focus:ring-emerald-300 dark:focus:ring-emerald-800 font-semibold rounded-full text-sm px-5 py-2.5 flex items-center justify-center gap-2 transition-all shadow-sm hover:shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Kelas
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 dark:text-gray-300 uppercase bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-600">
                    <tr>
                        <th scope="col" class="px-6 py-4 font-bold tracking-wider">No</th>
                        <th scope="col" class="px-6 py-4 font-bold tracking-wider">Nama Kelas</th>
                        <th scope="col" class="px-6 py-4 font-bold tracking-wider">Tingkat</th>
                        <th scope="col" class="px-6 py-4 font-bold tracking-wider">Wali Kelas</th>
                        <th scope="col" class="px-6 py-4 font-bold tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @forelse($data ?? [] as $kelas)
                    <tr class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700/50 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors group">
                        <td class="px-6 py-4 text-gray-500 dark:text-gray-400 font-medium">{{ str_pad($no, 2, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xs font-bold shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M4 21v-15c0 -1 1 -2 2 -2h5c1 0 2 1 2 2v15" /><path d="M16 8h2c1 0 2 1 2 2v11" /><path d="M3 21h18" /><path d="M10 12v.01" /><path d="M10 16v.01" /><path d="M10 8v.01" /><path d="M7 12v.01" /><path d="M7 16v.01" /><path d="M7 8v.01" /><path d="M17 12v.01" /><path d="M17 16v.01" /></svg>
                                </div>
                                <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $kelas->nama_kelas ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 rounded-full text-xs font-bold">{{ $kelas->tingkat ?? '-' }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xs font-bold">
                                    {{ strtoupper(substr($kelas->wali_nama ?? 'W', 0, 1)) }}
                                </div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">{{ $kelas->wali_nama ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-1">
                                <a href="{{ route('admin.kelas.edit', $kelas->id) }}" class="text-gray-500 hover:text-amber-600 dark:hover:text-amber-400 p-1.5 rounded-lg hover:bg-amber-50 dark:hover:bg-amber-900/20 transition-colors" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.kelas.destroy', $kelas->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kelas ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-500 hover:text-red-600 dark:hover:text-red-400 p-1.5 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @php $no++; @endphp
                    @empty
                    <tr class="bg-white dark:bg-gray-800">
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-gray-400 dark:text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M4 21v-15c0 -1 1 -2 2 -2h5c1 0 2 1 2 2v15" /><path d="M16 8h2c1 0 2 1 2 2v11" /><path d="M3 21h18" /><path d="M10 12v.01" /><path d="M10 16v.01" /><path d="M10 8v.01" /><path d="M7 12v.01" /><path d="M7 16v.01" /><path d="M7 8v.01" /><path d="M17 12v.01" /><path d="M17 16v.01" /></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">Belum ada data kelas</p>
                                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Klik "Tambah Kelas" untuk menambahkan</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if(count($data ?? []) > 0)
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/30 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between">
            <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Showing <span class="font-bold text-gray-900 dark:text-gray-100">1-{{ count($data ?? []) }}</span> of <span class="font-bold text-gray-900 dark:text-gray-100">{{ count($data ?? []) }}</span> classes</p>
            <div class="flex gap-2">
                <button class="px-3 py-1.5 rounded-lg bg-gray-200 dark:bg-gray-600 text-gray-400 dark:text-gray-500 font-bold text-xs cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button class="px-4 py-1.5 rounded-lg bg-emerald-600 text-white font-bold text-xs shadow-sm">1</button>
                <button class="px-3 py-1.5 rounded-lg bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-bold text-xs hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors border border-gray-200 dark:border-gray-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
