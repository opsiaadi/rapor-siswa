@extends('layouts.admin', [
    'title' => 'Ekstrakurikuler',
    'pageTitle' => 'Ekstrakurikuler',
    'breadcrumb' => 'Kelola data ekstrakurikuler',
    'userName' => session('user.name', 'Admin TU')
])

@section('content')
<div class="space-y-6">

<!-- Toolbar Card -->
<div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <div class="flex items-center gap-4">
        <div class="w-11 h-11 rounded-xl bg-orange-50 flex items-center justify-center text-white">
            <svg class="w-6 h-6 text-orange-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
            </svg>
        </div>
        <div>
            <h3 class="text-base font-bold text-gray-900 tracking-tight">Manajemen Ekstrakurikuler</h3>
            <p class="text-sm text-gray-500">Total <span class="text-orange-500 font-bold">{{ $data->count() }}</span> ekstrakurikuler terdaftar</p>
        </div>
    </div>
    <a href="{{ route('admin.eskul.create') }}" class="text-white bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:ring-orange-300 font-semibold rounded-full text-sm px-5 py-2.5 flex items-center justify-center gap-2 transition-all duration-200 hover:scale-105 hover:shadow-lg active:scale-95">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>Tambah Eskul
    </a>
</div>

<!-- Table (Desktop) -->
<div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="relative overflow-x-auto hidden md:block">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
                <tr>
                    <th scope="col" class="px-6 py-4 font-bold tracking-wider">No</th>
                    <th scope="col" class="px-6 py-4 font-bold tracking-wider">Nama Ekstrakurikuler</th>
                    <th scope="col" class="px-6 py-4 font-bold tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-4 font-bold tracking-wider text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse($data as $index => $item)
                <tr class="bg-white border-b border-gray-100 hover:bg-gray-50 transition-colors group">
                    <td class="px-6 py-4 text-gray-500 font-medium">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-xs font-bold">
                                {{ strtoupper(substr($item->nama, 0, 1)) }}
                            </div>
                            <span class="font-semibold text-gray-900">{{ $item->nama }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @if($item->is_aktif)
                            <span class="px-3 py-1 bg-green-50 text-green-700 rounded-full text-xs font-bold">Aktif</span>
                        @else
                            <span class="px-3 py-1 bg-red-50 text-red-700 rounded-full text-xs font-bold">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-1">
                            <a href="{{ route('admin.eskul.edit', $item->id) }}" class="text-gray-500 hover:text-amber-600 p-1.5 rounded-lg hover:bg-amber-50 transition-all duration-200 hover:scale-110 active:scale-95" title="Edit">
                                <svg class="w-6 h-6 text-sky-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03 1.03 0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z" clip-rule="evenodd"/>
                                </svg>
                            </a>
                            <form action="{{ route('admin.eskul.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus eskul ini?')">
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
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                        Tidak ada data ekstrakurikuler tersedia
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Card View (Mobile) -->
    <div class="block md:hidden divide-y divide-gray-100">
        @forelse($data as $index => $item)
        <div class="p-4 hover:bg-gray-50 transition-colors">
            <div class="flex items-start justify-between mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-sm font-bold">
                        {{ strtoupper(substr($item->nama, 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">{{ $item->nama }}</p>
                        <p class="text-xs text-gray-500">#{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-1">
                    <a href="{{ route('admin.eskul.edit', $item->id) }}" class="text-gray-500 hover:text-amber-600 p-2 rounded-lg hover:bg-amber-50 transition-all" title="Edit">
                        <svg class="w-5 h-5 text-sky-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03 1.03 0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                    <form action="{{ route('admin.eskul.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus eskul ini?')">
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
                    <span class="text-gray-400">Status</span>
                    <p>
                        @if($item->is_aktif)
                            <span class="px-2 py-0.5 bg-green-50 text-green-700 rounded-full text-xs font-bold">Aktif</span>
                        @else
                            <span class="px-2 py-0.5 bg-red-50 text-red-700 rounded-full text-xs font-bold">Nonaktif</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        @empty
        <div class="p-6 text-center text-gray-500 text-sm">
            Tidak ada data ekstrakurikuler tersedia
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
        <p class="text-xs text-gray-500 font-medium">
            Showing <span class="font-bold text-gray-900">1-{{ $data->count() }}</span> of
            <span class="font-bold text-gray-900">{{ $data->count() }}</span> eskul
        </p>
    </div>
</div>
</div>
@endsection
