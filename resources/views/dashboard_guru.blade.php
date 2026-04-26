@extends('layouts.guru')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-800 dark:text-white">Input Nilai Siswa</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Masukkan nilai harian, UTS, dan UAS untuk setiap siswa</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-sm text-gray-600 dark:text-gray-300">{{ $namaGuru ?? 'Guru Mapel' }}</span>
                <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-semibold">
                    {{ strtoupper(substr($namaGuru ?? 'G', 0, 1)) }}
                </div>
            </div>
        </div>

        <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-xl mb-6">
            <form action="{{ route('guru.nilai', ['id' => $id ?? 1, 'namaGuru' => $namaGuru ?? 'Guru']) }}" method="GET" class="flex flex-wrap justify-center gap-4 items-end">
                <div>
                    <label class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Kelas</label>
                    <select name="kelas" class="block w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($kelasList as $kelas)
                            <option value="{{ $kelas->id }}" {{ isset($filter['kelasId']) && $filter['kelasId'] == $kelas->id ? 'selected' : '' }}>{{ $kelas->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Semester / Kategori</label>
                    <select name="semester" class="block w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Semester --</option>
                        @foreach($semesterList as $semester)
                            <option value="{{ $semester->id }}" {{ isset($filter['semester']) && $filter['semester'] == $semester->id ? 'selected' : '' }}>{{ $semester->nama }} - {{ $semester->kategori }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Mata Pelajaran</label>
                    <select name="mapel" class="block w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Mapel --</option>
                        @foreach($mapelList as $mapel)
                            <option value="{{ $mapel->id }}" {{ isset($filter['mapelId']) && $filter['mapelId'] == $mapel->id ? 'selected' : '' }}>{{ $mapel->nama_mapel }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-all shadow-lg shadow-blue-500/30">
                    Tampilkan
                </button>
            </form>
        </div>

        <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-xl overflow-hidden">
            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-4">Daftar Siswa</h3>

            <form action="/dashboard_guru/guru/nilai" method="POST">
                @csrf
                <input type="hidden" name="guru_id" value="{{ $id ?? 'GR001' }}">
                <input type="hidden" name="guru_nama" value="{{ $namaGuru ?? 'Guru Mapel' }}">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-gray-600">
                                <th class="py-3 px-2 text-left w-12">No.</th>
                                <th class="py-3 px-2 text-left">Nama Siswa</th>
                                <th class="py-3 px-2 text-center">Harian (n%)</th>
                                <th class="py-3 px-2 text-center">UTS (n%)</th>
                                <th class="py-3 px-2 text-center">UAS (n%)</th>
                                <th class="py-3 px-2 text-center">Nilai Akhir</th>
                                <th class="py-3 px-2 text-center">Status</th>
                            </tr>
                        </thead>

                        <tbody class="text-center">
                            @forelse($siswaList ?? [] as $i => $siswa)
                            <tr class="border-b border-gray-100 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700/50 transition-colors">
                                <td class="py-3 px-2 text-left text-gray-600 dark:text-gray-400">{{ $i + 1 }}</td>
                                <td class="py-3 px-2 text-left font-medium text-gray-800 dark:text-white">{{ $siswa->nama }}</td>
                                <td class="py-3 px-2"><input type="number" name="nilai[harian][{{ $siswa->id }}]" value="{{ $siswa->harian ?? '' }}" min="0" max="100" class="w-16 text-center bg-blue-600 dark:bg-blue-500 text-white rounded-lg py-1.5 font-medium focus:ring-2 focus:ring-blue-400"></td>
                                <td class="py-3 px-2"><input type="number" name="nilai[uts][{{ $siswa->id }}]" value="{{ $siswa->uts ?? '' }}" min="0" max="100" class="w-16 text-center bg-blue-600 dark:bg-blue-500 text-white rounded-lg py-1.5 font-medium focus:ring-2 focus:ring-blue-400"></td>
                                <td class="py-3 px-2"><input type="number" name="nilai[uas][{{ $siswa->id }}]" value="{{ $siswa->uas ?? '' }}" min="0" max="100" class="w-16 text-center bg-blue-600 dark:bg-blue-500 text-white rounded-lg py-1.5 font-medium focus:ring-2 focus:ring-blue-400"></td>
                                <td class="py-3 px-2 font-bold text-blue-600 dark:text-blue-400">-</td>
                                <td class="py-3 px-2"><span class="px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-full text-xs font-semibold">Tuntas</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="py-4 text-center text-gray-500 dark:text-gray-400">Pilih kelas terlebih dahulu untuk menampilkan siswa.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="flex justify-between mt-6 pt-4 border-t border-gray-200 dark:border-gray-600">
                    <div class="flex gap-3">
                        <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-all shadow-lg shadow-blue-500/30">
                            Edit
                        </button>
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-medium transition-all shadow-lg shadow-green-500/30">
                            Simpan
                        </button>
                    </div>

                    <button type="button" class="bg-violet-600 hover:bg-violet-700 text-white px-8 py-2 rounded-lg font-medium transition-all shadow-lg shadow-violet-500/30">
                        Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection