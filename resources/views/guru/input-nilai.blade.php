@extends('layouts.guru', [
    'title' => 'Input Nilai Siswa',
    'pageTitle' => 'Input Nilai Siswa',
    'breadcrumb' => 'Input nilai harian, UTS, UAS',
    'id' => $id ?? 1,
    'namaGuru' => $namaGuru ?? 'Guru Mapel',
])

@section('content')
@php
    $mengajarId = $filter['mengajarId'] ?? null;
    $kelasId    = $filter['kelasId'] ?? null;
    $semester   = $filter['semester'] ?? 1;
    $mapelId    = $filter['mapelId'] ?? null;

    $mapelNama  = optional($guruMengajar?->firstWhere('mapel_id', $mapelId))->mapel_nama;
    $kelasNama  = optional($kelasList?->firstWhere('id', $kelasId))->nama_kelas;
    $adaFilter  = filled($mapelId);
@endphp

<div class="bg-gray-50 p-4 rounded-xl mb-6">
    <form action="{{ route('guru.nilai') }}" method="GET" class="flex flex-wrap justify-center gap-4 items-end">
        <div class="w-full sm:w-auto">
            <label class="text-xs font-semibold text-gray-500 uppercase">Mengajar</label>
            <select name="mengajar" class="block w-full bg-white border border-gray-200 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Pilih Mengajar --</option>
                @forelse($guruMengajar as $mengajar)
                    <option value="{{ $mengajar->id }}" {{ $mengajarId == $mengajar->id ? 'selected' : '' }}>
                        {{ $mengajar->mapel_nama }} - Kelas {{ $mengajar->kelas_nama }} (Semester {{ $mengajar->semester }})
                    </option>
                @empty
                    <option value="">(Tidak ada data mengajar)</option>
                @endforelse
            </select>
        </div>

        <div class="w-full sm:w-auto">
            <label class="text-xs font-semibold text-gray-500 uppercase">Kelas</label>
            <select name="kelas" class="block w-full bg-white border border-gray-200 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Pilih Kelas --</option>
                @foreach($kelasList as $kelas)
                    <option value="{{ $kelas->id }}" {{ $kelasId == $kelas->id ? 'selected' : '' }}>
                        {{ $kelas->nama_kelas }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="w-full sm:w-auto">
            <label class="text-xs font-semibold text-gray-500 uppercase">Semester</label>
            <select name="semester" class="block w-full bg-white border border-gray-200 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="1" {{ (int)$semester === 1 ? 'selected' : '' }}>Semester 1</option>
                <option value="2" {{ (int)$semester === 2 ? 'selected' : '' }}>Semester 2</option>
            </select>
        </div>

        <div class="w-full sm:w-auto">
            <button type="submit" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-all duration-200 hover:scale-105 active:scale-95 shadow-lg shadow-blue-500/30">
                Tampilkan
            </button>
        </div>
    </form>
</div>

@if($adaFilter)
<div class="bg-gray-50 p-4 rounded-xl overflow-hidden">
    <h3 class="text-sm font-semibold text-gray-700 mb-4">
        Daftar Siswa - {{ $mapelNama ?? '' }} (Kelas {{ $kelasNama ?? '' }})
    </h3>

    <form id="nilaiForm" action="{{ route('guru.nilai') }}" method="POST">
        @csrf
        <input type="hidden" name="action" value="kirim">
        <input type="hidden" name="mengajar" value="{{ $mengajarId }}">
        <input type="hidden" name="kelas" value="{{ $kelasId }}">
        <input type="hidden" name="semester" value="{{ $semester }}">
        <input type="hidden" name="mapel" value="{{ $mapelId }}">

        <div class="overflow-x-auto hidden md:block">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-gray-600 border-b border-gray-200">
                        <th class="py-3 px-2 text-left w-12">No.</th>
                        <th class="py-3 px-2 text-left">Nama Siswa</th>
                        <th class="py-3 px-2 text-center">Harian (40%)</th>
                        <th class="py-3 px-2 text-center">UTS (30%)</th>
                        <th class="py-3 px-2 text-center">UAS (30%)</th>
                        <th class="py-3 px-2 text-center">Nilai Akhir</th>
                        <th class="py-3 px-2 text-center">Status KKM</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse($siswaList ?? [] as $i => $siswa)
                        @php
                            $na = $siswa->nilai_akhir;
                            $naText = isset($na) ? number_format((float)$na, 1) : '-';
                            $kkm = $siswa->status_kkm;
                            $badgeClass = $kkm === 'lulus' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700';
                        @endphp
                        <tr class="border-b border-gray-100 hover:bg-gray-100 transition-colors">
                            <td class="py-3 px-2 text-left text-gray-600">{{ $i + 1 }}</td>
                            <td class="py-3 px-2 text-left font-medium text-gray-800">{{ $siswa->nama }}</td>
                            <td class="py-3 px-2">
                                <input type="number" name="nilai[harian][{{ $siswa->id }}]" value="{{ old('nilai.harian.' . $siswa->id, $siswa->harian) }}" min="0" max="100" step="0.1" class="nilai-input w-20 text-center bg-white border border-gray-200 rounded-lg py-1.5 font-medium focus:ring-2 focus:ring-blue-400" readonly>
                            </td>
                            <td class="py-3 px-2">
                                <input type="number" name="nilai[uts][{{ $siswa->id }}]" value="{{ old('nilai.uts.' . $siswa->id, $siswa->uts) }}" min="0" max="100" step="0.1" class="nilai-input w-20 text-center bg-white border border-gray-200 rounded-lg py-1.5 font-medium focus:ring-2 focus:ring-blue-400" readonly>
                            </td>
                            <td class="py-3 px-2">
                                <input type="number" name="nilai[uas][{{ $siswa->id }}]" value="{{ old('nilai.uas.' . $siswa->id, $siswa->uas) }}" min="0" max="100" step="0.1" class="nilai-input w-20 text-center bg-white border border-gray-200 rounded-lg py-1.5 font-medium focus:ring-2 focus:ring-blue-400" readonly>
                            </td>
                            <td class="py-3 px-2 font-bold text-blue-600">{{ $naText }}</td>
                            <td class="py-3 px-2">
                                @if($kkm)
                                    <span class="px-2 py-1 {{ $badgeClass }} rounded-full text-xs font-semibold">{{ ucfirst($kkm) }}</span>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-4 text-center text-gray-500">Pilih data mengajar terlebih dahulu untuk menampilkan siswa.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="block md:hidden space-y-3">
            @forelse($siswaList ?? [] as $i => $siswa)
                @php
                    $na = $siswa->nilai_akhir;
                    $naText = isset($na) ? number_format((float)$na, 1) : '-';
                    $kkm = $siswa->status_kkm;
                    $badgeClass = $kkm === 'lulus' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700';
                @endphp
                <div class="bg-white rounded-xl border border-gray-200 p-4">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-2 min-w-0">
                            <span class="text-xs text-gray-400 shrink-0">#{{ $i + 1 }}</span>
                            <span class="font-medium text-gray-900 truncate">{{ $siswa->nama }}</span>
                        </div>
                        <div class="text-right shrink-0 ml-2">
                            <span class="text-xs font-bold {{ $kkm === 'lulus' ? 'text-green-600' : 'text-gray-400' }}">{{ $naText }}</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-2">
                        <div>
                            <label class="text-[11px] text-gray-500 font-medium">Harian</label>
                            <input type="number" name="nilai[harian][{{ $siswa->id }}]" value="{{ old('nilai.harian.' . $siswa->id, $siswa->harian) }}" min="0" max="100" step="0.1" class="nilai-input w-full text-center bg-white border border-gray-200 rounded-lg py-1.5 text-sm font-medium focus:ring-2 focus:ring-blue-400" readonly>
                        </div>
                        <div>
                            <label class="text-[11px] text-gray-500 font-medium">UTS</label>
                            <input type="number" name="nilai[uts][{{ $siswa->id }}]" value="{{ old('nilai.uts.' . $siswa->id, $siswa->uts) }}" min="0" max="100" step="0.1" class="nilai-input w-full text-center bg-white border border-gray-200 rounded-lg py-1.5 text-sm font-medium focus:ring-2 focus:ring-blue-400" readonly>
                        </div>
                        <div>
                            <label class="text-[11px] text-gray-500 font-medium">UAS</label>
                            <input type="number" name="nilai[uas][{{ $siswa->id }}]" value="{{ old('nilai.uas.' . $siswa->id, $siswa->uas) }}" min="0" max="100" step="0.1" class="nilai-input w-full text-center bg-white border border-gray-200 rounded-lg py-1.5 text-sm font-medium focus:ring-2 focus:ring-blue-400" readonly>
                        </div>
                    </div>
                    @if($kkm)
                        <div class="mt-2 flex justify-end">
                            <span class="px-2 py-0.5 {{ $badgeClass }} rounded-full text-xs font-semibold">{{ ucfirst($kkm) }}</span>
                        </div>
                    @endif
                </div>
            @empty
                <div class="text-center py-8 text-gray-500">Pilih data mengajar terlebih dahulu untuk menampilkan siswa.</div>
            @endforelse
        </div>

        @if(!empty($siswaList) && $siswaList->isNotEmpty())
    <div class="flex justify-between mt-6 pt-4 border-t border-gray-200">
        <div class="flex gap-3">

            @if(!$isLocked)

                <a href="{{ route('guru.nilai.edit', [
                    'kelasId' => $kelasId,
                    'mapelId' => $mapelId,
                    'semester' => $semester
                ]) }}"
                class="inline-flex items-center bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg font-medium transition-all duration-200 hover:scale-105 active:scale-95 shadow-lg shadow-purple-500/30">
                    Edit
                </a>

                <button type="submit"
                    class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-lg font-medium transition-all duration-200 hover:scale-105 active:scale-95 shadow-lg shadow-emerald-500/30">
                    Kirim
                </button>

            @else

                <span class="bg-red-100 text-red-700 px-6 py-2 rounded-lg font-medium">
                    Nilai Sudah Dikirim
                </span>

            @endif

        </div>
    </div>
@endif
    </form>
</div>
@else
    <div class="bg-gray-50 p-4 rounded-xl text-center text-gray-500">
        Silakan pilih data mengajar untuk mulai input nilai.
    </div>
@endif

<script>
(function() {
  var form = document.getElementById('nilaiForm');
  if (!form) return;
  form.addEventListener('submit', function() {
    var inputs = this.querySelectorAll('input[type="number"]');
    inputs.forEach(function(input) {
      if (!input.offsetParent) input.disabled = true; // disable input yang tidak terlihat (mis. karena responsive)
    });
  });
})();
</script>
@endsection
