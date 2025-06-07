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
<body class="bg-gray-50 min-h-screen flex text-gray-800">

    <!-- Sidebar -->
    <aside class="w-72 bg-gradient-to-b from-white to-teal-50 text-teal-700 h-screen p-6 fixed shadow border-r border-gray-200 flex flex-col justify-between">
        <!-- Admin Info -->
        <div>
            <div class="flex items-center gap-3 mb-8">
                <img src="https://ui-avatars.com/api/?name=Admin&background=ffffff&color=14b8a6&rounded=true"
                     alt="User Avatar"
                     class="w-11 h-11 rounded-full shadow border border-teal-300" />
                <div class="text-[15px] leading-tight">
                    <h2 class="font-semibold text-gray-900">Admin</h2>
                    <p class="text-teal-500 text-sm">admin@sistem.com</p>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex flex-col gap-1 text-[15px] font-medium">
                @php $routeName = Route::currentRouteName(); @endphp

                @php
                    function navLink($route, $label, $icon, $routeName, $activeRoute) {
                        $isActive = $routeName === $activeRoute;
                        return '<a href="' . $route . '" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 transform ' .
                            ($isActive
                                ? 'bg-gradient-to-r from-teal-600 to-cyan-600 text-white font-semibold shadow-md scale-[1.02]'
                                : 'hover:bg-teal-100 text-teal-800 hover:scale-[1.01]') . '">' .
                                '<i class="' . $icon . ' w-5 text-[17px]"></i>' .
                                '<span>' . $label . '</span>' .
                            '</a>';
                    }
                @endphp

                {!! navLink(route('admin.dashboard'), 'Dashboard', 'fas fa-home', $routeName, 'admin.dashboard') !!}
                {!! navLink(route('user.index'), 'User', 'fas fa-users', $routeName, 'user.index') !!}
                {!! navLink(route('kategori.index'), 'Kategori Barang', 'fas fa-boxes', $routeName, 'kategori.index') !!}
                {!! navLink(route('barang.index'), 'Data Barang', 'fas fa-box', $routeName, 'barang.index') !!}
                {!! navLink(route('peminjaman.index'), 'Peminjaman', 'fas fa-exchange-alt', $routeName, 'peminjaman.index') !!}
                {!! navLink(route('pengembalian.index'), 'Pengembalian', 'fas fa-undo', $routeName, 'pengembalian.index') !!}

                <div class="mt-5 mb-2 px-4 text-xs font-semibold uppercase tracking-wider text-teal-500">
                    Laporan
                </div>

                {!! navLink(route('laporan.peminjaman'), 'Laporan Peminjaman', 'fas fa-file-alt', $routeName, 'laporan.peminjaman') !!}
                {!! navLink(route('laporan.pengembalian'), 'Laporan Pengembalian', 'fas fa-file-alt', $routeName, 'laporan.pengembalian') !!}

                {!! navLink('#', 'Settings', 'fas fa-cog', $routeName, 'settings') !!}
            </nav>
        </div>

        <!-- Logout -->
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="w-full py-3 px-4 rounded-lg bg-white border border-teal-500 text-teal-700 font-semibold hover:bg-teal-100 transition-all duration-200 hover:shadow-md hover:scale-[1.01] flex items-center justify-center gap-2 text-[15px]">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </button>
        </form>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-72 p-8">
        <div class="rounded-xl p-8 bg-white shadow border border-gray-200 text-[15px]">
            @yield('content')
        </div>
    </main>

    @stack('scripts')
</body>
</html>
