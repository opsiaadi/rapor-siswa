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
            <a href="{{ route('admin.kelas.index') }}" class="text-gray-400 hover:text-gray-600 ">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h2 class="text-lg font-semibold text-gray-900 ">Edit Kelas</h2>
                <p class="text-sm text-gray-500  mt-1">Ubah data kelas dan pengaturan mapel</p>
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
                <div class="p-4 border-b border-gray-100  bg-gradient-to-r from-teal-50 to-cyan-50  ">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-teal-300 flex items-center justify-center text-white">
                            <svg class="w-6 h-6 text-emerald-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M15 4c0-.55228.4477-1 1-1h4c.5523 0 1 .44772 1 1v3c0 .55228-.4477 1-1 1h-4v13H8V7.86853l-1.44532.96352c-.45952.30635-1.08039.18218-1.38675-.27735-.30635-.45953-.18217-1.0804.27735-1.38675l6.00002-4c.3359-.22393.7735-.22393 1.1094 0L15 4.79816V4Zm-5 8c0-.5523.4477-1 1-1h2c.5523 0 1 .4477 1 1s-.4477 1-1 1h-2c-.5523 0-1-.4477-1-1Zm1-4c-.5523 0-1 .44772-1 1s.4477 1 1 1h2c.5523 0 1-.44772 1-1s-.4477-1-1-1h-2Z" clip-rule="evenodd"/>
                                <path d="M18 9.00011 17.9843 9h.0296L18 9.00011ZM6 10.5237l-2.27075.6386C3.29797 11.2836 3 11.677 3 12.125V20c0 .5523.44772 1 1 1h2V10.5237Zm14.2707.6386L18 10.5237V21h2c.5523 0 1-.4477 1-1v-7.875c0-.448-.298-.8414-.7293-.9627Z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900 ">Identitas Kelas</h3>
                            <p class="text-xs text-gray-500 ">Field <span class="text-red-500">*</span> wajib</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 space-y-4">
                    <div>
                        <label for="nama_kelas" class="block text-xs font-medium text-gray-700  mb-1">Nama Kelas <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_kelas" id="nama_kelas" value="{{ old('nama_kelas', $kelas->nama_kelas) }}"
                            class="w-full px-3 py-2 border border-gray-300  rounded-lg text-sm bg-white  focus:ring-emerald-500 focus:border-emerald-500" required>
                    </div>

                    <div>
                        <label for="tingkat" class="block text-xs font-medium text-gray-700  mb-1">Tingkat <span class="text-red-500">*</span></label>
                        <select name="tingkat" id="tingkat" class="w-full px-3 py-2 border border-gray-300  rounded-lg text-sm bg-white " required>
                            @foreach (['VII', 'VIII', 'IX', 'X', 'XI', 'XII'] as $tingkat)
                            <option value="{{ $tingkat }}" {{ old('tingkat', $kelas->tingkat) == $tingkat ? 'selected' : '' }}>{{ $tingkat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="wali_kelas_id" class="block text-xs font-medium text-gray-700  mb-1">Wali Kelas</label>
                        <select name="wali_kelas_id" id="wali_kelas_id" class="w-full px-3 py-2 border border-gray-300  rounded-lg text-sm bg-white ">
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
                <div class="p-4 border-t border-gray-100  bg-gradient-to-r from-teal-50 to-cyan-50  ">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-lg bg-amber-300 flex items-center justify-center text-white">
                            <svg class="w-6 h-6 text-amber-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 6c0-1.65685 1.3431-3 3-3s3 1.34315 3 3-1.3431 3-3 3-3-1.34315-3-3Zm2 3.62992c-.1263-.04413-.25-.08799-.3721-.13131-1.33928-.47482-2.49256-.88372-4.77995-.8482C4.84875 8.66593 4 9.46413 4 10.5v7.2884c0 1.0878.91948 1.8747 1.92888 1.8616 1.283-.0168 2.04625.1322 2.79671.3587.29285.0883.57733.1863.90372.2987l.00249.0008c.11983.0413.24534.0845.379.1299.2989.1015.6242.2088.9892.3185V9.62992Zm2-.00374V20.7551c.5531-.1678 1.0379-.3374 1.4545-.4832.2956-.1034.5575-.1951.7846-.2653.7257-.2245 1.4655-.3734 2.7479-.3566.5019.0065.9806-.1791 1.3407-.4788.3618-.3011.6723-.781.6723-1.3828V10.5c0-.58114-.2923-1.05022-.6377-1.3503-.3441-.29904-.8047-.49168-1.2944-.49929-2.2667-.0352-3.386.36906-4.6847.83812-.1256.04539-.253.09138-.3832.13765Z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900 ">Mata Pelajaran</h3>
                            <p class="text-xs text-gray-500 ">Centang mapel, guru auto</p>
                        </div>
                    </div>

                    <div class="space-y-2">
                        @forelse ($mapelList as $mapel)
                        @php
                            $guruId = $currentMapelGuru[$mapel->id] ?? null;
                            $guruPengampu = $guruId ? $guruList->firstWhere('id', $guruId) : null;
                        @endphp
                        <div class="flex items-start gap-2 p-2 rounded-lg border border-gray-200  bg-white ">
                            <input type="checkbox" name="mapel_ids[]" value="{{ $mapel->id }}" id="mapel_{{ $mapel->id }}"
                                {{ $kelas->kelasMapels->pluck('mapel_id')->contains($mapel->id) ? 'checked' : '' }}
                                class="mt-0.5 w-4 h-4 text-teal-600 rounded border-gray-300 focus:ring-teal-500">
                            <div class="flex-1">
                                <label for="mapel_{{ $mapel->id }}" class="text-xs font-medium text-gray-900  cursor-pointer">
                                    {{ $mapel->nama_mapel }} ({{ $mapel->kode_mapel }})
                                </label>
                                <div class="mt-1">
                                    @php
                                        $guruMapel = $guruList->filter(function($g) use ($mapel) {
                                            return $g->mapels->contains('id', $mapel->id);
                                        });
                                        $selectedGuru = old('mapel_guru.'.$mapel->id, $guruId);
                                    @endphp
                                    <select name="mapel_guru[{{ $mapel->id }}]" id="guru_mapel_{{ $mapel->id }}" class="w-full px-2 py-1 text-xs border border-gray-300  rounded-lg bg-white  text-gray-900  focus:ring-1 focus:ring-teal-500">
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
                        @empty
                        <p class="text-xs text-gray-500">Belum ada mapel.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <div class="p-4 border-t border-gray-100  bg-gray-50 ">
                    <div class="flex gap-2">
                        <a href="{{ route('admin.kelas.index') }}" class="flex-1 px-3 py-2 text-center text-xs font-medium text-gray-700  bg-white  border border-gray-300  rounded-lg hover:bg-gray-100 transition-all duration-200 hover:scale-105 active:scale-95">Batal</a>
                        <button type="submit" class="flex-1 px-3 py-2 text-center text-xs font-medium text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg transition-all duration-200 hover:scale-105 active:scale-95">Simpan</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Daftar Siswa -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-4 border-b border-gray-100  bg-gradient-to-r from-teal-50 to-cyan-50  ">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-blue-300 flex items-center justify-center text-white">
                            <svg class="w-6 h-6 text-blue-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900 ">Daftar Siswa</h3>
                            <p class="text-xs text-gray-500 ">Kelas {{ $kelas->nama_kelas }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-4">
                    @if(count($siswaList ?? []) > 0)
                    <table class="w-full text-sm">
                        <thead class="text-xs text-gray-500 uppercase bg-gray-50 ">
                            <tr>
                                <th class="px-2 py-2 text-left">No</th>
                                <th class="px-2 py-2 text-left">NIS</th>
                                <th class="px-2 py-2 text-left">Nama Siswa</th>
                                <th class="px-2 py-2 text-center">JK</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($siswaList as $siswa)
                            <tr class="border-t ">
                                <td class="px-2 py-2">{{ $loop->iteration }}</td>
                                <td class="px-2 py-2 font-mono text-xs">{{ $siswa->nis }}</td>
                                <td class="px-2 py-2">{{ $siswa->nama }}</td>
                                <td class="px-2 py-2 text-center">
                                    <span class="px-2 py-0.5 rounded text-xs {{ $siswa->jenis_kelamin === 'L' ? 'bg-blue-100 text-blue-700' : 'bg-pink-100 text-pink-700' }}">
                                        {{ $siswa->jenis_kelamin }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="text-sm text-gray-500  text-center py-8">Belum ada siswa di kelas ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>window.mapelGuruMap = @json($mapelGuruMap ?? []);</script>
@endpush

