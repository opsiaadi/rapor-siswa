@extends('layouts.guru', [
    'title' => 'Edit Nilai Siswa',
    'pageTitle' => 'Edit Nilai Siswa',
    'breadcrumb' => 'Edit nilai harian, UTS, UAS',
    'id' => $id ?? 1,
    'namaGuru' => $namaGuru ?? 'Guru Mapel',
])

@section('content')
<div class="bg-gray-50 p-4 rounded-xl overflow-hidden">
    <h3 class="text-sm font-semibold text-gray-700 mb-4">Edit Nilai - Kelas {{ $kelasId ?? '' }} (Semester {{ $semester ?? '1' }})</h3>

    <form id="editNilaiForm" action="{{ route('guru.nilai.post') }}" method="POST">
        @csrf
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="mapel_id" value="{{ $mapelId }}">
        <input type="hidden" name="semester" value="{{ $semester }}">
        <input type="hidden" name="kelas_id" value="{{ $kelasId }}">
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
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse($siswaList ?? [] as $i => $siswa)
                    <tr class="border-b border-gray-100 hover:bg-gray-100 transition-colors">
                        <td class="py-3 px-2 text-left text-gray-600">{{ $i + 1 }}</td>
                        <td class="py-3 px-2 text-left font-medium text-gray-800">{{ $siswa->nama }}</td>
                        <td class="py-3 px-2">
                            <input type="number" name="nilai[harian][{{ $siswa->id }}]" value="{{ old('nilai.harian.' . $siswa->id, $siswa->harian ?? '') }}" min="0" max="100" step="0.1" class="nilai-input w-20 text-center bg-white border border-gray-200 rounded-lg py-1.5 font-medium focus:ring-2 focus:ring-emerald-400">
                        </td>
                        <td class="py-3 px-2">
                            <input type="number" name="nilai[uts][{{ $siswa->id }}]" value="{{ old('nilai.uts.' . $siswa->id, $siswa->uts ?? '') }}" min="0" max="100" step="0.1" class="nilai-input w-20 text-center bg-white border border-gray-200 rounded-lg py-1.5 font-medium focus:ring-2 focus:ring-emerald-400">
                        </td>
                        <td class="py-3 px-2">
                            <input type="number" name="nilai[uas][{{ $siswa->id }}]" value="{{ old('nilai.uas.' . $siswa->id, $siswa->uas ?? '') }}" min="0" max="100" step="0.1" class="nilai-input w-20 text-center bg-white border border-gray-200 rounded-lg py-1.5 font-medium focus:ring-2 focus:ring-emerald-400">
                        </td>
                        <td class="py-3 px-2 font-bold text-blue-600">
                            {{ $siswa->nilai_akhir ? number_format($siswa->nilai_akhir, 1) : '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-4 text-center text-gray-500">Tidak ada data siswa.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="block md:hidden space-y-3">
            @forelse($siswaList ?? [] as $i => $siswa)
            <div class="bg-white rounded-xl border border-gray-200 p-4">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2 min-w-0">
                        <span class="text-xs text-gray-400 shrink-0">#{{ $i + 1 }}</span>
                        <span class="font-medium text-gray-900 truncate">{{ $siswa->nama }}</span>
                    </div>
                    <div class="text-right shrink-0 ml-2">
                        <span class="text-xs font-bold text-blue-600">
                            {{ $siswa->nilai_akhir ? number_format($siswa->nilai_akhir, 1) : '-' }}
                        </span>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-2">
                    <div>
                        <label class="text-[11px] text-gray-500 font-medium">Harian</label>
                        <input type="number" name="nilai[harian][{{ $siswa->id }}]" value="{{ old('nilai.harian.' . $siswa->id, $siswa->harian ?? '') }}" min="0" max="100" step="0.1" class="nilai-input w-full text-center bg-white border border-gray-200 rounded-lg py-1.5 text-sm font-medium focus:ring-2 focus:ring-emerald-400">
                    </div>
                    <div>
                        <label class="text-[11px] text-gray-500 font-medium">UTS</label>
                        <input type="number" name="nilai[uts][{{ $siswa->id }}]" value="{{ old('nilai.uts.' . $siswa->id, $siswa->uts ?? '') }}" min="0" max="100" step="0.1" class="nilai-input w-full text-center bg-white border border-gray-200 rounded-lg py-1.5 text-sm font-medium focus:ring-2 focus:ring-emerald-400">
                    </div>
                    <div>
                        <label class="text-[11px] text-gray-500 font-medium">UAS</label>
                        <input type="number" name="nilai[uas][{{ $siswa->id }}]" value="{{ old('nilai.uas.' . $siswa->id, $siswa->uas ?? '') }}" min="0" max="100" step="0.1" class="nilai-input w-full text-center bg-white border border-gray-200 rounded-lg py-1.5 text-sm font-medium focus:ring-2 focus:ring-emerald-400">
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-8 text-gray-500">Tidak ada data siswa.</div>
            @endforelse
        </div>

        @if(!$siswaList->isEmpty())
        <div class="flex justify-between mt-6 pt-4 border-t border-gray-200">
            <a href="{{ route('guru.nilai') }}" class="inline-flex items-center justify-center rounded-full border border-gray-200 px-5 py-2.5 text-sm font-semibold text-gray-600 transition-all duration-200 hover:bg-gray-50 hover:scale-105 active:scale-95">
                Kembali
            </a>
            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-lg font-medium transition-all duration-200 hover:scale-105 active:scale-95 shadow-lg shadow-emerald-500/30">
                Update Nilai
            </button>
        </div>
        @endif
    </form>
</div>

<script>
(function() {
    var form = document.getElementById('editNilaiForm');
    if (!form) return;
    form.addEventListener('submit', function() {
        this.querySelectorAll('input[type="number"]').forEach(function(input) {
            if (input.offsetParent === null) {
                input.disabled = true;
            }
        });
    });
})();
</script>
@endsection
