@extends('layouts.admin', [
    'title' => 'Edit Kelas',
    'pageTitle' => 'Edit Kelas',
    'breadcrumb' => 'Data Kelas › Edit Kelas',
    'userName' => 'Admin TU'
])

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-sm">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.kelas.index') }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Edit Kelas</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Ubah data kelas dan pengaturan mapel</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.kelas.update', $kelas->id) }}" method="POST" class="max-w-2xl">
        @csrf
        @method('PUT')
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
            <!-- Identitas Kelas -->
            <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-emerald-900/10 dark:to-teal-900/10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-emerald-500 flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">Identitas Kelas</h3>
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

                <div>
                    <label for="nama_kelas" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Nama Kelas <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_kelas" id="nama_kelas" value="{{ old('nama_kelas', $kelas->nama_kelas) }}"
                        class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm" required>
                </div>

                <div>
                    <label for="tingkat" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Tingkat <span class="text-red-500">*</span></label>
                    <select name="tingkat" id="tingkat" class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm" required>
                        @foreach (['VII', 'VIII', 'IX', 'X', 'XI', 'XII'] as $tingkat)
                        <option value="{{ $tingkat }}" {{ old('tingkat', $kelas->tingkat) == $tingkat ? 'selected' : '' }}>{{ $tingkat }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="wali_kelas_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Wali Kelas</label>
                    <select name="wali_kelas_id" id="wali_kelas_id" class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                        <option value="">-- Pilih Wali Kelas --</option>
                        @forelse ($guruList as $guru)
                        <option value="{{ $guru->id }}" {{ old('wali_kelas_id', $kelas->wali_kelas_id) == $guru->id ? 'selected' : '' }}>{{ $guru->nama }}</option>
                        @empty
                        <option value="" disabled>Belum ada data guru</option>
                        @endforelse
                    </select>
                </div>
            </div>

            <!-- Mata Pelajaran -->
            <div class="p-6 border-t border-gray-100 dark:border-gray-700 bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-emerald-900/10 dark:to-teal-900/10">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-teal-500 flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">Mata Pelajaran di Kelas Ini</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Centang mapel, guru pengampu otomatis terpilih</p>
                    </div>
                </div>

                <div class="space-y-3">
                    @forelse ($mapelList as $mapel)
                    @php
                        $guruId = $currentMapelGuru[$mapel->id] ?? null;
                        $guruPengampu = $guruId 
                            ? $guruList->firstWhere('id', $guruId) 
                            : \App\Helpers\FakeDataHelper::findGuruByMapel($mapel->id);
                    @endphp
                    <div class="p-4 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700/50">
                        <div class="flex items-start gap-3">
                            <input type="checkbox" name="mapel_ids[]" value="{{ $mapel->id }}" id="mapel_{{ $mapel->id }}"
                                {{ in_array($mapel->id, old('mapel_ids', $kelas->mapel->pluck('id')->toArray())) ? 'checked' : '' }}
                                class="mt-1 w-4 h-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                            <div class="flex-1">
                                <label for="mapel_{{ $mapel->id }}" class="text-sm font-medium text-gray-900 dark:text-gray-100 cursor-pointer">
                                    {{ $mapel->nama_mapel }} <span class="text-xs text-gray-500 dark:text-gray-400">({{ $mapel->kode_mapel }})</span>
                                </label>
                                <input type="hidden" name="mapel_guru[{{ $mapel->id }}]" value="{{ $guruPengampu?->id ?? '' }}">
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                    <span class="font-medium">Guru Pengampu:</span> {{ $guruPengampu?->nama ?? 'Belum ada guru pengampu' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada data mata pelajaran.</p>
                    @endforelse
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-100 dark:border-gray-700 flex items-center justify-end gap-3">
                <a href="{{ route('admin.kelas.index') }}" class="px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">Batal</a>
                <button type="submit" class="px-4 py-2.5 text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg focus:ring-4 focus:ring-emerald-300 transition-colors flex items-center gap-2">
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
