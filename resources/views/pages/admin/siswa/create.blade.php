@extends('layouts.admin', [
    'title' => 'Tambah Siswa',
    'pageTitle' => 'Tambah Siswa',
    'breadcrumb' => 'Data Siswa › Tambah Siswa',
    'userName' => 'Admin TU'
])

@section('page-content')
<div class="space-y-6">
    <!-- Header -->
    <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-sm">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.siswa.index') }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Tambah Siswa Baru</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Lengkapi data siswa baru</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.siswa.store') }}" method="POST" class="max-w-2xl">
        @csrf
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
            <!-- Identitas -->
            <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/10 dark:to-indigo-900/10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-blue-500 flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">Identitas Siswa</h3>
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

                <!-- NIS -->
                <div>
                    <label for="nis" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">NIS <span class="text-red-500">*</span></label>
                    <input type="text" name="nis" id="nis" value="{{ old('nis') }}"
                        class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                        placeholder="Contoh: 2025001" required>
                    <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400">Harus memasukkan dalam bentuk angka</p>
                </div>

                <!-- Nama Siswa -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Nama Siswa <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                        class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                        placeholder="Masukkan nama lengkap" required>
                </div>

                <!-- Jenis Kelamin -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                    <div class="flex gap-6">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="jenis_kelamin" value="L" {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }}
                                class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                            <span class="text-sm text-gray-700 dark:text-gray-300">Laki-laki</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="jenis_kelamin" value="P" {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }}
                                class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                            <span class="text-sm text-gray-700 dark:text-gray-300">Perempuan</span>
                        </label>
                    </div>
                </div>

                <!-- Tahun Ajaran -->
                <div>
                    <label for="tahun_ajaran" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Tahun Ajaran <span class="text-red-500">*</span></label>
                    <select name="tahun_ajaran" id="tahun_ajaran"
                        class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                        <option value="">-- Pilih Tahun Ajaran --</option>
                        <option value="2024/2025" {{ old('tahun_ajaran') == '2024/2025' ? 'selected' : '' }}>2024/2025</option>
                        <option value="2025/2026" {{ old('tahun_ajaran') == '2025/2026' ? 'selected' : '' }}>2025/2026</option>
                        <option value="2026/2027" {{ old('tahun_ajaran') == '2026/2027' ? 'selected' : '' }}>2026/2027</option>
                    </select>
                </div>

                <!-- Kelas -->
                <div>
                    <label for="kelas_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Kelas <span class="text-red-500">*</span></label>
                    <select name="kelas_id" id="kelas_id"
                        class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                        <option value="">-- Pilih Kelas --</option>
                        @forelse ($kelasList as $kelas)
                        <option value="{{ $kelas->id }}" {{ old('kelas_id') == $kelas->id ? 'selected' : '' }}>{{ $kelas->nama_kelas }} (Tingkat {{ $kelas->tingkat }})</option>
                        @empty
                        <option value="" disabled>Belum ada data kelas</option>
                        @endforelse
                    </select>
                    <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400">Siswa otomatis mengikuti mapel & guru di kelas ini</p>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-100 dark:border-gray-700 flex items-center justify-end gap-3">
                <a href="{{ route('admin.siswa.index') }}" class="px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">Batal</a>
                <button type="submit" class="px-4 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-300 transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Siswa
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
