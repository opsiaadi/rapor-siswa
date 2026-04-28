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
        <!-- Login Card -->
        <div class="bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm rounded-2xl shadow-2xl p-6">
            <!-- Brand Header (Inside Card) -->
            <div class="flex flex-col items-center gap-3 mb-6">
                <div class="w-20 h-16 rounded-2xl shadow-xl shadow-white flex items-center justify-center">
                    <!-- <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"> --> 
                        <img src="{{ asset('/images/open-book.png')}}" alt="">
                    <!-- </svg> --> 
                </div>
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white">EduReport</h1>
                <p class="text-gray-500 dark:text-gray-400 text-[11px] tracking-wide uppercase">Sistem Informasi Akademik Terpadu</p>
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
