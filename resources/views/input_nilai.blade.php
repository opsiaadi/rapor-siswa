<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Nilai Siswa</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-white-700">

<div class="flex min-h-screen">

    <aside class="w-20 bg-black-700 text-black p-6">

    <h2 class="text-xl font-bold mb-8">Admin Panel</h2>

    <nav class="space-y-2 text-sm">

        <a href="/admin/dashboard" class="block hover:bg-blue-600 p-2 rounded">Beranda</a>
        <a href="/input_nilai" class="block hover:bg-blue-600 p-2 rounded">Input Nilai</a>

    </nav>

    </aside>

    <main class="flex-1 p-6">

        <div class="flex justify-between items-center bg-gray-100 p-4 rounded-xl shadow">
            <h1 class="text-lg font-bold">Input Nilai Siswa</h1>

            <div class="flex items-center gap-3">
                <span class="text-sm">Nama Guru</span>
                <div class="w-10 h-10 rounded-full border flex items-center justify-center">
                    👤
                </div>
            </div>
        </div>

        <div class="bg-gray-100 p-4 mt-4 rounded-xl shadow flex gap-4 items-end">

            <div>
                <label class="text-xs text-gray-500">KELAS</label>
                <select class="block bg-gray-200 rounded px-3 py-2 text-sm">
                    <option>XI.7</option>
                </select>
            </div>

            <div>
                <label class="text-xs text-gray-500">SEMESTER/KATEGORI</label>
                <select class="block bg-gray-200 rounded px-3 py-2 text-sm">
                    <option>II/UAS</option>
                </select>
            </div>

            <div>
                <label class="text-xs text-gray-500">MATA PELAJARAN</label>
                <select class="block bg-gray-200 rounded px-3 py-2 text-sm">
                    <option>Matematika</option>
                </select>
            </div>

            <button class="ml-auto bg-blue-700 text-white px-6 py-2 rounded-lg">
                TAMPILKAN
            </button>
        </div>

        <div class="bg-gray-100 mt-4 p-4 rounded-xl shadow">

            <h2 class="text-sm font-semibold mb-3">Daftar Siswa</h2>

            <table class="w-full text-sm">
                <thead>
                    <tr class="text-gray-600 border-b">
                        <th class="py-2 text-left">No.</th>
                        <th class="text-left">Nama Siswa</th>
                        <th>Harian (n%)</th>
                        <th>UTS (n%)</th>
                        <th>UAS (n%)</th>
                        <th>Nilai Akhir</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody class="text-center">

                    <tr class="border-b">
                        <td class="py-3 text-left">01</td>
                        <td class="text-left">Andini Fantuzzia Ramadhani</td>
                        <td><input type="number" value="95" class="w-14 text-center bg-blue-700 text-white rounded"></td>
                        <td><input type="number" value="89" class="w-14 text-center bg-blue-700 text-white rounded"></td>
                        <td><input type="number" value="90" class="w-14 text-center bg-blue-700 text-white rounded"></td>
                        <td>-</td>
                        <td>Tuntas</td>
                    </tr>

                    <tr class="border-b">
                        <td class="py-3 text-left">02</td>
                        <td class="text-left">Kelysa Sibuea</td>
                        <td><input type="number" value="95" class="w-14 text-center bg-blue-700 text-white rounded"></td>
                        <td><input type="number" value="89" class="w-14 text-center bg-blue-700 text-white rounded"></td>
                        <td><input type="number" value="90" class="w-14 text-center bg-blue-700 text-white rounded"></td>
                        <td>-</td>
                        <td>Tuntas</td>
                    </tr>

                    <tr>
                        <td class="py-3 text-left">03</td>
                        <td class="text-left">Opsi Adi Ramadhan</td>
                        <td><input type="number" value="95" class="w-14 text-center bg-blue-700 text-white rounded"></td>
                        <td><input type="number" value="89" class="w-14 text-center bg-blue-700 text-white rounded"></td>
                        <td><input type="number" value="90" class="w-14 text-center bg-blue-700 text-white rounded"></td>
                        <td>-</td>
                        <td>Tidak Tuntas</td>
                    </tr>

                </tbody>
            </table>

            <div class="flex justify-between mt-6">
                <div class="flex gap-3">
                    <button class="bg-blue-700 text-white px-6 py-2 rounded-lg">EDIT</button>
                    <button class="bg-blue-700 text-white px-6 py-2 rounded-lg">SIMPAN</button>
                </div>

                <button class="bg-blue-700 text-white px-8 py-2 rounded-lg">KIRIM</button>
            </div>

        </div>

    </main>

</div>

</body>
</html>