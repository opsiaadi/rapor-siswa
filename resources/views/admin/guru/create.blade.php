@extends('layouts.admin', [
    'title' => 'Tambah Guru',
    'pageTitle' => 'Tambah Guru',
    'breadcrumb' => 'Data Guru › Tambah Guru',
    'userName' => 'Admin TU'
])

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-sm">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.guru.index') }}" class="text-gray-400 hover:text-gray-600 ">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h2 class="text-lg font-semibold text-gray-900 ">Tambah Guru Baru</h2>
                <p class="text-sm text-gray-500  mt-1">Lengkapi data guru mata pelajaran</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.guru.store') }}" method="POST" class="max-w-2xl">
        @csrf
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100  bg-gradient-to-r from-indigo-50 to-purple-50  ">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-indigo-500 flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-gray-900 ">Identitas Guru</h3>
                        <p class="text-sm text-gray-500 ">Field bertanda <span class="text-red-500">*</span> wajib diisi</p>
                    </div>
                </div>
            </div>

            <div class="p-6 space-y-5">
                @if ($errors->any())
                <div class="bg-red-50  border border-red-200  rounded-lg p-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <h4 class="text-sm font-medium text-red-800 ">Terdapat kesalahan:</h4>
                            <ul class="mt-2 text-sm text-red-700  list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif

                <!-- NIK -->
                <div>
                    <label for="nik" class="block mb-2.5 text-sm font-medium text-heading ">
                        NIK <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nik" id="nik" value="{{ old('nik') }}"
                        class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body    "
                        placeholder="Contoh: 198501012010011001" required>
                </div>

                <!-- Nama -->
                <div>
                    <label for="nama" class="block mb-2.5 text-sm font-medium text-heading ">
                        Nama Guru <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                        class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body    "
                        placeholder="Masukkan nama lengkap" required>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block mb-2.5 text-sm font-medium text-heading ">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body    "
                        placeholder="guru@sekolah.sch.id" required>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block mb-2.5 text-sm font-medium text-heading ">
                        Password <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="password" id="password"
                        class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body    "
                        placeholder="Minimal 8 karakter" required>
                </div>
            </div>

            <!-- Mata Pelajaran -->
            <div class="p-6 border-t border-gray-100  bg-gradient-to-r from-indigo-50 to-purple-50  ">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-purple-500 flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-gray-900 ">Mata Pelajaran yang Diampu</h3>
                        <p class="text-sm text-gray-500 ">Pilih satu atau lebih mapel</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @forelse ($mapelList as $mapel)
                    <label class="flex items-center gap-3 p-3 rounded-lg border border-gray-200  hover:bg-gray-50  cursor-pointer transition-colors">
                        <input type="checkbox" name="mapel_ids[]" value="{{ $mapel->id }}" 
                        {{ in_array($mapel->id, old('mapel_ids', [])) ? 'checked' : '' }}
                        class="w-4 h-4 border border-default-medium rounded-xs bg-neutral-secondary-medium focus:ring-2 focus:ring-brand-soft text-brand">
                        <div>
                            <span class="text-sm font-medium text-gray-900 ">{{ $mapel->nama_mapel }}</span>
                            <span class="text-xs text-gray-500  block">{{ $mapel->kode_mapel }}</span>
                        </div>
                    </label>
                    @empty
                    <p class="text-sm text-gray-500  col-span-2">Belum ada data mata pelajaran. <a href="{{ route('admin.mapel.create') }}" class="text-indigo-600 hover:underline">Tambahkan mapel terlebih dahulu</a>.</p>
                    @endforelse
                </div>
                @error('mapel_ids')
                <p class="mt-2 text-sm text-red-600 ">{{ $message }}</p>
                @enderror
            </div>

            <div class="px-6 py-4 bg-gray-50  border-t border-gray-100  flex items-center justify-end gap-3">
                <a href="{{ route('admin.guru.index') }}" class="px-4 py-2.5 text-sm font-medium text-gray-700  bg-white  border border-gray-300  rounded-lg hover:bg-gray-50  transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2.5 text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 rounded-lg focus:ring-4 focus:ring-purple-300 transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Guru
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
