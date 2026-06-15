@extends('layouts.admin', [
    'title' => 'Tambah Eskul',
    'pageTitle' => 'Tambah Eskul',
    'breadcrumb' => 'Ekstrakurikuler › Tambah Eskul',
    'userName' => 'Admin TU'
])

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-sm">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.eskul.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Tambah Eskul Baru</h2>
                <p class="text-sm text-gray-500 mt-1">Lengkapi data ekstrakurikuler baru</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.eskul.store') }}" method="POST">
        @csrf
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
            <!-- Section Header -->
            <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-orange-50 to-amber-50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-orange-200 flex items-center justify-center text-orange-300">
                        <svg class="w-6 h-6 text-orange-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-gray-900">Data Ekstrakurikuler</h3>
                        <p class="text-sm text-gray-500">Field bertanda <span class="text-red-500">*</span> wajib diisi</p>
                    </div>
                </div>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">
                @if ($errors->any())
                <div class="md:col-span-full bg-red-50 border border-red-200 rounded-lg p-4">
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

                <!-- Nama Eskul -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1.5">Nama Eskul <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                        class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-gray-900 bg-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-sm"
                        placeholder="Contoh: Pramuka" required>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <div class="flex gap-6">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="is_aktif" value="1" {{ old('is_aktif', '1') == '1' ? 'checked' : '' }}
                                class="w-4 h-4 text-orange-600 border-gray-300 focus:ring-orange-500">
                            <span class="text-sm text-gray-700">Aktif</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="is_aktif" value="0" {{ old('is_aktif') == '0' ? 'checked' : '' }}
                                class="w-4 h-4 text-orange-600 border-gray-300 focus:ring-orange-500">
                            <span class="text-sm text-gray-700">Nonaktif</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.eskul.index') }}" class="px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-all duration-200 hover:scale-105 active:scale-95">Batal</a>
                <button type="submit" class="px-4 py-2.5 text-sm font-medium text-white bg-orange-500 hover:bg-orange-600 rounded-lg focus:ring-4 focus:ring-orange-300 transition-all duration-200 hover:scale-105 active:scale-95 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Eskul
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
