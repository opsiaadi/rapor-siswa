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
            <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center text-amber-600 ">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12" /><path d="M19 16h-12a2 2 0 0 0 -2 2" /><path d="M9 8h6" /></svg>
            </div>
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
                        <svg class="w-4 h-4 text-gray-500 " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 1 1 -14 0 7 7 0 0 1 14 0z"/>
                        </svg>
                    </div>
                    <input type="text" id="simple-search" name="search" value="{{ request('search', '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 block w-full ps-10 p-2.5 transition-colors" placeholder="Cari mapel...">
                </div>
            </form>
            <a href="{{ route('admin.mapel.create') }}" class="text-white bg-amber-600 hover:bg-amber-700 focus:ring-4 focus:ring-amber-300 font-semibold rounded-full text-sm px-5 py-2.5 flex items-center justify-center gap-2 transition-all shadow-sm hover:shadow-md">
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
                <tbody class="divide-y divide-gray-200 ">
                    @foreach($data as $mapel)
                    <tr class="bg-white hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-900 ">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 text-gray-700 ">{{ $mapel->kode_mapel ?? 'MP-'.str_pad($mapel->id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-6 py-4 font-semibold text-gray-900 ">{{ $mapel->nama }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-50 text-green-700">{{ $mapel->kkm }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.mapel.edit', $mapel->id) }}" class="text-blue-600 hover:text-blue-800 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 0 0 -2 2v11a2 2 0 0 0 2 2h11a2 2 0 0 0 2 -2v-5m-1.414-9.414a2 2 0 1 1 2.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.mapel.destroy', $mapel->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0 1 16.138 21H7.862a2 2 0 0 1 -1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 0 0 -1 -1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
            <p class="text-xs text-gray-500 font-medium">Showing <span class="font-bold text-gray-900 ">1-2</span> of <span class="font-bold text-gray-900 ">2</span> subjects</p>
            <div class="flex gap-2">
                <button class="px-3 py-1.5 rounded-lg bg-gray-200 text-gray-400 font-bold text-xs cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button class="px-4 py-1.5 rounded-lg bg-amber-600 text-white font-bold text-xs shadow-sm">1</button>
                <button class="px-3 py-1.5 rounded-lg bg-white text-gray-700 font-bold text-xs hover:bg-gray-100 transition-colors border border-gray-200 ">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
    </div>
@endsection
