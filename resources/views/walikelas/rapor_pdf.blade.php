<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Rapor - {{ $siswa->nama }}</title>
<style>
body { font-family: DejaVu Sans, sans-serif; font-size: 10px; color: #000; }
h1 { font-size: 16px; text-align: center; margin-bottom: 4px; }
h2 { font-size: 12px; margin-bottom: 8px; border-bottom: 1px solid #ccc; padding-bottom: 4px; }
.subtitle { text-align: center; font-size: 10px; color: #666; margin-bottom: 16px; }
table.info { width: 100%; margin-bottom: 12px; }
table.info td { padding: 2px 4px; vertical-align: top; }
table.info .label { width: 100px; color: #555; }
table.info .value { font-weight: bold; }
table.nilai { width: 100%; border-collapse: collapse; margin-bottom: 12px; }
table.nilai th, table.nilai td { border: 1px solid #999; padding: 4px 6px; font-size: 9px; }
table.nilai th { background-color: #eee; font-weight: bold; text-align: center; }
table.nilai td.center { text-align: center; }
table.nilai td.bold { font-weight: bold; }
table.nilai tfoot td { background-color: #f5f5f5; }
table.absensi { width: 100%; margin-bottom: 12px; }
table.absensi td { padding: 2px 8px; }
.ttd { margin-top: 24px; width: 100%; }
.ttd td { text-align: center; vertical-align: bottom; height: 60px; }
.ttd .name { font-weight: bold; text-decoration: underline; }
.badge-lulus { color: #166534; font-weight: bold; }
.badge-tidak { color: #991b1b; font-weight: bold; }
.rata { color: #059669; font-size: 11px; font-weight: bold; }
</style>
</head>
<body>

<h1>RAPOR SISWA</h1>
<p class="subtitle">SDN 1 - Tahun Ajaran {{ $siswa->tahun_ajaran }}</p>

<table class="info">
<tr><td class="label">Nama Siswa</td><td class="value">{{ $siswa->nama ?? '-' }}</td><td class="label">NIS</td><td class="value">{{ $siswa->nis ?? '-' }}</td></tr>
<tr><td class="label">Kelas</td><td class="value">{{ $siswa->kelas_nama ?? '-' }}</td><td class="label">Wali Kelas</td><td class="value">{{ $wali_kelas->nama ?? '-' }}</td></tr>
<tr><td class="label">Semester</td><td class="value" colspan="3">{{ $semesterList[$semester] ?? '-' }} ({{ $semester }})</td></tr>
</table>

<h2>Nilai Mata Pelajaran</h2>
<table class="nilai">
<thead>
<tr>
<th style="width:20px">No</th>
<th>Mata Pelajaran</th>
<th style="width:35px">KKM</th>
<th style="width:35px">Harian</th>
<th style="width:35px">UTS</th>
<th style="width:35px">UAS</th>
<th style="width:45px">Nilai Akhir</th>
<th style="width:55px">Ket</th>
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
<span class="badge-lulus">Lulus</span>
@elseif($nilai->status == 'Tidak Lulus')
<span class="badge-tidak">Tidak Lulus</span>
@else
-
@endif
</td>
</tr>
@empty
<tr><td colspan="8" style="text-align:center;padding:12px;">Belum ada nilai untuk semester ini</td></tr>
@endforelse
</tbody>
@if($nilaiList->count() > 0)
<tfoot>
<tr>
<td colspan="6" style="text-align:right;font-weight:bold;">Rata-rata Nilai</td>
<td class="center rata">{{ $rata_rata }}</td>
<td></td>
</tr>
</tfoot>
@endif
</table>

<h2>Absensi</h2>
<table class="absensi">
<tr>
<td>Izin: <strong>{{ $siswa->izin ?? 0 }}</strong> hari</td>
<td>Sakit: <strong>{{ $siswa->sakit ?? 0 }}</strong> hari</td>
<td>Tanpa Keterangan: <strong>{{ $siswa->alpha ?? 0 }}</strong> hari</td>
</tr>
</table>

<h2>Keterangan</h2>
<p><strong>Deskripsi:</strong> {{ $siswa->keterangan ?: '-' }}</p>
@if($siswa->kegiatan)
<p><strong>Ekstrakurikuler:</strong> {{ $siswa->kegiatan }} - {{ $siswa->ket_kegiatan ?: '-' }}</p>
@endif

<table class="ttd">
<tr>
<td>
<p>Wali Kelas</p>
<br><br><br>
<p class="name">{{ $wali_kelas->nama ?? '-' }}</p>
</td>
<td>
<p>Mengetahui,</p>
<p>Kepala Sekolah</p>
<br><br><br>
<p class="name">...............................</p>
</td>
</tr>
</table>

</body>
</html>
