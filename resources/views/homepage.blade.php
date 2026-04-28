<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lapor Siswa</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;800&family=Inter:wght@400;500&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        h1,h2,h3 { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">

<!-- NAVBAR -->
<nav class="flex justify-between items-center px-8 py-4 bg-white shadow">
    <div class="flex items-center gap-2">
        <img src="{{ asset('images/open-book.png')}}" alt="logo-rapor" class="h-10 w-auto">
        <h1 class="font-bold text-lg">EduReport</h1>
    </div>
    <div class="hidden md:flex gap-6">
        <a class="text-blue-600 font-semibold border-b-2 border-blue-600">Beranda</a>
        <a href="#fitur" class="hover:text-blue-600">Fitur</a>
        <a class="hover:text-blue-600">Tentang</a>
    </div>

    <div class="flex gap-3">
        <form action="{{route ('login') }}" method="GET">
            <button class="px-4 py-2 rounded-lg">Masuk</button>
        </form>
        <form>
            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">Daftar</button>
        </form>
    </div>
</nav>

<!-- HERO -->
<section class="px-10 py-12 bg-blue-700 text-white"> 
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-10 items-center">
        <div>
            <h1 class="text-4xl font-extrabold leading-tight">
                Kelola Rapor Siswa <br>
                <span class="text-green-400">Lebih Mudah</span> 
            </h1>

            <p class="mt-4 text-blue-100">
                Sistem manajemen rapor sekolah dari input nilai sampai cetak rapor dalam satu platform.
            </p>

            <div class="mt-6 flex gap-4">
                <form action="{{ route('login') }}" method="GET">
                    <button class="bg-white text-blue-700 font-bold px-6 py-3 rounded-lg hover:bg-gray-100 transition">
                        Mulai
                    </button>
                </form>
            </div>
            <!-- Stats -->
            <div class="flex gap-8 mt-10 text-sm">
                <div><b class="text-2xl block">1200+</b>Siswa</div>
                <div><b class="text-2xl block">450+</b>Guru</div>
                <div><b class="text-2xl block">14</b>Mata Pelajaran</div>
            </div>
        </div>
        <div class="flex justify-center md:justify-end">
            <img src="{{ asset('images/homepage.png') }}" class="w-full max-w-md object-contain">
        </div>
    </div>
</section>

<!-- FITUR -->
<section id="fitur" class="bg-white py-16 px-8">
    <h2 class="text-2xl font-bold text-center mb-10">Fitur Utama</h2>

    <div class="grid md:grid-cols-3 gap-6 max-w-6xl mx-auto">

        <div class="p-6 shadow rounded-xl hover:shadow-lg">
            <span class="material-symbols-outlined text-blue-600">people</span>
            <h3 class="font-bold mt-3">Manajemen Data Siswa</h3>
            <p class="text-sm text-gray-600 mt-2">Kelola data siswa dengan mudah.</p>
        </div>

        <div class="p-6 shadow rounded-xl hover:shadow-lg">
            <span class="material-symbols-outlined text-green-600">edit</span>
            <h3 class="font-bold mt-3">Input Nilai</h3>
            <p class="text-sm text-gray-600 mt-2">Input nilai dengan cepat dan mudah.</p>
        </div>

        <div class="p-6 shadow rounded-xl hover:shadow-lg">
            <span class="material-symbols-outlined text-orange-600">auto_graph</span>
            <h3 class="font-bold mt-3">Rekap Nilai  Otomatis</h3>
            <p class="text-sm text-gray-600 mt-2">Perhitungan Nilai Otomatis dan Akurat</p>
        </div>

    </div>
</section>

<section>

</section>

<!-- FOOTER -->
<footer class="bg-gray-900 text-gray-300 py-10 mt-10">
    <div class="max-w-6xl mx-auto px-8 grid md:grid-cols-3 gap-8">

        <div>
            <h3 class="text-white font-bold">Lapor Siswa</h3>
            <p class="text-sm mt-2">Platform akademik untuk sekolah.</p>
        </div>

        <div>
            <h4 class="font-semibold mb-2">Menu</h4>
            <ul class="space-y-1 text-sm">
                <li>Beranda</li>
                <li><a href="#fitur" class="hover:text-white">Fitur</a></li>
                <li>Tentang</li>
            </ul>
        </div>

        <div>
            <h4 class="font-semibold mb-2">Kontak</h4>
            <p class="text-sm">info@laporsiswa.id</p>
        </div>

    </div>

    <p class="text-center text-xs mt-8">© 2026 Lapor Siswa</p>
</footer>

</body>
</html>