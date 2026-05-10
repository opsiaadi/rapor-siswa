@extends('layouts.admin', [
    'title' => 'Tambah Kelas',
    'pageTitle' => 'Tambah Kelas',
    'breadcrumb' => 'Data Kelas › Tambah Kelas',
    'userName' => 'Admin TU'
])

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-sm">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.kelas.index') }}" class="text-gray-400 hover:text-gray-600 ">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h2 class="text-lg font-semibold text-gray-900 ">Tambah Kelas Baru</h2>
                <p class="text-sm text-gray-500  mt-1">Buat kelas dan tentukan mapel + wali kelas</p>
            </div>
        </div>
    </div>
    
    <!-- Form -->
    <form action="{{ route('admin.kelas.store') }}" method="POST">
        @csrf
        <!-- Grid 2 Kolom -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Kiri: Identitas Kelas -->
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100  bg-gradient-to-r from-emerald-50 to-teal-50  ">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-teal-300 flex items-center justify-center text-white">
                            <svg class="w-6 h-6 text-emerald-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M15 4c0-.55228.4477-1 1-1h4c.5523 0 1 .44772 1 1v3c0 .55228-.4477 1-1 1h-4v13H8V7.86853l-1.44532.96352c-.45952.30635-1.08039.18218-1.38675-.27735-.30635-.45953-.18217-1.0804.27735-1.38675l6.00002-4c.3359-.22393.7735-.22393 1.1094 0L15 4.79816V4Zm-5 8c0-.5523.4477-1 1-1h2c.5523 0 1 .4477 1 1s-.4477 1-1 1h-2c-.5523 0-1-.4477-1-1Zm1-4c-.5523 0-1 .44772-1 1s.4477 1 1 1h2c.5523 0 1-.44772 1-1s-.4477-1-1-1h-2Z" clip-rule="evenodd"/>
                                <path d="M18 9.00011 17.9843 9h.0296L18 9.00011ZM6 10.5237l-2.27075.6386C3.29797 11.2836 3 11.677 3 12.125V20c0 .5523.44772 1 1 1h2V10.5237Zm14.2707.6386L18 10.5237V21h2c.5523 0 1-.4477 1-1v-7.875c0-.448-.298-.8414-.7293-.9627Z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-semibold text-gray-900 ">Identitas Kelas</h3>
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
                    
                    <!-- Nama Kelas -->
                    <div>
                        <label for="nama_kelas" class="block text-sm font-medium text-gray-700  mb-1.5">Nama Kelas <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_kelas" id="nama_kelas" value="{{ old('nama_kelas') }}"
                            class="w-full px-3 py-2.5 border border-gray-300  rounded-lg text-gray-900  bg-white  focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm"
                            placeholder="Contoh: X-RPL 1" required>
                    </div>
                    
                    <!-- Tingkat -->
                    <div>
                        <label for="tingkat" class="block text-sm font-medium text-gray-700  mb-1.5">Tingkat <span class="text-red-500">*</span></label>
                        <select name="tingkat" id="tingkat" class="w-full px-3 py-2.5 border border-gray-300  rounded-lg text-gray-900  bg-white  focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm" required>
                            <option value="">-- Pilih Tingkat --</option>
                            @foreach (['VII', 'VIII', 'IX', 'X', 'XI', 'XII'] as $tingkat)
                            <option value="{{ $tingkat }}" {{ old('tingkat') == $tingkat ? 'selected' : '' }}>{{ $tingkat }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Wali Kelas -->
                    <div>
                        <label for="wali_kelas_id" class="block text-sm font-medium text-gray-700  mb-1.5">Wali Kelas <span class="text-red-500">*</span></label>
                        <select name="wali_kelas_id" id="wali_kelas_id" class="w-full px-3 py-2.5 border border-gray-300  rounded-lg text-gray-900  bg-white  focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                            <option value="">-- Pilih Wali Kelas --</option>
                            @forelse ($guruList as $guru)
                            <option value="{{ $guru->id }}" {{ old('wali_kelas_id') == $guru->id ? 'selected' : '' }}>{{ $guru->nama }}</option>
                            @empty
                            <option value="" disabled>Belum ada data guru</option>
                            @endforelse
                        </select>
                    </div>
                </div>

                <!-- Submit Buttons (Inside Identitas Box) -->
                <div class="px-6 py-4 bg-gray-50  border-t border-gray-100  flex items-center gap-3">
                    <a href="{{ route('admin.kelas.index') }}" class="px-4 py-2.5 text-sm font-medium text-gray-700  bg-white  border border-gray-300  rounded-lg hover:bg-gray-50  transition-colors">Batal</a>
                    <button type="submit" class="px-4 py-2.5 text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg focus:ring-4 focus:ring-emerald-300 transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Kelas
                    </button>
                </div>
            </div>
            
            <!-- Kanan: Mata Pelajaran -->
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100  bg-gradient-to-r from-emerald-50 to-teal-50  ">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-lg bg-amber-300 flex items-center justify-center text-white">
                            <svg class="w-6 h-6 text-amber-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 6c0-1.65685 1.3431-3 3-3s3 1.34315 3 3-1.3431 3-3 3-3-1.34315-3-3Zm2 3.62992c-.1263-.04413-.25-.08799-.3721-.13131-1.33928-.47482-2.49256-.88372-4.77995-.8482C4.84875 8.66593 4 9.46413 4 10.5v7.2884c0 1.0878.91948 1.8747 1.92888 1.8616 1.283-.0168 2.04625.1322 2.79671.3587.29285.0883.57733.1863.90372.2987l.00249.0008c.11983.0413.24534.0845.379.1299.2989.1015.6242.2088.9892.3185V9.62992Zm2-.00374V20.7551c.5531-.1678 1.0379-.3374 1.4545-.4832.2956-.1034.5575-.1951.7846-.2653.7257-.2245 1.4655-.3734 2.7479-.3566.5019.0065.9806-.1791 1.3407-.4788.3618-.3011.6723-.781.6723-1.3828V10.5c0-.58114-.2923-1.05022-.6377-1.3503-.3441-.29904-.8047-.49168-1.2944-.49929-2.2667-.0352-3.386.36906-4.6847.83812-.1256.04539-.253.09138-.3832.13765Z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-semibold text-gray-900 ">Mata Pelajaran di Kelas Ini</h3>
                            <p class="text-sm text-gray-500 ">Centang mapel, guru pengampu otomatis terpilih</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="space-y-3">
                        @forelse ($mapelList as $mapel)
                        <div class="p-4 rounded-lg border border-gray-200  bg-white ">
                            <div class="flex items-start gap-3">
                                <input type="checkbox" name="mapel_ids[]" value="{{ $mapel->id }}" id="mapel_{{ $mapel->id }}"
                                    {{ in_array($mapel->id, old('mapel_ids', [])) ? 'checked' : '' }}
                                    class="mt-1 w-4 h-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                                <div class="flex-1">
                                    <label for="mapel_{{ $mapel->id }}" class="text-sm font-medium text-gray-900  cursor-pointer">
                                        {{ $mapel->nama_mapel }} <span class="text-xs text-gray-500 ">({{ $mapel->kode_mapel }})</span>
                                    </label>
                                    <div class="mt-2">
                                        <label for="guru_mapel_{{ $mapel->id }}" class="text-xs text-gray-500 ">Guru Pengampu:</label>
                                        @php
                                            $guruMapel = $guruList->filter(function($g) use ($mapel) {
                                                return $g->mapels->contains('id', $mapel->id);
                                            });
                                            $selectedGuru = old('mapel_guru.'.$mapel->id) ?? ($guruMapel->first()?->id ?? '');
                                        @endphp
                                        <select name="mapel_guru[{{ $mapel->id }}]" id="guru_mapel_{{ $mapel->id }}"
                                            class="mt-1 w-full px-3 py-2 text-sm border border-gray-300  rounded-lg bg-white  text-gray-900  focus:ring-2 focus:ring-emerald-500">
                                            <option value="">-- Pilih Guru --</option>
                                            @foreach ($guruMapel as $guru)
                                            <option value="{{ $guru->id }}" {{ $selectedGuru == $guru->id ? 'selected' : '' }}>
                                                {{ $guru->nama }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p class="text-sm text-gray-500 ">Belum ada data mata pelajaran. <a href="{{ route('admin.mapel.create') }}" class="text-emerald-600 hover:underline">Tambahkan mapel terlebih dahulu</a>.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mapelGuruMap = @json($mapelGuruMap ?? []);
    
    function autoSelectGuru(checkbox) {
        const mapelId = checkbox.value;
        const guruSelect = document.getElementById('guru_mapel_' + mapelId);
        
        if (checkbox.checked) {
            if (mapelGuruMap[mapelId] && mapelGuruMap[mapelId].length > 0) {
                guruSelect.value = mapelGuruMap[mapelId][0];
            }
        } else {
            guruSelect.value = '';
        }
    }
    
    // Auto-select on page load for checked checkboxes
    document.querySelectorAll('input[name="mapel_ids[]"]').forEach(function(checkbox) {
        autoSelectGuru(checkbox);
        checkbox.addEventListener('change', function() {
            autoSelectGuru(this);
        });
    });
});
</script>
@endpush
@endsection

