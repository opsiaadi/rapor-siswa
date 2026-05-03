@extends('layouts.admin', [
    'title' => 'Data Guru',
    'pageTitle' => 'Data Guru',
    'breadcrumb' => 'Kelola data guru mata pelajaran',
    'userName' => 'Admin TU'
])

@section('content')
<div class="space-y-6">
    
    <!-- Toolbar Card -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div class="flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600 ">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M8 19h-3a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v11a1 1 0 0 1 -1 1" /><path d="M12 14a2 2 0 1 0 4.001 -.001a2 2 0 0 0 -4.001 .001" /><path d="M17 19a2 2 0 0 0 -2 -2h-2a2 2 0 0 0 -2 2" /></svg>
            </div>
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
                        <svg class="w-4 h-4 text-gray-500 " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" id="simple-search" name="search" value="{{ request('search', '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-2 focus:ring-purple-500/20 focus:border-purple-500 block w-full ps-10 p-2.5 transition-colors" placeholder="Cari guru...">
                </div>
            </form>
            <a href="{{ route('admin.guru.create') }}" class="text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:ring-purple-300 font-semibold rounded-full text-sm px-5 py-2.5 flex items-center justify-center gap-2 transition-all shadow-sm hover:shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Guru
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
<tbody class="divide-y divide-gray-200 ">
                    @forelse($data as $index => $guru)
                    <tr class="bg-white hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-900 ">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-6 py-4 text-gray-700 ">{{ $guru->nama ?? '-' }}</td>
                        <td class="px-6 py-4 text-gray-500 ">{{ $guru->nik ?? '-' }}</td>
                        <td class="px-6 py-4 text-gray-500 ">{{ $guru->email ?? '-' }}</td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.guru.edit', $guru->id) }}" class="text-blue-600 hover:text-blue-800 transition-colors">
                                   <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                   </svg>
                               </a>
                                <form action="{{ route('admin.guru.destroy', $guru->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data ini?')">
                                   @csrf
                                   @method('DELETE')
                                   <button type="submit" class="text-red-600 hover:text-red-800 transition-colors">
                                       <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
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
    </div>
</div>
@endsection
