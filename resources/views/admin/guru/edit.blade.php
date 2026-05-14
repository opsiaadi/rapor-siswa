@extends('layouts.admin', [
    'title' => 'Edit Guru',
    'pageTitle' => 'Edit Guru',
    'breadcrumb' => 'Data Guru › Edit Guru',
    'userName' => session('user.name', 'Admin TU')
])

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-sm">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.guru.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Edit Guru</h2>
                <p class="text-sm text-gray-500 mt-1">Ubah data guru mata pelajaran</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.guru.update', $guru->id) }}" method="POST" class="max-w-2xl">
        @csrf
        @method('PUT')
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-indigo-50 to-purple-50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-purple-200 flex items-center justify-center text-white">
                        <svg class="w-6 h-6 text-purple-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M16 10c0-.55228-.4477-1-1-1h-3v2h3c.5523 0 1-.4477 1-1Z"/>
                            <path d="M13 15v-2h2c1.6569 0 3-1.3431 3-3 0-1.65685-1.3431-3-3-3h-2.256c.1658-.46917.256-.97405.256-1.5 0-.51464-.0864-1.0091-.2454-1.46967C12.8331 4.01052 12.9153 4 13 4h7c.5523 0 1 .44772 1 1v9c0 .5523-.4477 1-1 1h-2.5l1.9231 4.6154c.2124.5098-.0287 1.0953-.5385 1.3077-.5098.2124-1.0953-.0287-1.3077-.5385L15.75 16l-1.827 4.3846c-.1825.438-.6403.6776-1.0889.6018.1075-.3089.1659-.6408.1659-.9864v-2.6002L14 15h-1ZM6 5.5C6 4.11929 7.11929 3 8.5 3S11 4.11929 11 5.5 9.88071 8 8.5 8 6 6.88071 6 5.5Z"/>
                            <path d="M15 11h-4v9c0 .5523-.4477 1-1 1-.55228 0-1-.4477-1-1v-4H8v4c0 .5523-.44772 1-1 1s-1-.4477-1-1v-6.6973l-1.16797 1.752c-.30635.4595-.92722.5837-1.38675.2773-.45952-.3063-.5837-.9272-.27735-1.3867l2.99228-4.48843c.09402-.14507.2246-.26423.37869-.34445.11427-.05949.24148-.09755.3763-.10887.03364-.00289.06747-.00408.10134-.00355H15c.5523 0 1 .44772 1 1 0 .5523-.4477 1-1 1Z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-gray-900">Identitas Guru</h3>
                        <p class="text-sm text-gray-500">Field bertanda <span class="text-red-500">*</span> wajib diisi</p>
                    </div>
                </div>
            </div>

            <div class="p-6 space-y-5">
                @if ($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <h4 class="text-sm font-medium text-red-800">Terdapat kesalahan:</h4>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
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
                    <label for="nik" class="block mb-2.5 text-sm font-medium text-gray-700">
                        NIK <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nik" id="nik" value="{{ old('nik', $guru->nik ?? '') }}"
                        class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-gray-900 bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                        placeholder="Contoh: 198501012010011001" required>
                </div>

                <!-- Nama -->
                <div>
                    <label for="nama" class="block mb-2.5 text-sm font-medium text-gray-700">
                        Nama Guru <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $guru->nama ?? '') }}"
                        class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-gray-900 bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                        placeholder="Masukkan nama lengkap" required>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block mb-2.5 text-sm font-medium text-gray-700">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email', $guru->email ?? '') }}"
                        class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-gray-900 bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                        placeholder="guru@sekolah.sch.id" required>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block mb-2.5 text-sm font-medium text-gray-700">
                        Password <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="password" id="password"
                        class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-gray-900 bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                        placeholder="Minimal 8 karakter">
                    <p class="mt-1.5 text-xs text-gray-500">Kosongkan jika tidak ingin mengubah</p>
                </div>
            </div>

            <!-- Mata Pelajaran -->
            <div class="p-6 border-t border-gray-100 bg-gradient-to-r from-indigo-50 to-purple-50">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-amber-300 flex items-center justify-center text-white">
                        <svg class="w-6 h-6 text-amber-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 6c0-1.65685 1.3431-3 3-3s3 1.34315 3 3-1.3431 3-3 3-3-1.34315-3-3Zm2 3.62992c-.1263-.04413-.25-.08799-.3721-.13131-1.33928-.47482-2.49256-.88372-4.77995-.8482C4.84875 8.66593 4 9.46413 4 10.5v7.2884c0 1.0878.91948 1.8747 1.92888 1.8616 1.283-.0168 2.04625.1322 2.79671.3587.29285.0883.57733.1863.90372.2987l.00249.0008c.11983.0413.24534.0845.379.1299.2989.1015.6242.2088.9892.3185V9.62992Zm2-.00374V20.7551c.5531-.1678 1.0379-.3374 1.4545-.4832.2956-.1034.5575-.1951.7846-.2653.7257-.2245 1.4655-.3734 2.7479-.3566.5019.0065.9806-.1791 1.3407-.4788.3618-.3011.6723-.781.6723-1.3828V10.5c0-.58114-.2923-1.05022-.6377-1.3503-.3441-.29904-.8047-.49168-1.2944-.49929-2.2667-.0352-3.386.36906-4.6847.83812-.1256.04539-.253.09138-.3832.13765Z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-gray-900">Mata Pelajaran yang Diampu</h3>
                        <p class="text-sm text-gray-500">Pilih satu atau lebih mapel</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @forelse ($mapelList as $mapel)
                    <label class="flex items-center gap-3 p-3 rounded-lg border border-gray-200 hover:bg-gray-50 cursor-pointer transition-colors">
                        @php
                            $selectedMapels = old('mapel_ids', $guru->mapels->pluck('id')->toArray());
                        @endphp
                        <input type="checkbox" name="mapel_ids[]" value="{{ $mapel->id }}" 
                        {{ in_array($mapel->id, $selectedMapels) ? 'checked' : '' }}
                        class="w-4 h-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                        <div>
                            <span class="text-sm font-medium text-gray-900">{{ $mapel->nama_mapel ?? '-' }}</span>
                            <span class="text-xs text-gray-500 block">{{ $mapel->kode_mapel ?? '-' }}</span>
                        </div>
                    </label>
                    @empty
                    <p class="text-sm text-gray-500 col-span-2">Belum ada data mata pelajaran. <a href="{{ route('admin.mapel.create') }}" class="text-indigo-600 hover:underline">Tambahkan mapel terlebih dahulu</a>.</p>
                    @endforelse
                </div>
                @error('mapel_ids')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.guru.index') }}" class="px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-all duration-200 hover:scale-105 active:scale-95">Batal</a>
                <button type="submit" class="px-4 py-2.5 text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 rounded-lg focus:ring-4 focus:ring-purple-300 transition-all duration-200 hover:scale-105 active:scale-95 flex items-center gap-2">
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
