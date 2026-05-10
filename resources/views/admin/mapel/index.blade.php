@extends('layouts.admin', [
    'title' => 'Data Mata Pelajaran',
    'pageTitle' => 'Data Mata Pelajaran',
    'breadcrumb' => 'Kelola data mata pelajaran',
    'userName' => 'Admin TU'
])

@section('content')
<div class="space-y-6">
    
    <!-- Toolbar Card -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div class="flex items-center gap-4">
            <svg class="w-6 h-6 text-amber-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path d="M9 6c0-1.65685 1.3431-3 3-3s3 1.34315 3 3-1.3431 3-3 3-3-1.34315-3-3Zm2 3.62992c-.1263-.04413-.25-.08799-.3721-.13131-1.33928-.47482-2.49256-.88372-4.77995-.8482C4.84875 8.66593 4 9.46413 4 10.5v7.2884c0 1.0878.91948 1.8747 1.92888 1.8616 1.283-.0168 2.04625.1322 2.79671.3587.29285.0883.57733.1863.90372.2987l.00249.0008c.11983.0413.24534.0845.379.1299.2989.1015.6242.2088.9892.3185V9.62992Zm2-.00374V20.7551c.5531-.1678 1.0379-.3374 1.4545-.4832.2956-.1034.5575-.1951.7846-.2653.7257-.2245 1.4655-.3734 2.7479-.3566.5019.0065.9806-.1791 1.3407-.4788.3618-.3011.6723-.781.6723-1.3828V10.5c0-.58114-.2923-1.05022-.6377-1.3503-.3441-.29904-.8047-.49168-1.2944-.49929-2.2667-.0352-3.386.36906-4.6847.83812-.1256.04539-.253.09138-.3832.13765Z"/>
            </svg>
            <div>
                <h3 class="text-base font-bold text-gray-900 tracking-tight">Manajemen Mata Pelajaran</h3>
                <p class="text-sm text-gray-500 ">Total <span class="text-amber-600 font-bold">{{ $data->count() }}</span> Mata Pelajaran</p>
            </div>
        </div>
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full md:w-auto">
            <form class="flex-1 sm:flex-initial" action="{{ route('admin.mapel.index') }}" method="GET">
                <label for="simple-search" class="sr-only">Cari</label>
                <div class="relative w-full sm:w-64">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-6 h-6 text-amber-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 6c0-1.65685 1.3431-3 3-3s3 1.34315 3 3-1.3431 3-3 3-3-1.34315-3-3Zm2 3.62992c-.1263-.04413-.25-.08799-.3721-.13131-1.33928-.47482-2.49256-.88372-4.77995-.8482C4.84875 8.66593 4 9.46413 4 10.5v7.2884c0 1.0878.91948 1.8747 1.92888 1.8616 1.283-.0168 2.04625.1322 2.79671.3587.29285.0883.57733.1863.90372.2987l.00249.0008c.11983.0413.24534.0845.379.1299.2989.1015.6242.2088.9892.3185V9.62992Zm2-.00374V20.7551c.5531-.1678 1.0379-.3374 1.4545-.4832.2956-.1034.5575-.1951.7846-.2653.7257-.2245 1.4655-.3734 2.7479-.3566.5019.0065.9806-.1791 1.3407-.4788.3618-.3011.6723-.781.6723-1.3828V10.5c0-.58114-.2923-1.05022-.6377-1.3503-.3441-.29904-.8047-.49168-1.2944-.49929-2.2667-.0352-3.386.36906-4.6847.83812-.1256.04539-.253.09138-.3832.13765Z"/>
                        </svg>
                    </div>
                    <input type="text" id="simple-search" name="search" value="{{ request('search', '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 block w-full ps-10 p-2.5 transition-colors" placeholder="Cari mapel...">
                </div>
            </form>
            <a href="{{ route('admin.mapel.create') }}" class="text-white bg-amber-600 hover:bg-amber-700 focus:ring-4 focus:ring-amber-300 font-semibold rounded-full text-sm px-5 py-2.5 flex items-center justify-center gap-2 transition-all duration-200 hover:scale-105 hover:shadow-lg active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Mapel
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
                        <th scope="col" class="px-6 py-4 font-bold tracking-wider">Kode Mapel</th>
                        <th scope="col" class="px-6 py-4 font-bold tracking-wider">Nama Mata Pelajaran</th>
                        <th scope="col" class="px-6 py-4 font-bold tracking-wider">KKM</th>
                        <th scope="col" class="px-6 py-4 font-bold tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($data as $index => $mapel)
                <tr class="bg-white border-b border-gray-100 hover:bg-gray-50 transition-colors group">
                    <td class="px-6 py-4 text-gray-500 font-medium">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                    <td class="px-6 py-4 font-mono text-gray-900 font-semibold tracking-tight">{{ $mapel->kode_mapel ?? 'MP-'.str_pad($mapel->id, 3, '0', STR_PAD_LEFT) }}</td>
                    <td class="px-6 py-4">
                        <span class="font-semibold text-gray-900">{{ $mapel->nama_mapel }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 bg-green-50 text-green-700 rounded-full text-xs font-bold uppercase tracking-tighter">{{ $mapel->kkm }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-1">
                            <a href="{{ route('admin.mapel.edit', $mapel->id) }}" class="text-gray-500 hover:text-amber-600 p-1.5 rounded-lg hover:bg-amber-50 transition-all duration-200 hover:scale-110 active:scale-95" title="Edit">
                                <svg class="w-6 h-6 text-sky-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03 1.03 0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z" clip-rule="evenodd"/>
                                </svg>
                            </a>
                            <form action="{{ route('admin.mapel.destroy', $mapel->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus mapel ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-500 hover:text-red-600 p-1.5 rounded-lg hover:bg-red-50 transition-all duration-200 hover:scale-110 active:scale-95" title="Hapus">
                                    <svg class="w-6 h-6 text-sky-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5v14m-6-8h6m-6 4h6m4.506-1.494L15.012 12m0 0 1.506-1.506M15.012 12l1.506 1.506M15.012 12l-1.506-1.506M20 19H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1Z"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        Tidak ada data mata pelajaran tersedia
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
            <span class="font-bold text-gray-900">{{ $data->count() }}</span> mapel
        </p>
        <div class="flex gap-2">
            <button class="px-3 py-1.5 rounded-lg bg-gray-200 text-gray-400 font-bold text-xs cursor-not-allowed">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <button class="px-4 py-1.5 rounded-lg bg-amber-600 text-white font-bold text-xs shadow-sm">1</button>
            <button class="px-3 py-1.5 rounded-lg bg-white text-gray-700 font-bold text-xs hover:bg-gray-100 transition-colors border border-gray-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
    </div>
</div>
@endsection
