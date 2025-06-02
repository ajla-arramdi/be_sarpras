<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Admin Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-72 bg-gradient-to-b from-red-800 to-red-900 text-white h-screen p-6 fixed shadow-xl flex flex-col justify-between">
        <!-- Admin Info -->
        <div>
            <div class="flex items-center space-x-4 mb-10">
                <img src="https://ui-avatars.com/api/?name=Admin&background=ffffff&color=dc2626&rounded=true" alt="User Avatar" class="w-12 h-12 rounded-full shadow-md" />
                <div>
                    <h2 class="text-lg font-semibold">Admin</h2>
                    <p class="text-red-200 text-xs">admin@sistem.com</p>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex flex-col gap-2 text-sm font-medium">
                @php $routeName = Route::currentRouteName(); @endphp

                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3.5 rounded-lg {{ $routeName == 'admin.dashboard' ? 'bg-white text-red-700 font-semibold' : 'hover:bg-red-700/60' }} transition-all">
                    <i class="fas fa-home text-base w-6"></i>
                    <span class="ml-3">Dashboard</span>
                </a>

                <a href="{{ route('user.index') }}" class="flex items-center px-4 py-3.5 rounded-lg {{ $routeName == 'user.index' ? 'bg-white text-red-700 font-semibold' : 'hover:bg-red-700/60' }} transition-all">
                    <i class="fas fa-users text-base w-6"></i>
                    <span class="ml-3">User</span>
                </a>

                <a href="{{ route('kategori.index') }}" class="flex items-center px-4 py-3.5 rounded-lg {{ $routeName == 'kategori.index' ? 'bg-white text-red-700 font-semibold' : 'hover:bg-red-700/60' }} transition-all">
                    <i class="fas fa-boxes text-base w-6"></i>
                    <span class="ml-3">Kategori Barang</span>
                </a>

                <a href="{{ route('barang.index') }}" class="flex items-center px-4 py-3.5 rounded-lg {{ $routeName == 'barang.index' ? 'bg-white text-red-700 font-semibold' : 'hover:bg-red-700/60' }} transition-all">
                    <i class="fas fa-box text-base w-6"></i>
                    <span class="ml-3">Data Barang</span>
                </a>

                <a href="{{ route('peminjaman.index') }}" class="flex items-center px-4 py-3.5 rounded-lg {{ $routeName == 'peminjaman.index' ? 'bg-white text-red-700 font-semibold' : 'hover:bg-red-700/60' }} transition-all">
                    <i class="fas fa-exchange-alt text-base w-6"></i>
                    <span class="ml-3">Peminjaman</span>
                </a>

                <a href="{{ route('pengembalian.index') }}" class="flex items-center px-4 py-3.5 rounded-lg {{ $routeName == 'pengembalian.index' ? 'bg-white text-red-700 font-semibold' : 'hover:bg-red-700/60' }} transition-all">
                    <i class="fas fa-undo text-base w-6"></i>
                    <span class="ml-3">Pengembalian</span>
                </a>

                <!-- Laporan Menu -->
                <div class="mt-2">
                    <div class="px-4 py-2 text-xs font-semibold text-red-200 uppercase tracking-wider">
                        Laporan
                    </div>
                    <a href="{{ route('laporan.peminjaman') }}" class="flex items-center px-4 py-3.5 rounded-lg {{ $routeName == 'laporan.peminjaman' ? 'bg-white text-red-700 font-semibold' : 'hover:bg-red-700/60' }} transition-all">
                        <i class="fas fa-file-alt text-base w-6"></i>
                        <span class="ml-3">Laporan Peminjaman</span>
                    </a>
                    <a href="{{ route('laporan.pengembalian') }}" class="flex items-center px-4 py-3.5 rounded-lg {{ $routeName == 'laporan.pengembalian' ? 'bg-white text-red-700 font-semibold' : 'hover:bg-red-700/60' }} transition-all">
                        <i class="fas fa-file-alt text-base w-6"></i>
                        <span class="ml-3">Laporan Pengembalian</span>
                    </a>
                </div>

                <a href="#" class="flex items-center px-4 py-3.5 rounded-lg hover:bg-red-700/60 transition-all">
                    <i class="fas fa-cog text-base w-6"></i>
                    <span class="ml-3">Settings</span>
                </a>
            </nav>
        </div>

        <!-- Logout -->
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="w-full py-3 px-4 rounded-lg bg-red-600 hover:bg-red-700 text-white font-semibold transition-all flex items-center justify-center space-x-2 shadow-md hover:shadow-xl">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </button>
        </form>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-72 p-8">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            @yield('content')
        </div>
    </main>

    <!-- Scripts -->
    @stack('scripts')
</body>
</html>
