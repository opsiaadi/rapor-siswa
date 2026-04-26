@extends('layouts.app')

@section('title', $title ?? 'Dashboard Guru - Sistem Pengolahan Rapor Siswa')

@section('content')
<!-- Mobile Header -->
@include('components.mobile-header-guru')

<!-- Sidebar Overlay (Mobile) -->
<div id="sidebarOverlay" class="hidden fixed inset-0 bg-black/50 z-40 lg:hidden" onclick="toggleSidebar()"></div>

<div class="flex">
    <!-- Sidebar -->
    @include('components.sidebar-guru')
    
    <!-- Main Content Wrapper -->
    <div class="flex-1 lg:ml-64 flex flex-col min-h-screen">
        <!-- Desktop Navbar -->
        @include('components.navbar-guru')
        
        <!-- Page Content -->
        <main class="flex-1 p-4 lg:p-6">
            @yield('page-content')
        </main>
        
        <!-- Footer -->
        @include('components.footer')
    </div>
</div>
@endsection
