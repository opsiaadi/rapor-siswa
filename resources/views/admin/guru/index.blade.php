@extends('layouts.admin', [
    'title' => 'Data Guru',
    'pageTitle' => 'Data Guru',
    'breadcrumb' => 'Kelola data guru mata pelajaran',
    'userName' => session('user.name', 'Admin TU')
])

@section('content')
<div class="space-y-6">

<!-- Toolbar Card -->
<div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <div class="flex items-center gap-4">
        <svg class="w-6 h-6 text-purple-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path d="M16 10c0-.55228-.4477-1-1-1h-3v2h3c.5523 0 1-.4477 1-1Z"/>
            <path d="M13 15v-2h2c1.6569 0 3-1.3431 3-3 0-1.65685-1.3431-3-3-3h-2.256c.1658-.46917.256-.97405.256-1.5 0-.51464-.0864-1.0091-.2454-1.46967C12.8331 4.01052 12.9153 4 13 4h7c.5523 0 1 .44772 1 1v9c0 .5523-.4477 1-1 1h-2.5l1.9231 4.6154c.2124.5098-.0287 1.0953-.5385 1.3077-.5098.2124-1.0953-.0287-1.3077-.5385L15.75 16l-1.827 4.3846c-.1825.438-.6403.6776-1.0889.6018.1075-.3089.1659-.6408.1659-.9864v-2.6002L14 15h-1ZM6 5.5C6 4.11929 7.11929 3 8.5 3S11 4.11929 11 5.5 9.88071 8 8.5 8 6 6.88071 6 5.5Z"/>
            <path d="M15 11h-4v9c0 .5523-.4477 1-1 1-.55228 0-1-.4477-1-1v-4H8v4c0 .5523-.44772 1-1 1s-1-.4477-1-1v-6.6973l-1.16797 1.752c-.30635.4595-.92722.5837-1.38675.2773-.45952-.3063-.5837-.9272-.27735-1.3867l2.99228-4.48843c.09402-.14507.2246-.26423.37869-.34445.11427-.05949.24148-.09755.3763-.10887.03364-.00289.06747-.00408.10134-.00355H15c.5523 0 1 .44772 1 1 0 .5523-.4477 1-1 1Z"/>
        </svg>
        <div>
            <h3 class="text-base font-bold text-gray-900 tracking-tight">Manajemen Data Guru</h3>
            <p class="text-sm text-gray-500 ">Total <span class="text-purple-600 font-bold">{{ $data->count() }}</span> Guru terdaftar</p>
        </div>
    </div>
    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full md:w-auto">
        <form class="flex-1 sm:flex-initial" action="{{ route('admin.guru.index') }}" method="GET">
            <label for="simple-search" class="sr-only">Cari</label>
            <div class="relative w-full sm:w-64">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-6 h-6 text-purple-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M16 10c0-.55228-.4477-1-1-1h-3v2h3c.5523 0 1-.4477 1-1Z"/>
                        <path d="M13 15v-2h2c1.6569 0 3-1.3431 3-3 0-1.65685-1.3431-3-3-3h-2.256c.1658-.46917.256-.97405.256-1.5 0-.51464-.0864-1.0091-.2454-1.46967C12.8331 4.01052 12.9153 4 13 4h7c.5523 0 1 .44772 1 1v9c0 .5523-.4477 1-1 1h-2.5l1.9231 4.6154c.2124.5098-.0287 1.0953-.5385 1.3077-.5098.2124-1.0953-.0287-1.3077-.5385L15.75 16l-1.827 4.3846c-.1825.438-.6403.6776-1.0889.6018.1075-.3089.1659-.6408.1659-.9864v-2.6002L14 15h-1ZM6 5.5C6 4.11929 7.11929 3 8.5 3S11 4.11929 11 5.5 9.88071 8 8.5 8 6 6.88071 6 5.5Z"/>
                        <path d="M15 11h-4v9c0 .5523-.4477 1-1 1-.55228 0-1-.4477-1-1v-4H8v4c0 .5523-.44772 1-1 1s-1-.4477-1-1v-6.6973l-1.16797 1.752c-.30635.4595-.92722.5837-1.38675.2773-.45952-.3063-.5837-.9272-.27735-1.3867l2.99228-4.48843c.09402-.14507.2246-.26423.37869-.34445.11427-.05949.24148-.09755.3763-.10887.03364-.00289.06747-.00408.10134-.00355H15c.5523 0 1 .44772 1 1 0 .5523-.4477 1-1 1Z"/>
                    </svg>
                </div>
                <input type="text" id="simple-search" name="search" value="{{ request('search', '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-2 focus:ring-purple-500/20 focus:border-purple-500 block w-full ps-10 p-2.5 transition-colors" placeholder="Cari guru...">
            </div>
        </form>
        <a href="{{ route('admin.guru.create') }}" class="text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:ring-purple-300 font-semibold rounded-full text-sm px-5 py-2.5 flex items-center justify-center gap-2 transition-all shadow-sm hover:shadow-md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>Tambah Guru
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
                    <th scope="col" class="px-6 py-4 font-bold tracking-wider">Nama Guru</th>
                    <th scope="col" class="px-6 py-4 font-bold tracking-wider">NIK</th>
                    <th scope="col" class="px-6 py-4 font-bold tracking-wider">Email</th>
                    <th scope="col" class="px-6 py-4 font-bold tracking-wider text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $index => $guru)
                    <tr class="bg-white border-b border-gray-100 hover:bg-gray-50 transition-colors group">
                        <td class="px-6 py-4 text-gray-500 font-medium">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center text-xs font-bold">
                                    {{ strtoupper(substr($guru->nama ?? 'G', 0, 1)) }}
                                </div>
                                <span class="font-semibold text-gray-900">{{ $guru->nama ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-mono text-gray-900 font-semibold tracking-tight">{{ $guru->nik ?? '-' }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $guru->email ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-1">
                                <a href="{{ route('admin.guru.edit', $guru->id) }}" class="text-gray-500 hover:text-amber-600 p-1.5 rounded-lg hover:bg-amber-50 transition-colors" title="Edit">
                                    <svg class="w-6 h-6 text-sky-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03 1.03 0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z" clip-rule="evenodd"/>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.guru.destroy', $guru->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus guru ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-500 hover:text-red-600 p-1.5 rounded-lg hover:bg-red-50 transition-colors" title="Hapus">
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
                        Tidak ada data guru tersedia
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
            <span class="font-bold text-gray-900">{{ $data->count() }}</span> guru
        </p>
        <div class="flex gap-2">
            <button class="px-3 py-1.5 rounded-lg bg-gray-200 text-gray-400 font-bold text-xs cursor-not-allowed">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <button class="px-4 py-1.5 rounded-lg bg-purple-600 text-white font-bold text-xs shadow-sm">1</button>
            <button class="px-3 py-1.5 rounded-lg bg-white text-gray-700 font-bold text-xs hover:bg-gray-100 transition-colors border border-gray-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
    </div>
</div>
@endsection