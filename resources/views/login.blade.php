<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SiRapor</title>
    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen flex items-center justify-center p-4" style="background: url('{{ asset('images/backgrounds/yurt9.jpg') }}') center/cover no-repeat;">
    <div class="fixed top-0 left-0 w-full h-full -z-10 bg-black/40"></div>
    <!-- Login Container -->
    <div class="w-full max-w-sm mx-4">
        <div class="bg-white/95  backdrop-blur-sm rounded-2xl shadow-2xl p-6">
            <!-- Header -->
            <div class="flex flex-col items-center gap-3 mb-6">
                <div class="w-20 h-16 rounded-2xl shadow-xl shadow-white flex items-center justify-center">
                    <img src="{{ asset('/images/open-book.png')}}" alt="">
                </div>
                <h1 class="text-3xl font-extrabold text-gray-900 ">SiRapor</h1>
                <p class="text-gray-500  text-[11px] tracking-wide uppercase">Sistem Pengolahan Rapor Siswa</p>
            </div>

            <!-- Form Login -->
            <form action="{{ route('login') }}" method="GET" class="space-y-4">
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                <div class="space-y-1.5">
                    <label class="block text-[11px] font-bold uppercase tracking-widest text-gray-600  ml-1">NIK</label>
                    <input type="text" name="nik" value="{{ old('nik') }}" class="block w-full px-3.5 py-3 bg-gray-50  border-2 border-gray-300 focus:border-blue-600 focus:ring-0 rounded-xl text-sm text-gray-900  placeholder:text-gray-400">
                </div>
                <div class="space-y-1.5">
                    <div class="flex justify-between items-center px-1">
                        <label class="block text-[11px] font-bold uppercase tracking-widest text-gray-600 ">Kata Sandi</label>
                    </div>
                    <input type="password" name="password" class="block w-full px-3.5 py-3 bg-gray-50  border-2 border-gray-300 focus:border-blue-600 focus:ring-0 rounded-xl text-sm text-gray-900  placeholder:text-gray-400" required>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-[11px] font-bold uppercase tracking-widest text-gray-600  ml-1">Role Akun</label>
                    <select name="role" id="roleSelect" class="block w-full px-3.5 py-3 bg-gray-50  border-0 focus:border-blue-600 focus:ring-0 rounded-xl text-sm text-gray-900  appearance-none" required>
                        <option value="admin">Admin TU</option>
                        <option value="guru">Guru Pengampu</option>
                        <option value="walikelas">Wali Kelas</option>
                    </select>
                </div>
                <button type="submit" class="w-full py-3 bg-gradient-to-r from-blue-600 to-emerald-600 text-white font-bold rounded-xl shadow-lg shadow-blue-500/20 hover:shadow-blue-500/40 transform active:scale-95 transition-all duration-200 uppercase tracking-[0.1em] text-sm mt-4">
                    MASUK
                </button>
            </form>
        </div>

        <!-- Copyright -->
        <p class="mt-4 text-center text-[10px] text-gray-200 font-medium tracking-widest">
            © 2025 SiRapor
        </p>
    </div>
</body>
</html>
