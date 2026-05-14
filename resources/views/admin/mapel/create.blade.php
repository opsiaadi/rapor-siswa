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
            <a href="{{ route('admin.mapel.index') }}" class="text-gray-400 hover:text-gray-600 ">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h2 class="text-lg font-semibold text-gray-900 ">Tambah Mata Pelajaran Baru</h2>
                <p class="text-sm text-gray-500  mt-1">Lengkapi data mata pelajaran yang akan diajarkan</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.mapel.store') }}" method="POST" class="max-w-2xl">
        @csrf
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100  bg-gradient-to-r from-amber-50 to-orange-50  ">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-amber-300 flex items-center justify-center text-white">
                        <svg class="w-6 h-6 text-amber-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 6c0-1.65685 1.3431-3 3-3s3 1.34315 3 3-1.3431 3-3 3-3-1.34315-3-3Zm2 3.62992c-.1263-.04413-.25-.08799-.3721-.13131-1.33928-.47482-2.49256-.88372-4.77995-.8482C4.84875 8.66593 4 9.46413 4 10.5v7.2884c0 1.0878.91948 1.8747 1.92888 1.8616 1.283-.0168 2.04625.1322 2.79671.3587.29285.0883.57733.1863.90372.2987l.00249.0008c.11983.0413.24534.0845.379.1299.2989.1015.6242.2088.9892.3185V9.62992Zm2-.00374V20.7551c.5531-.1678 1.0379-.3374 1.4545-.4832.2956-.1034.5575-.1951.7846-.2653.7257-.2245 1.4655-.3734 2.7479-.3566.5019.0065.9806-.1791 1.3407-.4788.3618-.3011.6723-.781.6723-1.3828V10.5c0-.58114-.2923-1.05022-.6377-1.3503-.3441-.29904-.8047-.49168-1.2944-.49929-2.2667-.0352-3.386.36906-4.6847.83812-.1256.04539-.253.09138-.3832.13765Z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-gray-900 ">Identitas Mata Pelajaran</h3>
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

                <!-- Kode Mapel -->
                <div>
                    <label for="kode_mapel" class="block text-sm font-medium text-gray-700  mb-1.5">
                        Kode Mapel <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="kode_mapel" id="kode_mapel" value="{{ old('kode_mapel') }}"
                        class="w-full px-3 py-2.5 border border-gray-300  rounded-lg text-gray-900  bg-white  focus:ring-2 focus:ring-amber-500 focus:border-amber-500 text-sm"
                        placeholder="Contoh: MTK, BIN, IPA" required>
                    <p class="mt-1.5 text-xs text-gray-500 ">Harus unik (misal: MTK untuk Matematika)</p>
                </div>

                <!-- Nama Mapel -->
                <div>
                    <label for="nama_mapel" class="block text-sm font-medium text-gray-700  mb-1.5">
                        Nama Mata Pelajaran <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_mapel" id="nama_mapel" value="{{ old('nama_mapel') }}"
                        class="w-full px-3 py-2.5 border border-gray-300  rounded-lg text-gray-900  bg-white  focus:ring-2 focus:ring-amber-500 focus:border-amber-500 text-sm"
                        placeholder="Contoh: Matematika" required>
                </div>

                <!-- KKM -->
                <div>
                    <label for="kkm" class="block text-sm font-medium text-gray-700  mb-1.5">
                        KKM (Kriteria Ketuntasan Minimal) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="kkm" id="kkm" value="{{ old('kkm', 75) }}" min="0" max="100"
                        class="w-full sm:w-32 px-3 py-2.5 border border-gray-300  rounded-lg text-gray-900  bg-white  focus:ring-2 focus:ring-amber-500 focus:border-amber-500 text-sm"
                        required>
                    <p class="mt-1.5 text-xs text-gray-500 ">Nilai minimal ketuntasan (0-100)</p>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50  border-t border-gray-100  flex items-center justify-end gap-3">
                <a href="{{ route('admin.mapel.index') }}" class="px-4 py-2.5 text-sm font-medium text-gray-700  bg-white  border border-gray-300  rounded-lg hover:bg-gray-50  transition-all duration-200 hover:scale-105 active:scale-95">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2.5 text-sm font-medium text-white bg-amber-600 hover:bg-amber-700 rounded-lg focus:ring-4 focus:ring-amber-300 transition-all duration-200 hover:scale-105 active:scale-95 flex items-center gap-2">
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

