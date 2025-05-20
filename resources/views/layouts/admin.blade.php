<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-blue-800 text-white h-screen p-6 fixed shadow-lg">
        <h1 class="text-3xl font-bold text-white mb-10">Admin Panel</h1>
        <nav class="flex flex-col space-y-4 text-sm font-medium">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2 rounded hover:bg-blue-700 transition">
                🏠 <span class="ml-2">Dashboard</span>
            </a>
            <a href="{{ route('kategori.index') }}" class="flex items-center px-3 py-2 rounded hover:bg-blue-700 transition">
                📦 <span class="ml-2">Kategori Barang</span>
            </a>
            <a href="{{ route('barang.index') }}" class="flex items-center px-3 py-2 rounded hover:bg-blue-700 transition">
                📋 <span class="ml-2">Data Barang</span>
            </a>
            <a href="{{ route('peminjaman.index') }}" class="flex items-center px-3 py-2 rounded hover:bg-blue-700 transition">
                🔄 <span class="ml-2">Peminjaman</span>
            </a>
             <a href="{{ route('pengembalian.index') }}" class="flex items-center px-3 py-2 rounded hover:bg-blue-700 transition">
                🔄 <span class="ml-2">Peminjaman</span>
            </a>
            <a href="" class="flex items-center px-3 py-2 rounded hover:bg-blue-700 transition">
                ⚙️ <span class="ml-2">Settings</span>
            </a>
        </nav>

        <form method="POST" action="{{ route('admin.logout') }}" class="mt-10">
            @csrf
            <button type="submit"
                class="w-full py-2 px-4 rounded bg-red-500 hover:bg-red-600 text-white font-semibold transition">
                Logout
            </button>
        </form>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 ml-64 p-10 bg-white min-h-screen">
        @yield('content')
    </div>

</body>
</html>
