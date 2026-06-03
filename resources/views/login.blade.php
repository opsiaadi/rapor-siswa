<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SiRapor</title>
    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen flex items-center justify-center p-4" style="background: url('{{ asset('images/backgrounds/yurt9.jpg') }}') center/cover no-repeat;">
    <div class="fixed top-0 left-0 w-full h-full bg-black/40"></div>
    
    <!-- Login Container -->
    <div class="w-full max-w-sm mx-4">
        <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl p-6 transition-all duration-300 hover:shadow-3xl hover:-translate-y-1">
            <!-- Header -->
            <div class="flex flex-col items-center gap-3 mb-6">
                <div class="w-20 h-16 rounded-2xl shadow-xl shadow-white flex items-center justify-center cursor-pointer transition-transform duration-300 hover:scale-110">
                    <img src="{{ asset('/images/open-book.png')}}" alt="">
                </div>
                <h1 class="text-3xl font-extrabold text-gray-900">SiRapor</h1>
                <p class="text-gray-500 text-[11px] tracking-wide uppercase">Sistem Pengolahan Rapor Siswa</p>
            </div>

            <!-- Form Login -->
            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                <div class="space-y-1.5">
                    <label class="block text-[11px] font-bold uppercase tracking-widest text-gray-600 ml-1">NIK / Email</label>
                    <input type="text" name="nik" value="{{ old('nik') }}" 
                        class="block w-full px-3.5 py-3 bg-gray-50 border-2 border-gray-300 rounded-xl text-sm text-gray-900 placeholder:text-gray-400 transition-all duration-300 hover:bg-white hover:border-blue-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-200"
                        placeholder="Masukkan NIK atau Email"
                        required>
                </div>
                
                <div class="space-y-1.5">
                    <label class="block text-[11px] font-bold uppercase tracking-widest text-gray-600 ml-1">Kata Sandi</label>
                    <input type="password" name="password" 
                        class="block w-full px-3.5 py-3 bg-gray-50 border-2 border-gray-300 rounded-xl text-sm text-gray-900 placeholder:text-gray-400 transition-all duration-300 hover:bg-white hover:border-blue-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-200"
                        placeholder="Masukkan kata sandi"
                        required>
                </div>
                
                <div class="space-y-1.5">
                    <label class="block text-[11px] font-bold uppercase tracking-widest text-gray-600 ml-1">Role Akun</label>
                    <select name="role" id="roleSelect" 
                            class="block w-full px-3.5 py-3 bg-gray-50 border-2 border-gray-300 rounded-xl text-sm text-gray-900 appearance-none cursor-pointer transition-all duration-300 hover:bg-white hover:border-blue-400 hover:shadow-md focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-200"
                            required>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin TU</option>
                        <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru Pengampu</option>
                        <option value="walikelas" {{ old('role') == 'walikelas' ? 'selected' : '' }}>Wali Kelas</option>
                    </select>
                </div>
                
<button type="submit" 
                        class="w-full py-3 bg-emerald-600 text-white font-bold rounded-xl shadow-lg shadow-emerald-500/30 uppercase tracking-[0.1em] text-sm mt-4">
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