@extends('layouts.admin', [
    'title' => 'Edit Kelas',
    'pageTitle' => 'Edit Kelas',
    'breadcrumb' => 'Data Kelas › Edit Kelas',
    'userName' => 'Admin TU'
])

@section('page-content')
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

    <!-- 2 Kolom -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Kolom Kiri: Form (Identitas + Mapel) -->
        <div class="lg:col-span-1">
            <form action="{{ route('admin.kelas.update', $kelas->id) }}" method="POST" class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                @csrf
                @method('PUT')

                <!-- Identitas Kelas (samain bg kayak mapel) -->
                <div class="p-4 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-teal-50 to-cyan-50 dark:from-teal-900/10 dark:to-cyan-900/10">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-teal-500 flex items-center justify-center text-white">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Identitas Kelas</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Field <span class="text-red-500">*</span> wajib</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 space-y-4">
                    <div>
                        <label for="nama_kelas" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Kelas <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_kelas" id="nama_kelas" value="{{ old('nama_kelas', $kelas->nama_kelas) }}"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 focus:ring-emerald-500 focus:border-emerald-500" required>
                    </div>

                    <div>
                        <label for="tingkat" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Tingkat <span class="text-red-500">*</span></label>
                        <select name="tingkat" id="tingkat" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700" required>
                            @foreach (['VII', 'VIII', 'IX', 'X', 'XI', 'XII'] as $tingkat)
                            <option value="{{ $tingkat }}" {{ old('tingkat', $kelas->tingkat) == $tingkat ? 'selected' : '' }}>{{ $tingkat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="wali_kelas_id" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Wali Kelas</label>
                        <select name="wali_kelas_id" id="wali_kelas_id" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700">
                            <option value="">-- Pilih --</option>
                            @forelse ($guruList as $guru)
                            <option value="{{ $guru->id }}" {{ old('wali_kelas_id', $kelas->wali_kelas_id) == $guru->id ? 'selected' : '' }}>{{ $guru->nama }}</option>
                            @empty
                            <option disabled>Belum ada guru</option>
                            @endforelse
                        </select>
                    </div>
                </div>

                <!-- Mapel (didalam form) -->
                <div class="p-4 border-t border-gray-100 dark:border-gray-700 bg-gradient-to-r from-teal-50 to-cyan-50 dark:from-teal-900/10 dark:to-cyan-900/10">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-9 h-9 rounded-lg bg-teal-500 flex items-center justify-center text-white">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Mata Pelajaran</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Centang mapel, guru auto</p>
                        </div>
                    </div>

                    <div class="space-y-2">
                        @forelse ($mapelList as $mapel)
                        @php
                            $guruId = $currentMapelGuru[$mapel->id] ?? null;
                            $guruPengampu = $guruId
                                ? $guruList->firstWhere('id', $guruId)
                                : \App\Helpers\FakeDataHelper::findGuruByMapel($mapel->id);
                        @endphp
                        <div class="flex items-start gap-2 p-2 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700/50">
                            <input type="checkbox" name="mapel_ids[]" value="{{ $mapel->id }}" id="mapel_{{ $mapel->id }}"
                                {{ in_array($mapel->id, old('mapel_ids', $kelas->mapel->pluck('id')->toArray())) ? 'checked' : '' }}
                                class="mt-0.5 w-4 h-4 text-teal-600 rounded border-gray-300 focus:ring-teal-500">
                            <div class="flex-1">
                                <label for="mapel_{{ $mapel->id }}" class="text-xs font-medium text-gray-900 dark:text-gray-100 cursor-pointer">
                                    {{ $mapel->nama_mapel }} ({{ $mapel->kode_mapel }})
                                </label>
                                <input type="hidden" name="mapel_guru[{{ $mapel->id }}]" value="{{ $guruPengampu?->id ?? '' }}">
                                <p class="text-xs text-gray-500 dark:text-gray-400">Guru: {{ $guruPengampu?->nama ?? '-' }}</p>
                            </div>
                        </div>
                        @empty
                        <p class="text-xs text-gray-500">Belum ada mapel.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <div class="p-4 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                    <div class="flex gap-2">
                        <a href="{{ route('admin.kelas.index') }}" class="flex-1 px-3 py-2 text-center text-xs font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600">Batal</a>
                        <button type="submit" class="flex-1 px-3 py-2 text-center text-xs font-medium text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg">Simpan</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Kolom Kanan: Daftar Siswa (luar form, warna mengikuti mapel: teal) -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-4 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-teal-50 to-cyan-50 dark:from-teal-900/10 dark:to-cyan-900/10">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-teal-500 flex items-center justify-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-5 h-5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Daftar Siswa</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Kelas {{ $kelas->nama_kelas }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-4">
                    @if(count($siswaList ?? []) > 0)
                    <table class="w-full text-sm">
                        <thead class="text-xs text-gray-500 uppercase bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-2 py-2 text-left">No</th>
                                <th class="px-2 py-2 text-left">NIS</th>
                                <th class="px-2 py-2 text-left">Nama Siswa</th>
                                <th class="px-2 py-2 text-center">JK</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($siswaList as $siswa)
                            <tr class="border-t dark:border-gray-700">
                                <td class="px-2 py-2">{{ $loop->iteration }}</td>
                                <td class="px-2 py-2 font-mono text-xs">{{ $siswa['nis'] }}</td>
                                <td class="px-2 py-2">{{ $siswa['nama'] }}</td>
                                <td class="px-2 py-2 text-center">
                                    <span class="px-2 py-0.5 rounded text-xs {{ $siswa['jenis_kelamin'] === 'L' ? 'bg-blue-100 text-blue-700' : 'bg-pink-100 text-pink-700' }}">
                                        {{ $siswa['jenis_kelamin'] }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-8">Belum ada siswa di kelas ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection