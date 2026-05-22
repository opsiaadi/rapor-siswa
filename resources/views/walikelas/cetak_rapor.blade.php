<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Rapor - {{ $siswa->nama }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none !important; }
            body { margin: 0; padding: 0; }
            .print-area { box-shadow: none !important; border: none !important; }
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">

    {{-- Tombol Cetak & Kembali --}}
    <div class="no-print sticky top-0 z-50 bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-4xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('walikelas.siswa') }}" class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-gray-900 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali
            </a>
            <div class="flex items-center gap-3">
                <select id="semesterSelect" class="text-sm border border-gray-300 rounded-lg px-3 py-1.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="1" {{ $semester == '1' ? 'selected' : '' }}>Semester Ganjil</option>
                    <option value="2" {{ $semester == '2' ? 'selected' : '' }}>Semester Genap</option>
                </select>
                <button onclick="window.print()" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg shadow-sm transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    Cetak Rapor
                </button>
            </div>
        </div>
    </div>

    {{-- Area Cetak --}}
    <div class="print-area max-w-4xl mx-auto my-6 bg-white shadow-lg rounded-xl overflow-hidden">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-gray-800 to-gray-900 text-white px-8 py-6 text-center">
            <h1 class="text-2xl font-bold tracking-wide">RAPOR SISWA</h1>
            <p class="text-gray-300 text-sm mt-1">SDN 1 - Tahun Ajaran {{ $siswa->tahun_ajaran }}</p>
        </div>

        {{-- Info Siswa --}}
        <div class="px-8 py-5 border-b border-gray-200">
            <div class="grid grid-cols-2 gap-x-8 gap-y-2 text-sm">
                <div class="flex"><span class="text-gray-500 w-28 shrink-0">Nama Siswa</span><span class="font-semibold">: {{ $siswa->nama }}</span></div>
                <div class="flex"><span class="text-gray-500 w-28 shrink-0">NIS</span><span class="font-semibold">: {{ $siswa->nis }}</span></div>
                <div class="flex"><span class="text-gray-500 w-28 shrink-0">Kelas</span><span class="font-semibold">: {{ $siswa->kelas_nama }}</span></div>
                <div class="flex"><span class="text-gray-500 w-28 shrink-0">Wali Kelas</span><span class="font-semibold">: {{ $wali_kelas->nama }}</span></div>
                <div class="flex"><span class="text-gray-500 w-28 shrink-0">Semester</span><span class="font-semibold">: {{ $semesterList[$semester] }} ({{ $semester }})</span></div>
            </div>
        </div>

        {{-- Nilai --}}
        <div class="px-8 py-5 border-b border-gray-200">
            <h2 class="text-base font-bold text-gray-800 mb-3">Nilai Mata Pelajaran</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-xs border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-3 py-2 text-center w-8">No</th>
                            <th class="border border-gray-300 px-3 py-2 text-left">Mata Pelajaran</th>
                            <th class="border border-gray-300 px-3 py-2 text-center w-12">KKM</th>
                            <th class="border border-gray-300 px-3 py-2 text-center w-14">Harian</th>
                            <th class="border border-gray-300 px-3 py-2 text-center w-14">UTS</th>
                            <th class="border border-gray-300 px-3 py-2 text-center w-14">UAS</th>
                            <th class="border border-gray-300 px-3 py-2 text-center w-16">Nilai Akhir</th>
                            <th class="border border-gray-300 px-3 py-2 text-center w-16">Ket</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($nilaiList as $index => $nilai)
                        <tr>
                            <td class="border border-gray-300 px-3 py-2 text-center">{{ $index + 1 }}</td>
                            <td class="border border-gray-300 px-3 py-2">{{ $nilai->mapel_nama }}</td>
                            <td class="border border-gray-300 px-3 py-2 text-center">{{ $nilai->kkm }}</td>
                            <td class="border border-gray-300 px-3 py-2 text-center">{{ $nilai->harian }}</td>
                            <td class="border border-gray-300 px-3 py-2 text-center">{{ $nilai->uts }}</td>
                            <td class="border border-gray-300 px-3 py-2 text-center">{{ $nilai->uas }}</td>
                            <td class="border border-gray-300 px-3 py-2 text-center font-bold">{{ $nilai->nilai_akhir }}</td>
                            <td class="border border-gray-300 px-3 py-2 text-center">
                                @if($nilai->status == 'Lulus')
                                <span class="text-green-700 font-semibold">Lulus</span>
                                @elseif($nilai->status == 'Tidak Lulus')
                                <span class="text-red-700 font-semibold">Tidak Lulus</span>
                                @else
                                -
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="8" class="border border-gray-300 px-3 py-4 text-center text-gray-500">Belum ada nilai untuk semester ini</td></tr>
                        @endforelse
                    </tbody>
                    @if($nilaiList->count() > 0)
                    <tfoot>
                        <tr class="bg-gray-50">
                            <td colspan="6" class="border border-gray-300 px-3 py-2 text-right font-bold">Rata-rata</td>
                            <td class="border border-gray-300 px-3 py-2 text-center font-bold text-green-600 text-sm">{{ $rata_rata }}</td>
                            <td class="border border-gray-300 px-3 py-2"></td>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
        </div>

        {{-- Absensi --}}
        <div class="px-8 py-5 border-b border-gray-200">
            <h2 class="text-base font-bold text-gray-800 mb-3">Absensi</h2>
            <div class="flex gap-8 text-sm">
                <span class="text-gray-600">Izin: <strong class="text-gray-900">{{ $siswa->izin ?? 0 }}</strong> hari</span>
                <span class="text-gray-600">Sakit: <strong class="text-gray-900">{{ $siswa->sakit ?? 0 }}</strong> hari</span>
                <span class="text-gray-600">Tanpa Keterangan: <strong class="text-gray-900">{{ $siswa->alpha ?? 0 }}</strong> hari</span>
            </div>
        </div>

        {{-- Keterangan --}}
        <div class="px-8 py-5 border-b border-gray-200">
            <h2 class="text-base font-bold text-gray-800 mb-3">Keterangan</h2>
            <p class="text-sm text-gray-700"><span class="text-gray-500">Deskripsi:</span> {{ $siswa->keterangan ?: '-' }}</p>
            @if($siswa->kegiatan)
            <p class="text-sm text-gray-700 mt-2"><span class="text-gray-500">Ekstrakurikuler:</span> {{ $siswa->kegiatan }} - {{ $siswa->ket_kegiatan ?: '-' }}</p>
            @endif
        </div>

        {{-- Tanda Tangan --}}
        <div class="px-8 py-8">
            <table class="w-full">
                <tr>
                    <td class="text-center w-1/2">
                        <p class="text-sm text-gray-500 mb-16">Wali Kelas</p>
                        <p class="font-semibold underline">{{ $wali_kelas->nama }}</p>
                    </td>
                    <td class="text-center w-1/2">
                        <p class="text-sm text-gray-500">Mengetahui,</p>
                        <p class="text-sm text-gray-500 mb-16">Kepala Sekolah</p>
                        <p class="font-semibold underline">...............................</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <script>
        document.getElementById('semesterSelect').addEventListener('change', function() {
            const url = new URL(window.location.href);
            url.searchParams.set('semester', this.value);
            window.location.href = url.toString();
        });
    </script>
</body>
</html>
