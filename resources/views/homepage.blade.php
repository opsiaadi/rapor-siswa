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
<nav class="bg-white border-b border-gray-200">
  <div class="max-w-screen-xl mx-auto px-4 py-2 flex items-center w-full">
    <!-- Logo & Title - Left -->
    <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="{{ asset('images/open-book.png')}}" class="h-10" alt="logo-rapor" />
      <span class="self-center text-2xl font-semibold whitespace-nowrap">SiRapor</span>
    </a>

    <!-- Navigation Menu - Center -->
    <div class="flex-1 hidden md:flex md:w-auto justify-center" id="navbar-default">
      <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white md:dark:bg-gray-900">
        <li>
          <a href="#" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 relative after:absolute after:bottom-0 after:left-3 after:w-0 after:h-0.5 after:bg-blue-700 after:transition-all after:duration-300 md:after:w-0 hover:after:w-8" aria-current="page">Beranda</a>
        </li>
        <li>
          <a href="#fitur" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-white md:dark:hover:bg-transparent transition-all duration-300 hover:scale-105 relative">Fitur</a>
        </li>
        <li>
          <a href="#tentang" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-white md:dark:hover:bg-transparent transition-all duration-300 hover:scale-105 relative">Tentang</a>
        </li>
      </ul>
    </div>

    <!-- Buttons - Right -->
    <div class="hidden md:flex gap-3">
      <form action="{{ route('login') }}" method="GET">
        <button class="text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg px-4 py-2 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5 active:scale-95">Masuk</button>
      </form>
      <form action="#">
        <button class="text-sm font-medium text-white bg-blue-600 rounded-lg px-4 py-2 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5 active:scale-95">Daftar</button>
      </form>
    </div>

    <!-- Mobile menu button - Right -->
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-default" aria-expanded="false">
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
        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4">
          <svg class="w-8 h-8 text-indigo-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M12 2c-.791 0-1.55.314-2.11.874l-.893.893a.985.985 0 0 1-.696.288H7.04A2.984 2.984 0 0 0 4.055 7.04v1.262a.986.986 0 0 1-.288.696l-.893.893a2.984 2.984 0 0 0 0 4.22l.893.893a.985.985 0 0 1 .288.696v1.262a2.984 2.984 0 0 0 2.984 2.984h1.262c.261 0 .512.104.696.288l.893.893a2.984 2.984 0 0 0 4.22 0l.893-.893a.985.985 0 0 1 .696-.288h1.262a2.984 2.984 0 0 0 2.984-2.984V15.7c0-.261.104-.512.288-.696l.893-.893a2.984 2.984 0 0 0 0-4.22l-.893-.893a.985.985 0 0 1-.288-.696V7.04a2.984 2.984 0 0 0-2.984-2.984h-1.262a.985.985 0 0 1-.696-.288l-.893-.893A2.984 2.984 0 0 0 12 2Zm3.683 7.73a1 1 0 1 0-1.414-1.413l-4.253 4.253-1.277-1.277a1 1 0 0 0-1.415 1.414l1.985 1.984a1 1 0 0 0 1.414 0l4.96-4.96Z" clip-rule="evenodd"/>
          </svg>
        </div>
        <h3 class="font-bold text-lg mb-2 text-gray-800">Visi</h3>
        <p class="text-gray-700 text-sm leading-relaxed">Menjadi solusi terdepan dalam digitalisasi sistem penilaian dan pelaporan akademik di lingkungan pendidikan Indonesia, sehingga proses evaluasi menjadi lebih transparan, efisien, dan mudah diakses.</p>
      </div>

      <div class="bg-white rounded-2xl shadow-md p-8 hover:shadow-xl transition-all duration-300 hover:scale-105 hover:-translate-y-1">
        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4">
          <svg class="w-8 h-8 text-emerald-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7.171 12.906-2.153 6.411 2.672-.89 1.568 2.34 1.825-5.183m5.73-2.678 2.154 6.411-2.673-.89-1.568 2.34-1.825-5.183M9.165 4.3c.58.068 1.153-.17 1.515-.628a1.681 1.681 0 0 1 2.64 0 1.68 1.68 0 0 0 1.515.628 1.681 1.681 0 0 1 1.866 1.866c-.068.58.17 1.154.628 1.516a1.681 1.681 0 0 1 0 2.639 1.682 1.682 0 0 0-.628 1.515 1.681 1.681 0 0 1-1.866 1.866 1.681 1.681 0 0 0-1.516.628 1.681 1.681 0 0 1-2.639 0 1.681 1.681 0 0 0-1.515-.628 1.681 1.681 0 0 1-1.867-1.866 1.681 1.681 0 0 0-.627-1.515 1.681 1.681 0 0 1 0-2.64c.458-.361.696-.935.627-1.515A1.681 1.681 0 0 1 9.165 4.3ZM14 9a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/>
          </svg>
        </div>
        <h3 class="font-bold text-lg mb-2 text-gray-800">Misi</h3>
        <p class="text-gray-700 text-sm leading-relaxed">Membantu sekolah dan institusi pendidikan mengelola data siswa, nilai akademik, dan kehadiran secara terpusat. Mendukung guru dalam proses pengajaran dan memberikan kemudahan bagi orang tua dalam memantau perkembangan anak.</p>
      </div>
    </div>

    <div class="mt-12 bg-white rounded-2xl shadow-md p-8">
      <h3 class="font-bold text-xl mb-4 text-center text-gray-800">Kenapa EduReport?</h3>
      <div class="grid md:grid-cols-3 gap-6 text-center">
        <div class="p-4 rounded-xl hover:bg-indigo-50 transition-all duration-300 hover:scale-105 hover:-translate-y-1 cursor-pointer">
          <div class="text-3xl font-bold text-indigo-600 mb-4 flex items-center justify-center">
              <svg class="w-12 h-12 text-lime-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4.5V19a1 1 0 0 0 1 1h15M7 14l4-4 4 4 5-5m0 0h-3.207M20 9v3.207"/>
              </svg>
          </div>
          <p class="text-sm font-medium text-gray-800">Real-time</p>
          <p class="text-xs text-gray-600 mt-1">Data nilai dan kehadiran diperbarui secara langsung</p>
        </div>
        <div class="p-4 rounded-xl hover:bg-green-50 transition-all duration-300 hover:scale-105 hover:-translate-y-1 cursor-pointer">
          <div class="text-3xl font-bold text-indigo-600 mb-4 flex items-center justify-center">
              <svg class="w-12 h-12 text-amber-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M10 5a2 2 0 0 0-2 2v3h2.4A7.48 7.48 0 0 0 8 15.5a7.48 7.48 0 0 0 2.4 5.5H5a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h1V7a4 4 0 1 1 8 0v1.15a7.446 7.446 0 0 0-1.943.685A.999.999 0 0 1 12 8.5V7a2 2 0 0 0-2-2Z" clip-rule="evenodd"/>
                <path fill-rule="evenodd" d="M10 15.5a5.5 5.5 0 1 1 11 0 5.5 5.5 0 0 1-11 0Zm6.5-1.5a1 1 0 1 0-2 0v1.5a1 1 0 0 0 .293.707l1 1a1 1 0 0 0 1.414-1.414l-.707-.707V14Z" clip-rule="evenodd"/>
              </svg>
          </div>
          <p class="text-sm font-medium text-gray-800">Aman</p>
          <p class="text-xs text-gray-600 mt-1">Hak akses berbasis peran menjaga keamanan data</p>
        </div>
        <div class="p-4 rounded-xl hover:bg-orange-50 transition-all duration-300 hover:scale-105 hover:-translate-y-1 cursor-pointer">
          <div class="text-3xl font-bold text-orange-500 mb-1">
            <div class="text-3xl font-bold text-indigo-600 mb-4 flex items-center justify-center">
              <svg class="w-12 h-12 text-rose-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path d="M5 3a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H5Zm14 18a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h4ZM5 11a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2H5Zm14 2a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h4Z"/>
              </svg>
            </div>
          </div>
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