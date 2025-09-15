<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tambah Barang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex justify-center items-center">
  <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
    <h2 class="text-2xl font-bold text-center text-green-600 mb-6">Tambah Barang</h2>

    <form method="post" class="space-y-4">
      <div>
        <label class="block mb-1 font-semibold">Nama Barang</label>
        <input type="text" name="nama_barang" class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400" required>
      </div>
      <div>
        <label class="block mb-1 font-semibold">Harga</label>
        <input type="number" name="harga" class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400" required>
      </div>
      <div>
        <label class="block mb-1 font-semibold">Stok</label>
        <input type="number" name="stok" class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400" required>
      </div>
      <div class="flex justify-between">
        <a href="index.php" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Kembali</a>
        <button type="submit" name="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Simpan</button>
      </div>
    </form>

    <?php
    if (isset($_POST['submit'])) {
      $nama  = $_POST['nama_barang'];
      $harga = $_POST['harga'];
      $stok  = $_POST['stok'];

      $query = "INSERT INTO barang (nama_barang, harga, stok) VALUES ('$nama','$harga','$stok')";
      mysqli_query($koneksi, $query);
      header("Location: index.php");
    }
    ?>
  </div>
</body>
</html>
