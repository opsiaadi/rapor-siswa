@extends('layouts.admin', [
    'title' => 'Edit Guru',
    'pageTitle' => 'Edit Guru',
    'breadcrumb' => 'Data Guru › Edit Guru',
    'userName' => 'Admin TU'
])

@section('page-content')
<div class="space-y-6">
    <!-- Header -->
    <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-sm">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.guru.index') }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Edit Guru</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Ubah data guru mata pelajaran</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.guru.update', $guru->id) }}" method="POST" class="max-w-2xl">
        @csrf
        @method('PUT')
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
            <!-- Identitas -->
            <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/10 dark:to-purple-900/10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-indigo-500 flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">Identitas Guru</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Field bertanda <span class="text-red-500">*</span> wajib diisi</p>
                    </div>
                </div>
            </div>

            <div class="p-6 space-y-5">
                @if ($errors->any())
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <h4 class="text-sm font-medium text-red-800 dark:text-red-300">Terdapat kesalahan:</h4>
                            <ul class="mt-2 text-sm text-red-700 dark:text-red-400 list-disc list-inside">
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
                    <label for="nik" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">NIK <span class="text-red-500">*</span></label>
                    <input type="text" name="nik" id="nik" value="{{ old('nik', $guru->nik) }}"
                        class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm" required>
                </div>

                <!-- Nama -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Nama Guru <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $guru->nama) }}"
                        class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm" required>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email', $guru->email) }}"
                        class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm" required>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Password</label>
                    <input type="password" name="password" id="password"
                        class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                        placeholder="Kosongkan jika tidak ingin mengubah">
                    <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400">Minimal 8 karakter</p>
                </div>
            </div>

            <!-- Mata Pelajaran -->
            <div class="p-6 border-t border-gray-100 dark:border-gray-700 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/10 dark:to-purple-900/10">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-purple-500 flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">Mata Pelajaran yang Diampu</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Pilih satu atau lebih mapel</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @forelse ($mapelList as $mapel)
                    <label class="flex items-center gap-3 p-3 rounded-lg border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer transition-colors">
                        <input type="checkbox" name="mapel_ids[]" value="{{ $mapel->id }}"
                            {{ in_array($mapel->id, old('mapel_ids', $guru->mapel_ids ?? [])) ? 'checked' : '' }}
                            class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <div>
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $mapel->nama_mapel }}</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400 block">{{ $mapel->kode_mapel }}</span>
                        </div>
                    </label>
                    @empty
                    <p class="text-sm text-gray-500 dark:text-gray-400 col-span-2">Belum ada data mata pelajaran.</p>
                    @endforelse
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-100 dark:border-gray-700 flex items-center justify-end gap-3">
                <a href="{{ route('admin.guru.index') }}" class="px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">Batal</a>
                <button type="submit" class="px-4 py-2.5 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg focus:ring-4 focus:ring-indigo-300 transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
