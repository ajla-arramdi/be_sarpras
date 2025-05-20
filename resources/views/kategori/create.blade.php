<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Tambah Kategori</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4 py-10">

  <div class="w-full max-w-2xl bg-white rounded-xl shadow-md p-8">
    <!-- Header -->
    <div class="mb-6 text-center">
      <h1 class="text-2xl font-semibold text-gray-800">Tambah Kategori</h1>
      <p class="text-sm text-gray-500">Isi detail kategori baru.</p>
    </div>

    <!-- Form -->
    <form action="{{ route('kategori.store') }}" method="POST" class="space-y-5">
      @csrf

      <div>
        <label for="nama" class="block text-gray-700 text-sm font-medium mb-1">Nama Kategori</label>
        <input type="text" id="nama" name="nama" required
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" />
      </div>

      <div class="pt-4 flex justify-between items-center">
        <a href="{{ route('kategori.index') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-blue-600 hover:underline transition duration-200">
          <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
          </svg>
          Kembali
        </a>

        <button type="submit"
          class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md text-sm font-medium transition">
          Simpan
        </button>
      </div>
    </form>
  </div>

</body>
</html>
