@extends('layouts.admin', [
    'title' => 'Profil Saya',
    'pageTitle' => 'Profil Saya',
    'breadcrumb' => 'Pengaturan › Profil',
    'userName' => $user->nama
])

@section('content')
<form id="remove-foto-form" action="{{ route('admin.profile.remove-foto') }}" method="POST" class="hidden">@csrf @method('DELETE')</form>

<div class="space-y-6">
    <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-sm">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.dashboard', ['id' => $user->id, 'nama' => $user->nama]) }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Profil Saya</h2>
                <p class="text-sm text-gray-500 mt-1">Kelola informasi akun admin Anda</p>
            </div>
        </div>
    </div>

    @if (session('success'))
    <div class="bg-emerald-50 border border-emerald-200 rounded-lg p-4">
        <div class="flex items-center gap-3">
            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-emerald-50 to-green-50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-emerald-500 flex items-center justify-center text-white">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-gray-900">Informasi Akun</h3>
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

                <div class="flex items-center gap-6 pb-5 border-b border-gray-100">
                    <div class="relative">
                        <div class="w-24 h-24 rounded-full overflow-hidden border-2 border-emerald-200">
                            <img src="{{ $user->foto ? Storage::disk('public')->url($user->foto) : asset('images/users-avatar-svgrepo-com.svg') }}"
                                class="w-full h-full object-cover" id="preview-foto">
                        </div>
                        <label for="foto"
                            class="absolute bottom-0 right-0 w-8 h-8 bg-emerald-600 text-white rounded-full flex items-center justify-center cursor-pointer hover:bg-emerald-700 transition-colors shadow-md">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </label>
                        <input type="file" name="foto" id="foto" accept="image/jpeg,image/png" class="hidden">
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900">{{ $user->nama }}</h4>
                        <p class="text-xs text-gray-500">JPEG/PNG, maks 2MB</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama', $user->nama) }}"
                            class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-gray-900 bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm"
                            required>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                            class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-gray-900 bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm"
                            required>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-5">
                    <h4 class="text-sm font-semibold text-gray-900 mb-4">Ganti Password</h4>
                    <p class="text-xs text-gray-500 mb-4">Kosongkan jika tidak ingin mengganti password.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Password Baru
                            </label>
                            <div class="relative">
                                <input type="password" name="password" id="password"
                                    class="w-full px-3 py-2.5 pr-10 border border-gray-300 rounded-lg text-gray-900 bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm"
                                    placeholder="Minimal 6 karakter">
                                <button type="button" onclick="togglePassword('password', this)"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Konfirmasi Password Baru
                            </label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="w-full px-3 py-2.5 pr-10 border border-gray-300 rounded-lg text-gray-900 bg-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm"
                                    placeholder="Ulangi password baru">
                                <button type="button" onclick="togglePassword('password_confirmation', this)"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($user->foto)
            <div class="px-6 py-3 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                <div class="text-xs text-gray-500">
                    <a href="{{ route('admin.profile.remove-foto') }}"
                       onclick="event.preventDefault(); if(confirm('Hapus foto profil?')) document.getElementById('remove-foto-form').submit();"
                       class="text-red-600 hover:underline">Hapus foto</a>
                </div>
            </div>
            @endif
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.dashboard', ['id' => $user->id, 'nama' => $user->nama]) }}"
                    class="px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-all duration-200 hover:scale-105 active:scale-95">
                    Kembali
                </a>
                <button type="submit"
                    class="px-4 py-2.5 text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg focus:ring-4 focus:ring-emerald-300 transition-all duration-200 hover:scale-105 active:scale-95 flex items-center gap-2">
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
