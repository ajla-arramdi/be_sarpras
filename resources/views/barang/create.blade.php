<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Tambah Barang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4 py-10">

  <div class="w-full max-w-2xl bg-white rounded-xl shadow-md p-8">
    <!-- Header -->
    <div class="mb-6 text-center">
      <h1 class="text-2xl font-semibold text-gray-800">Tambah Barang</h1>
      <p class="text-sm text-gray-500">Isi detail barang baru.</p>
    </div>

    <!-- Form -->
    <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
      @csrf

      <div>
        <label for="nama_barang" class="block text-gray-700 text-sm font-medium mb-1">Nama Barang</label>
        <input type="text" id="nama_barang" name="nama_barang" required
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" />
      </div>

      <div>
        <label for="code" class="block text-gray-700 text-sm font-medium mb-1">Kode Barang</label>
        <input type="text" id="code" name="code" required
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" />
      </div>

      <div>
        <label for="jumlah" class="block text-gray-700 text-sm font-medium mb-1">Jumlah</label>
        <input type="number" id="jumlah" name="jumlah" required min="0"
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" />
      </div>

      <div>
        <label for="kategori_id" class="block text-gray-700 text-sm font-medium mb-1">Kategori</label>
        <select id="kategori_id" name="kategori_id" required
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
          <option value="">-- Pilih Kategori --</option>
          @foreach($kategoris as $kategori)
            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
          @endforeach
        </select>
      </div>

      <!-- Tambahan: Upload Foto -->
      <div>
        <label for="foto" class="block text-gray-700 text-sm font-medium mb-1">Foto (Opsional)</label>
        <input type="file" id="foto" name="foto" accept="image/*"
          class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 bg-white" />
      </div>

      <div class="pt-4 flex justify-between items-center">
        <a href="{{ route('barang.index') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-blue-600 hover:underline transition duration-200">
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
