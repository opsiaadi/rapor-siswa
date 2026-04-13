@extends('layouts.admin', [
    'title' => 'Data Siswa',
    'pageTitle' => 'Data Siswa',
    'breadcrumb' => 'Kelola data siswa seluruh kelas',
    'userName' => 'Admin TU'
])

@section('content')
<div class="space-y-6">

    <!-- Toolbar Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-5 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div class="flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-600 dark:text-blue-400">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
            </div>
            <div>
                <h3 class="text-base font-bold text-gray-900 dark:text-gray-100 tracking-tight">Manajemen Data Siswa</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total <span class="text-blue-600 dark:text-blue-400 font-bold">{{ count($data ?? []) }}</span> Siswa terdaftar</p>
            </div>
        </div>
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full md:w-auto">
            <form class="flex-1 sm:flex-initial" action="{{ route('admin.siswa.index') }}" method="GET">
                <label for="simple-search" class="sr-only">Cari</label>
                <div class="relative w-full sm:w-64">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" id="simple-search" name="search" value="{{ request('search', '') }}" class="bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 text-sm rounded-full focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full ps-10 p-2.5 transition-colors" placeholder="Cari siswa...">
                </div>
            </form>
            <a href="{{ route('admin.siswa.create') }}" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800 font-semibold rounded-full text-sm px-5 py-2.5 flex items-center justify-center gap-2 transition-all shadow-sm hover:shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Siswa
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 dark:text-gray-300 uppercase bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-600">
                    <tr>
                        <th scope="col" class="px-6 py-4 font-bold tracking-wider">No</th>
                        <th scope="col" class="px-6 py-4 font-bold tracking-wider">NIS</th>
                        <th scope="col" class="px-6 py-4 font-bold tracking-wider">Nama Siswa</th>
                        <th scope="col" class="px-6 py-4 font-bold tracking-wider">Jenis Kelamin</th>
                        <th scope="col" class="px-6 py-4 font-bold tracking-wider">Tahun Ajaran</th>
                        <th scope="col" class="px-6 py-4 font-bold tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @forelse($data ?? [] as $siswa)
                    <tr class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700/50 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors group">
                        <td class="px-6 py-4 text-gray-500 dark:text-gray-400 font-medium">{{ str_pad($no, 2, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-6 py-4 font-mono text-gray-900 dark:text-gray-100 font-semibold tracking-tight">{{ $siswa->nis ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full {{ $siswa->jenis_kelamin === 'L' ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' : 'bg-pink-100 dark:bg-pink-900/30 text-pink-600 dark:text-pink-400' }} flex items-center justify-center text-xs font-bold shrink-0">
                                    {{ strtoupper(substr($siswa->nama ?? 'U', 0, 1)) }}
                                </div>
                                <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $siswa->nama ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($siswa->jenis_kelamin === 'L')
                            <span class="px-3 py-1 bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-400 rounded-full text-xs font-bold uppercase tracking-tighter">Laki-Laki</span>
                            @elseif($siswa->jenis_kelamin === 'P')
                            <span class="px-3 py-1 bg-pink-50 dark:bg-pink-900/20 text-pink-700 dark:text-pink-400 rounded-full text-xs font-bold uppercase tracking-tighter">Perempuan</span>
                            @else
                            <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $siswa->tahun_ajaran ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-1">
                                <button type="button"
                                        onclick="openDetailModal({{ json_encode([
                                            'id' => $siswa->id ?? '',
                                            'nama' => $siswa->nama ?? '-',
                                            'nis' => $siswa->nis ?? '-',
                                            'jenis_kelamin' => $siswa->jenis_kelamin ?? '-',
                                            'tahun_ajaran' => $siswa->tahun_ajaran ?? '-',
                                            'kelas_nama' => $siswa->kelas_nama ?? '-',
                                            'wali_nama' => $siswa->wali_nama ?? '-',
                                        ]) }})"
                                        class="text-gray-500 hover:text-blue-600 dark:hover:text-blue-400 p-1.5 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors"
                                        title="Detail Siswa">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                                <a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="text-gray-500 hover:text-amber-600 dark:hover:text-amber-400 p-1.5 rounded-lg hover:bg-amber-50 dark:hover:bg-amber-900/20 transition-colors" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus siswa ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-500 hover:text-red-600 dark:hover:text-red-400 p-1.5 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @php $no++; @endphp
                    @empty
                    <tr class="bg-white dark:bg-gray-800">
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-gray-400 dark:text-gray-500">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 00-3 3 3 3 0 003 3zm6 3a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">Belum ada data siswa</p>
                                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Klik "Tambah Siswa" untuk menambahkan</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if(count($data ?? []) > 0)
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/30 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between">
            <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Showing <span class="font-bold text-gray-900 dark:text-gray-100">1-{{ count($data ?? []) }}</span> of <span class="font-bold text-gray-900 dark:text-gray-100">{{ count($data ?? []) }}</span> students</p>
            <div class="flex gap-2">
                <button class="px-3 py-1.5 rounded-lg bg-gray-200 dark:bg-gray-600 text-gray-400 dark:text-gray-500 font-bold text-xs cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button class="px-4 py-1.5 rounded-lg bg-blue-600 text-white font-bold text-xs shadow-sm">1</button>
                <button class="px-3 py-1.5 rounded-lg bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-bold text-xs hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors border border-gray-200 dark:border-gray-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Detail Modal -->
<div id="detailModal" tabindex="-1" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm overflow-y-auto">
    <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-2xl mx-4 border border-gray-200 dark:border-gray-700">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-5 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-blue-600 to-blue-700 dark:from-blue-700 dark:to-blue-800 rounded-t-xl">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white font-bold text-lg ring-2 ring-white/30" id="modalAvatar">A</div>
                <div>
                    <h3 class="text-lg font-bold text-white" id="modalName">Nama Siswa</h3>
                    <p class="text-xs text-blue-100/80" id="modalClass">Kelas -</p>
                </div>
            </div>
            <button onclick="closeDetailModal()" class="text-white hover:bg-white/20 rounded-lg p-2 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6 space-y-5 max-h-[60vh] overflow-y-auto">
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                <h4 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider mb-3 flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Detail Siswa
                </h4>
                <div class="space-y-3 text-sm">
                    <div class="flex items-start gap-3">
                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400 w-32 shrink-0">NIS</span>
                        <span class="font-semibold text-gray-900 dark:text-white font-mono" id="modalNIS">-</span>
                    </div>
                    <div class="border-t border-gray-100 dark:border-gray-700"></div>
                    <div class="flex items-start gap-3">
                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400 w-32 shrink-0">Nama Siswa</span>
                        <span class="font-semibold text-gray-900 dark:text-white" id="modalName2">-</span>
                    </div>
                    <div class="border-t border-gray-100 dark:border-gray-700"></div>
                    <div class="flex items-start gap-3">
                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400 w-32 shrink-0">Jenis Kelamin</span>
                        <span class="font-semibold text-gray-900 dark:text-white" id="modalGender">-</span>
                    </div>
                    <div class="border-t border-gray-100 dark:border-gray-700"></div>
                    <div class="flex items-start gap-3">
                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400 w-32 shrink-0">Tahun Ajaran</span>
                        <span class="font-semibold text-gray-900 dark:text-white" id="modalTahunAjaran">-</span>
                    </div>
                    <div class="border-t border-gray-100 dark:border-gray-700"></div>
                    <div class="flex items-start gap-3">
                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400 w-32 shrink-0">Kelas</span>
                        <span class="font-semibold text-gray-900 dark:text-white" id="modalKelas">-</span>
                    </div>
                    <div class="border-t border-gray-100 dark:border-gray-700"></div>
                    <div class="flex items-start gap-3">
                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400 w-32 shrink-0">Wali Kelas</span>
                        <span class="font-semibold text-gray-900 dark:text-white" id="modalWaliKelas">-</span>
                    </div>
                    <div class="border-t border-gray-100 dark:border-gray-700"></div>
                    <div class="flex items-start gap-3">
                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400 w-32 shrink-0">Status</span>
                        <span class="inline-flex items-center gap-1 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 text-xs font-medium px-2.5 py-1 rounded-full">
                            <div class="w-2 h-2 rounded-full bg-green-500"></div>
                            Aktif
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="flex items-center justify-end p-5 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/30 rounded-b-xl">
            <button onclick="closeDetailModal()" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                Tutup
            </button>
        </div>
    </div>
</div>

<!-- Modal JavaScript -->
<script>
    function openDetailModal(siswa) {
        const modal = document.getElementById('detailModal');
        const initial = (siswa.nama || 'U').charAt(0).toUpperCase();

        document.getElementById('modalAvatar').textContent = initial;
        document.getElementById('modalName').textContent = siswa.nama || '-';
        document.getElementById('modalName2').textContent = siswa.nama || '-';
        document.getElementById('modalClass').textContent = 'Kelas ' + (siswa.kelas_nama || '-');
        document.getElementById('modalNIS').textContent = siswa.nis || '-';
        document.getElementById('modalGender').textContent = siswa.jenis_kelamin === 'L' ? 'Laki-laki' : (siswa.jenis_kelamin === 'P' ? 'Perempuan' : '-');
        document.getElementById('modalTahunAjaran').textContent = siswa.tahun_ajaran || '-';
        document.getElementById('modalKelas').textContent = siswa.kelas_nama || '-';
        document.getElementById('modalWaliKelas').textContent = siswa.wali_nama || '-';

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeDetailModal() {
        const modal = document.getElementById('detailModal');
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }

    document.getElementById('detailModal').addEventListener('click', function(e) {
        if (e.target === this) closeDetailModal();
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeDetailModal();
    });
</script>
@endsection
