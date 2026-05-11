@extends('layouts.guru', [
    'title' => 'Input Nilai Siswa',
    'pageTitle' => 'Input Nilai Siswa',
    'breadcrumb' => 'Input nilai harian, UTS, UAS',
    'id' => $id ?? 1,
    'namaGuru' => $namaGuru ?? 'Guru Mapel',
])

@section('content')
<div class="bg-gray-50 p-4 rounded-xl mb-6">
    <form action="{{ route('guru.nilai') }}" method="GET" class="flex flex-wrap justify-center gap-4 items-end">
        <div>
            <label class="text-xs font-semibold text-gray-500 uppercase">Mengajar</label>
            <select name="mengajar" class="block w-full bg-white border border-gray-200 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Pilih Mengajar --</option>
                @foreach($guruMengajar as $mengajar)
                <option value="{{ $mengajar->id }}" {{ isset($filter['mengajarId']) && $filter['mengajarId'] == $mengajar->id ? 'selected' : '' }}>
                    {{ $mengajar->mapel_nama }} - Kelas {{ $mengajar->kelas_nama }} (Semester {{ $mengajar->semester }})
                </option>
                @endforeach
                @if($guruMengajar->isEmpty())
                <option value="">(Tidak ada data mengajar)</option>
                @endif
            </select>
        </div>

        <div>
            <label class="text-xs font-semibold text-gray-500 uppercase">Kelas</label>
            <select name="kelas" class="block w-full bg-white border border-gray-200 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Pilih Kelas --</option>
                @foreach($kelasList as $kelas)
                <option value="{{ $kelas->id }}" {{ isset($filter['kelasId']) && $filter['kelasId'] == $kelas->id ? 'selected' : '' }}>{{ $kelas->nama_kelas }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="text-xs font-semibold text-gray-500 uppercase">Semester</label>
            <select name="semester" class="block w-full bg-white border border-gray-200 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="1" {{ isset($filter['semester']) && $filter['semester'] == 1 ? 'selected' : '' }}>Semester 1</option>
                <option value="2" {{ isset($filter['semester']) && $filter['semester'] == 2 ? 'selected' : '' }}>Semester 2</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-all duration-200 hover:scale-105 active:scale-95 shadow-lg shadow-blue-500/30">
            Tampilkan
        </button>
    </form>
</div>

@if(isset($filter['mapelId']) && $filter['mapelId'])
<div class="bg-gray-50 p-4 rounded-xl overflow-hidden">
    <h3 class="text-sm font-semibold text-gray-700 mb-4">Daftar Siswa - {{ $guruMengajar->firstWhere('mapel_id', $filter['mapelId'])->mapel_nama ?? '' }} (Kelas {{ $kelasList->firstWhere('id', $filter['kelasId'])->nama_kelas ?? '' }})</h3>
    
    <form id="nilaiForm" action="{{ route('guru.nilai') }}" method="POST">
        @csrf
        <input type="hidden" name="mengajar" value="{{ $filter['mengajarId'] ?? '' }}">
        <input type="hidden" name="kelas" value="{{ $filter['kelasId'] ?? '' }}">
        <input type="hidden" name="semester" value="{{ $filter['semester'] ?? '' }}">
        <input type="hidden" name="mapel" value="{{ $filter['mapelId'] ?? '' }}">
        <input type="hidden" name="action" id="actionInput" value="">
        <div class="overflow-x-auto">
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
                    <tr class="border-b border-gray-100 hover:bg-gray-100 transition-colors">
                        <td class="py-3 px-2 text-left text-gray-600">{{ $i + 1 }}</td>
                        <td class="py-3 px-2 text-left font-medium text-gray-800">{{ $siswa->nama }}</td>
                        <td class="py-3 px-2">
                            <input type="number" name="nilai[harian][{{ $siswa->id }}]" value="{{ old('nilai.harian.' . $siswa->id, $siswa->harian ?? '') }}" min="0" max="100" step="0.1" class="nilai-input w-20 text-center bg-white border border-gray-200 rounded-lg py-1.5 font-medium focus:ring-2 focus:ring-blue-400" readonly>
                        </td>
                        <td class="py-3 px-2">
                            <input type="number" name="nilai[uts][{{ $siswa->id }}]" value="{{ old('nilai.uts.' . $siswa->id, $siswa->uts ?? '') }}" min="0" max="100" step="0.1" class="nilai-input w-20 text-center bg-white border border-gray-200 rounded-lg py-1.5 font-medium focus:ring-2 focus:ring-blue-400" readonly>
                        </td>
                        <td class="py-3 px-2">
                            <input type="number" name="nilai[uas][{{ $siswa->id }}]" value="{{ old('nilai.uas.' . $siswa->id, $siswa->uas ?? '') }}" min="0" max="100" step="0.1" class="nilai-input w-20 text-center bg-white border border-gray-200 rounded-lg py-1.5 font-medium focus:ring-2 focus:ring-blue-400" readonly>
                        </td>
                        <td class="py-3 px-2 font-bold text-blue-600">
                            {{ $siswa->nilai_akhir ? number_format($siswa->nilai_akhir, 1) : '-' }}
                        </td>
                        <td class="py-3 px-2">
                            @if($siswa->status_kkm)
                                @php
                                    $badgeClass = $siswa->status_kkm == 'lulus' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700';
                                @endphp
                                <span class="px-2 py-1 {{ $badgeClass }} rounded-full text-xs font-semibold">{{ ucfirst($siswa->status_kkm) }}</span>
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

        @if(!$siswaList->isEmpty())
        <div class="flex justify-between mt-6 pt-4 border-t border-gray-200">
            <div class="flex gap-3">
                <button type="button" onclick="editNilai()" class="bg-amber-500 hover:bg-amber-600 text-white px-6 py-2 rounded-lg font-medium transition-all duration-200 hover:scale-105 active:scale-95">
                    Edit
                </button>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-medium transition-all duration-200 hover:scale-105 active:scale-95 shadow-lg shadow-green-500/30">
                    Simpan
                </button>
            </div>
            <button type="button" onclick="kirimNilai()" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-lg font-medium transition-all duration-200 hover:scale-105 active:scale-95 shadow-lg shadow-emerald-500/30">
                Kirim
            </button>
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
function editNilai() {
    const inputs = document.querySelectorAll('.nilai-input');
    inputs.forEach(input => input.removeAttribute('readonly'));
    alert('Mode edit aktif. Silakan ubah nilai kemudian klik Simpan.');
}

function kirimNilai() {
    document.getElementById('actionInput').value = 'kirim';
    document.getElementById('nilaiForm').submit();
}
</script>
@endsection