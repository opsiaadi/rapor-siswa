@extends('layouts.admin', [
    'title' => 'Tambah Mata Pelajaran',
    'pageTitle' => 'Tambah Mata Pelajaran',
    'breadcrumb' => 'Data Mapel › Tambah Mapel',
    'userName' => 'Admin TU'
])

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-sm">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.mapel.index') }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Tambah Mata Pelajaran Baru</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Lengkapi data mata pelajaran yang akan diajarkan</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.mapel.store') }}" method="POST" class="max-w-2xl">
        @csrf
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-900/10 dark:to-orange-900/10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-amber-500 flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">Identitas Mata Pelajaran</h3>
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

                <!-- Kode Mapel -->
                <div>
                    <label for="kode_mapel" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                        Kode Mapel <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="kode_mapel" id="kode_mapel" value="{{ old('kode_mapel') }}"
                        class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 text-sm"
                        placeholder="Contoh: MTK, BIN, IPA" required>
                    <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400">Harus unik (misal: MTK untuk Matematika)</p>
                </div>

                <!-- Nama Mapel -->
                <div>
                    <label for="nama_mapel" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                        Nama Mata Pelajaran <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_mapel" id="nama_mapel" value="{{ old('nama_mapel') }}"
                        class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 text-sm"
                        placeholder="Contoh: Matematika" required>
                </div>

                <!-- KKM -->
                <div>
                    <label for="kkm" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                        KKM (Kriteria Ketuntasan Minimal) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="kkm" id="kkm" value="{{ old('kkm', 75) }}" min="0" max="100"
                        class="w-full sm:w-32 px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 text-sm"
                        required>
                    <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400">Nilai minimal ketuntasan (0-100)</p>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-100 dark:border-gray-700 flex items-center justify-end gap-3">
                <a href="{{ route('admin.mapel.index') }}" class="px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2.5 text-sm font-medium text-white bg-amber-600 hover:bg-amber-700 rounded-lg focus:ring-4 focus:ring-amber-300 dark:focus:ring-amber-800 transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Mapel
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
