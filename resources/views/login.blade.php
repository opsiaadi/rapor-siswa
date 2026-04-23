<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EduReport</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        function toggleTheme() {
            const html = document.documentElement;
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                html.classList.add('dark');
                localStorage.theme = 'dark';
            }
        }
    </script>
</head>
<body class="min-h-screen flex items-center justify-center p-4" style="background: url('{{ asset('images/backgrounds/yurt9.jpg') }}') center/cover no-repeat;">

    <!-- Dark Overlay -->
    <div class="fixed top-0 left-0 w-full h-full -z-10 bg-black/40"></div>

    <!-- Login Container -->
    <div class="w-full max-w-sm mx-4">
        <div class="mb-5">
        <!-- Brand Header -->
            <div class="flex flex-col items-center gap-2.5">
                <div class="w-14 h-14 bg-gradient-to-br from-blue-600 to-emerald-600 rounded-2xl shadow-xl shadow-blue-500/20 flex items-center justify-center">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h1 class="text-xl font-extrabold tracking-[0.15em] text-white">RAPOR SISWA</h1>
                <p class="text-gray-200 text-[11px] tracking-wide uppercase opacity-80">Sistem Informasi Akademik Terpadu</p>
            </div>
        </div>

        <!-- Login Card -->
        <div class="bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm rounded-2xl shadow-2xl p-6">
            <div class="flex flex-col items-center gap-2.5">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Selamat Datang</h2>
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-2">Silahkan masuk untuk mengakses portal Anda.</p>
            </div>

            <!-- Form -->
            <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                @csrf

                <!-- NIK -->
                <div class="space-y-1.5">
                    <label class="block text-[11px] font-bold uppercase tracking-widest text-gray-600 dark:text-gray-300 ml-1">NIK</label>
                    <input type="text" name="nik" value="{{ old('nik') }}" class="block w-full px-3.5 py-3 bg-gray-50 dark:bg-gray-800 border-2 border-transparent focus:border-blue-600 focus:ring-0 rounded-xl text-sm text-gray-900 dark:text-white transition-all duration-200 placeholder:text-gray-400" placeholder="Masukkan NIK Anda" required>
                    @error('nik')
                        <p class="text-red-500 text-[10px] mt-0.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="space-y-1.5">
                    <div class="flex justify-between items-center px-1">
                        <label class="block text-[11px] font-bold uppercase tracking-widest text-gray-600 dark:text-gray-300">Kata Sandi</label>
                        <a href="#" class="text-[11px] font-bold text-blue-600 dark:text-blue-400 hover:underline">Lupa?</a>
                    </div>
                    <input type="password" name="password" class="block w-full px-3.5 py-3 bg-gray-50 dark:bg-gray-800 border-2 border-transparent focus:border-blue-600 focus:ring-0 rounded-xl text-sm text-gray-900 dark:text-white transition-all duration-200 placeholder:text-gray-400" placeholder="••••••••" required>
                    @error('password')
                        <p class="text-red-500 text-[10px] mt-0.5">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role Select -->
                <div class="space-y-1.5">
                    <label class="block text-[11px] font-bold uppercase tracking-widest text-gray-600 dark:text-gray-300 ml-1">Role Akun</label>
                    <select name="role" class="block w-full px-3.5 py-3 bg-gray-50 dark:bg-gray-800 border-2 border-transparent focus:border-blue-600 focus:ring-0 rounded-xl text-sm text-gray-900 dark:text-white transition-all duration-200 appearance-none">
                        <option value="admin">Admin TU</option>
                        <option value="guru">Guru Pengampu</option>
                        <option value="walikelas">Wali Kelas</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3 bg-gradient-to-r from-blue-600 to-emerald-600 text-white font-bold rounded-xl shadow-lg shadow-blue-500/20 hover:shadow-blue-500/40 transform active:scale-95 transition-all duration-200 uppercase tracking-[0.1em] text-sm mt-4">
                    MASUK
                </button>
            </form>
        </div>

        <!-- Copyright -->
        <p class="mt-4 text-center text-[10px] text-gray-200 font-medium tracking-widest">
            © 2025 EduReport
        </p>
    </div>
</body>
</html>
