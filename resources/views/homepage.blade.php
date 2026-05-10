<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lapor Siswa</title>
    @vite(['resources/css/app.css'])
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
<nav class="bg-white border-b border-gray-200 dark:bg-gray-900 dark:border-gray-700">
  <div class="max-w-screen-xl mx-auto px-4 py-2 flex items-center w-full">
    <!-- Logo & Title - Left -->
    <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="{{ asset('images/open-book.png')}}" class="h-10" alt="logo-rapor" />
      <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">SiRapor</span>
    </a>

    <!-- Navigation Menu - Center -->
    <div class="flex-1 hidden md:flex md:w-auto justify-center" id="navbar-default">
      <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
        <li>
          <a href="#" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white relative after:absolute after:bottom-0 after:left-3 after:w-0 after:h-0.5 after:bg-blue-700 after:transition-all after:duration-300 md:after:w-0 hover:after:w-8" aria-current="page">Beranda</a>
        </li>
        <li>
          <a href="#fitur" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent transition-all duration-300 hover:scale-105 relative">Fitur</a>
        </li>
        <li>
          <a href="#tentang" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent transition-all duration-300 hover:scale-105 relative">Tentang</a>
        </li>
      </ul>
    </div>

    <!-- Buttons - Right -->
    <div class="hidden md:flex gap-3">
      <form action="{{ route('login') }}" method="GET">
        <button class="text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg px-4 py-2 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5 active:scale-95">Masuk</button>
      </form>
      <form action="#">
        <button class="text-sm font-medium text-white bg-blue-600 rounded-lg px-4 py-2 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5 active:scale-95">Daftar</button>
      </form>
    </div>

    <!-- Mobile menu button - Right -->
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
      <span class="sr-only">Open main menu</span>
      <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 5h14a1 1 0 110 2H3a1 1 0 110-2zm0 4h14a1 1 0 110 2H3a1 1 0 110-2zm0 4h14a1 1 0 110 2H3a1 1 0 110-2z" clip-rule="evenodd"></path></svg>
    </button>
  </div>
</nav>

<!-- HERO  -->
<section class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 text-white py-16">
  <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-10 items-center px-8">
    <div>
      <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
        Kelola Rapor Siswa <br>
        <span class="text-green-300">Lebih Mudah</span>
      </h1>
      <p class="mt-4 text-indigo-100 max-w-md">
        Sistem manajemen rapor sekolah dari input nilai sampai cetak rapor dalam satu platform.
      </p>
      <div class="mt-6 flex gap-4">
        <a href="{{ route('login') }}" class="inline-block bg-white text-indigo-700 font-bold px-6 py-3 rounded-lg hover:bg-gray-100 transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5">
          Mulai
        </a>
      </div>
      <div class="flex gap-8 mt-10 text-sm">
        <div><b class="text-2xl block">1200+</b>Siswa</div>
        <div><b class="text-2xl block">450+</b>Guru</div>
        <div><b class="text-2xl block">14</b>Mata Pelajaran</div>
      </div>
    </div>
    <div class="flex justify-center md:justify-end">
      <img src="{{ asset('images/homepage.png') }}" class="w-full max-w-md object-contain rounded-xl shadow-2xl" alt="Homepage illustration" />
    </div>
  </div>
</section>

<!-- FEATURES using Flowbite cards -->
<section id="fitur" class="py-16 px-8 bg-gradient-to-r from-indigo-500 via-purple-600 to-pink-500 text-white" style="background-size:cover;">
  <h2 class="text-3xl font-bold text-center mb-12 text-white">Fitur Utama</h2>
  <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow hover:shadow-xl transition-all duration-300 hover:scale-105 hover:-translate-y-1">
      <svg class="w-8 h-8 text-indigo-600 mb-3" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
      <h3 class="font-bold mb-2 text-gray-800">Manajemen Data Siswa</h3>
      <p class="text-gray-700">Kelola data siswa dengan mudah.</p>
    </div>
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow hover:shadow-xl transition-all duration-300 hover:scale-105 hover:-translate-y-1">
      <svg class="w-8 h-8 text-green-600 mb-3" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14l4-4h12c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"/></svg>
      <h3 class="font-bold mb-2 text-gray-800">Input Nilai</h3>
      <p class="text-gray-700">Input nilai dengan cepat dan mudah.</p>
    </div>
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow hover:shadow-xl transition-all duration-300 hover:scale-105 hover:-translate-y-1">
      <svg class="w-8 h-8 text-orange-600 mb-3" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm4 0h14V7H7v2zm0 4h14v-2H7v2zm0 4h14v-2H7v2z"/></svg>
      <h3 class="font-bold mb-2 text-gray-800">Rekap Nilai Otomatis</h3>
      <p class="text-gray-700">Perhitungan Nilai Otomatis dan Akurat.</p>
    </div>
  </div>
</section>

<!-- TENTANG -->
<section id="tentang" class="py-16 px-8 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 text-white">
  <div class="max-w-5xl mx-auto">
    <h2 class="text-3xl font-bold text-center mb-4">Tentang SiRapor</h2>
    <p class="text-center text-white mb-12 max-w-2xl mx-auto">Platform manajemen rapor sekolah digital yang dirancang untuk mempermudah proses pengelolaan nilai dan laporan akademik.</p>

    <div class="grid md:grid-cols-2 gap-10">
      <div class="bg-white rounded-2xl shadow-md p-8 hover:shadow-xl transition-all duration-300 hover:scale-105 hover:-translate-y-1">
        <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mb-4">
          <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <h3 class="font-bold text-lg mb-2 text-gray-800">Visi</h3>
        <p class="text-gray-700 text-sm leading-relaxed">Menjadi solusi terdepan dalam digitalisasi sistem penilaian dan pelaporan akademik di lingkungan pendidikan Indonesia, sehingga proses evaluasi menjadi lebih transparan, efisien, dan mudah diakses.</p>
      </div>

      <div class="bg-white rounded-2xl shadow-md p-8 hover:shadow-xl transition-all duration-300 hover:scale-105 hover:-translate-y-1">
        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4">
          <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
        </div>
        <h3 class="font-bold text-lg mb-2 text-gray-800">Misi</h3>
        <p class="text-gray-700 text-sm leading-relaxed">Membantu sekolah dan institusi pendidikan mengelola data siswa, nilai akademik, dan kehadiran secara terpusat. Mendukung guru dalam proses pengajaran dan memberikan kemudahan bagi orang tua dalam memantau perkembangan anak.</p>
      </div>
    </div>

    <div class="mt-12 bg-white rounded-2xl shadow-md p-8">
      <h3 class="font-bold text-xl mb-4 text-center text-gray-800">Kenapa SiRapor?</h3>
      <div class="grid md:grid-cols-3 gap-6 text-center">
        <div class="p-4 rounded-xl hover:bg-indigo-50 transition-all duration-300 hover:scale-105 hover:-translate-y-1 cursor-pointer">
          <div class="text-3xl font-bold text-indigo-600 mb-1">📊</div>
          <p class="text-sm font-medium text-gray-800">Real-time</p>
          <p class="text-xs text-gray-600 mt-1">Data nilai dan kehadiran diperbarui secara langsung</p>
        </div>
        <div class="p-4 rounded-xl hover:bg-green-50 transition-all duration-300 hover:scale-105 hover:-translate-y-1 cursor-pointer">
          <div class="text-3xl font-bold text-green-600 mb-1">🔒</div>
          <p class="text-sm font-medium text-gray-800">Aman</p>
          <p class="text-xs text-gray-600 mt-1">Hak akses berbasis peran menjaga keamanan data</p>
        </div>
        <div class="p-4 rounded-xl hover:bg-orange-50 transition-all duration-300 hover:scale-105 hover:-translate-y-1 cursor-pointer">
          <div class="text-3xl font-bold text-orange-500 mb-1">⚡</div>
          <p class="text-sm font-medium text-gray-800">Efisien</p>
          <p class="text-xs text-gray-600 mt-1">Perhitungan nilai otomatis menghemat waktu guru</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER using Flowbite -->
<footer class="bg-gray-900 text-gray-300 py-10">
  <div class="max-w-6xl mx-auto px-8 grid md:grid-cols-3 gap-8">
    <div>
      <h3 class="text-white font-bold mb-2">Lapor Siswa</h3>
      <p class="text-sm">Platform akademik untuk sekolah.</p>
    </div>
    <div>
      <h4 class="font-semibold mb-2">Menu</h4>
      <ul class="space-y-1 text-sm">
        <li><a href="#" class="hover:underline">Beranda</a></li>
        <li><a href="#fitur" class="hover:underline">Fitur</a></li>
        <li><a href="#" class="hover:underline">Tentang</a></li>
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