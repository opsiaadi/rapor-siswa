<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Rapor - {{ $siswa->nama }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 11px; color: #1a1a1a; line-height: 1.5; }
        .container { max-width: 800px; margin: 0 auto; padding: 20px; }
        .header { background: #1f2937; color: #fff; padding: 20px; text-align: center; }
        .header h1 { font-size: 20px; font-weight: 700; letter-spacing: 1px; }
        .header p { font-size: 12px; color: #d1d5db; margin-top: 4px; }
        .section { padding: 16px 20px; border-bottom: 1px solid #e5e7eb; }
        .section:last-child { border-bottom: none; }
        .section h3 { font-size: 14px; font-weight: 700; margin-bottom: 12px; color: #111827; }
        .info-grid { display: table; width: 100%; }
        .info-row { display: table-row; }
        .info-cell { display: table-cell; padding: 4px 8px; font-size: 11px; }
        .info-cell.label { color: #6b7280; font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px; }
        .info-cell.value { font-weight: 600; color: #111827; }
        table.nilai { width: 100%; border-collapse: collapse; font-size: 10px; }
        table.nilai th { background: #f3f4f6; border: 1px solid #d1d5db; padding: 6px 8px; text-align: left; font-weight: 600; color: #374151; font-size: 10px; }
        table.nilai th.center { text-align: center; }
        table.nilai td { border: 1px solid #d1d5db; padding: 6px 8px; }
        table.nilai td.center { text-align: center; }
        table.nilai td.bold { font-weight: 700; }
        table.nilai tfoot td { background: #f9fafb; }
        .badge { display: inline-block; padding: 2px 8px; font-size: 9px; font-weight: 600; border-radius: 999px; }
        .badge.green { color: #166534; background: #dcfce7; }
        .badge.red { color: #991b1b; background: #fecaca; }
        .absensi { display: flex; gap: 24px; }
        .absensi-item { display: flex; align-items: center; gap: 6px; }
        .absensi-item span:first-child { color: #4b5563; }
        .absensi-item span:last-child { font-weight: 600; }
        .keterangan p { margin-bottom: 6px; }
        .keterangan .label { color: #6b7280; font-size: 10px; }
        .ttd { padding: 20px; display: flex; justify-content: space-between; }
        .ttd-block { text-align: center; width: 200px; }
        .ttd-block .title { font-size: 11px; color: #6b7280; margin-bottom: 40px; }
        .ttd-block .name { font-weight: 600; text-decoration: underline; }
        .rata-rata { color: #059669; font-size: 14px; font-weight: 700; }
        .empty-state { text-align: center; padding: 24px; color: #6b7280; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>RAPOR SISWA</h1>
            <p>SDN 1 - Tahun Ajaran {{ $siswa->tahun_ajaran }}</p>
        </div>

        <div class="section">
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-cell">
                        <div class="info-cell label">Nama Siswa</div>
                        <div class="info-cell value">{{ $siswa->nama ?? '-' }}</div>
                    </div>
                    <div class="info-cell">
                        <div class="info-cell label">NIS</div>
                        <div class="info-cell value">{{ $siswa->nis ?? '-' }}</div>
                    </div>
                    <div class="info-cell">
                        <div class="info-cell label">Kelas</div>
                        <div class="info-cell value">{{ $siswa->kelas_nama ?? '-' }}</div>
                    </div>
                    <div class="info-cell">
                        <div class="info-cell label">Wali Kelas</div>
                        <div class="info-cell value">{{ $wali_kelas->nama ?? '-' }}</div>
                    </div>
                </div>
            </div>
            <div style="margin-top: 8px;">
                <div class="label">Semester</div>
                <div class="value" style="font-weight: 600;">{{ $semesterList[$semester] ?? '-' }} ({{ $semester }})</div>
            </div>
        </div>

        <div class="section">
            <h3>Nilai Mata Pelajaran</h3>
            <table class="nilai">
                <thead>
                    <tr>
                        <th style="width: 24px;">No</th>
                        <th>Mata Pelajaran</th>
                        <th class="center" style="width: 40px;">KKM</th>
                        <th class="center" style="width: 40px;">Harian</th>
                        <th class="center" style="width: 40px;">UTS</th>
                        <th class="center" style="width: 40px;">UAS</th>
                        <th class="center" style="width: 50px;">Nilai Akhir</th>
                        <th class="center" style="width: 60px;">Ket</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($nilaiList as $index => $nilai)
                    <tr>
                        <td class="center">{{ $index + 1 }}</td>
                        <td>{{ $nilai->mapel_nama }}</td>
                        <td class="center">{{ $nilai->kkm }}</td>
                        <td class="center">{{ $nilai->harian }}</td>
                        <td class="center">{{ $nilai->uts }}</td>
                        <td class="center">{{ $nilai->uas }}</td>
                        <td class="center bold">{{ $nilai->nilai_akhir }}</td>
                        <td class="center">
                            @if($nilai->status == 'Lulus')
                            <span class="badge green">Lulus</span>
                            @elseif($nilai->status == 'Tidak Lulus')
                            <span class="badge red">Tidak Lulus</span>
                            @else
                            -
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="empty-state">Belum ada nilai untuk semester ini</td>
                    </tr>
                    @endforelse
                </tbody>
                @if($nilaiList->count() > 0)
                <tfoot>
                    <tr>
                        <td colspan="6" style="text-align: right; font-weight: 700;">Rata-rata Nilai</td>
                        <td class="center rata-rata">{{ $rata_rata }}</td>
                        <td></td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>

        <div class="section">
            <h3>Absensi</h3>
            <div class="absensi">
                <div class="absensi-item">
                    <span>Izin:</span>
                    <span>{{ $siswa->izin ?? 0 }} hari</span>
                </div>
                <div class="absensi-item">
                    <span>Sakit:</span>
                    <span>{{ $siswa->sakit ?? 0 }} hari</span>
                </div>
                <div class="absensi-item">
                    <span>Tanpa Keterangan:</span>
                    <span>{{ $siswa->alpha ?? 0 }} hari</span>
                </div>
            </div>
        </div>

        <div class="section">
            <h3>Keterangan</h3>
            <div class="keterangan">
                <p><span class="label">Deskripsi Siswa</span></p>
                <p>{{ $siswa->keterangan ?: '-' }}</p>
                @if($siswa->kegiatan)
                <p style="margin-top: 8px;"><span class="label">Ekstrakurikuler</span></p>
                <p>{{ $siswa->kegiatan }} - {{ $siswa->ket_kegiatan ?: '-' }}</p>
                @endif
            </div>
        </div>

        <div class="ttd">
            <div class="ttd-block">
                <div class="title">Wali Kelas</div>
                <div class="name">{{ $wali_kelas->nama ?? '-' }}</div>
            </div>
            <div class="ttd-block">
                <div class="title">Mengetahui,</div>
                <div class="name">Kepala Sekolah</div>
            </div>
        </div>
    </div>
</body>
</html>
