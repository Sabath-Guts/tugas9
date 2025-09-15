<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Ubah Barang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex justify-center items-center">
  <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
    <h2 class="text-2xl font-bold text-center text-yellow-600 mb-6">Ubah Barang</h2>
    <?php
    $id = $_GET['id'];
    $result = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang=$id");
    $row = mysqli_fetch_assoc($result);
    ?>
    <form method="post" class="space-y-4">
      <input type="hidden" name="id_barang" value="<?php echo $row['id_barang']; ?>">
      <div>
        <label class="block mb-1 font-semibold">Nama Barang</label>
        <input type="text" name="nama_barang" value="<?php echo $row['nama_barang']; ?>" class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400">
      </div>
      <div>
        <label class="block mb-1 font-semibold">Harga</label>
        <input type="number" name="harga" value="<?php echo $row['harga']; ?>" class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400">
      </div>
      <div>
        <label class="block mb-1 font-semibold">Stok</label>
        <input type="number" name="stok" value="<?php echo $row['stok']; ?>" class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400">
      </div>
      <div class="flex justify-between">
        <a href="index.php" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Kembali</a>
        <button type="submit" name="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Update</button>
      </div>
    </form>

    <?php
    if (isset($_POST['submit'])) {
      $id    = $_POST['id_barang'];
      $nama  = $_POST['nama_barang'];
      $harga = $_POST['harga'];
      $stok  = $_POST['stok'];

      $query = "UPDATE barang SET nama_barang='$nama', harga='$harga', stok='$stok' WHERE id_barang=$id";
      mysqli_query($koneksi, $query);
      header("Location: index.php");
    }
    ?>
  </div>
</body>
</html>
