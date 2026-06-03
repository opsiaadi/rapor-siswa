@extends('layouts.list')

@section('title', 'Ini adalah judul pada meta')
@section('content')

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Produk</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $post)
            <tr>
                <td>{{ $post['id'] }}</td>
                <td>{{ $post['produk'] }}</td>
                </tr>
        @endforeach
    </tbody>
</table>
@endsection



 <div> <h1>Input Nilai Rapor</h1></div>
 <form method="POST" action="{{ route('rapor.simpan') }}">
   <table class="table">
     <tr>
       <td>Nama Siswa:</td>
       <td colspan="3"><input type="text" class="form-control" id="nama_siswa" name="nama_siswa" required></td>
     </tr>
     <tr>
       <td>Mata Pelajaran:</td>
       <td colspan="3"><input type="text" class="form-control" id="mata_pelajaran" name="mata_pelajaran" required></td>
     </tr>
     <tr>
       <td>Nilai Tugas:</td>
       <td><input type="number" class="form-control" id="nilai_tugas" name="nilai_tugas" min="0" max="100" required></td>
       <td>Nilai UTS:</td>
       <td><input type="number" class="form-control" id="nilai_uts" name="nilai_uts" min="0" max="100" required></td>
     </tr>
     <tr>
       <td>Nilai UAS:</td>
       <td><input type="number" class="form-control" id="nilai_uas" name="nilai_uas" min="0" max="100" required></td>
       <td></td>
       <td></td>
     </tr>
   </table>
   <button type="submit" class="btn btn-primary">Simpan Nilai</button>
 </form>