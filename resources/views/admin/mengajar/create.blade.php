@extends('layouts.admin')

@section('content')
<div class="p-4">
    <h2 class="text-2xl font-bold text-gray-900  mb-6">Tambah Data Mengajar</h2>

    <form action="{{ route('admin.mengajar.store') }}" method="POST" class="max-w-lg">
        @csrf

        <div class="mb-4">
            <label for="guru_id" class="block mb-2 text-sm font-medium text-gray-900 ">Guru</label>
            <select name="guru_id" id="guru_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5   ">
                <option value="">Pilih Guru</option>
                @foreach($guruList as $guru)
                <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="mapel_id" class="block mb-2 text-sm font-medium text-gray-900 ">Mata Pelajaran</label>
            <select name="mapel_id" id="mapel_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5   ">
                <option value="">Pilih Mapel</option>
                @foreach($mapelList as $mapel)
                <option value="{{ $mapel->id }}">{{ $mapel->nama }} ({{ $mapel->kode_mapel }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="kelas_id" class="block mb-2 text-sm font-medium text-gray-900 ">Kelas</label>
            <select name="kelas_id" id="kelas_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5   ">
                <option value="">Pilih Kelas</option>
                @foreach($kelasList as $kelas)
                <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label for="semester" class="block mb-2 text-sm font-medium text-gray-900 ">Semester</label>
            <select name="semester" id="semester" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5   ">
                <option value="1">Semester 1</option>
                <option value="2">Semester 2</option>
            </select>
        </div>

        <div class="flex space-x-2">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
            <a href="{{ route('admin.mengajar.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400   ">Batal</a>
        </div>
    </form>
</div>
@endsection
