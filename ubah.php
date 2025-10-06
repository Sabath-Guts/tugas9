<?php 
session_start();
include 'koneksi.php'; 
include 'auth_check.php';

// Only admin can access this page
if (!isAdmin()) {
    echo "<script>alert('Access Denied! Only admin can edit data.'); window.location.href='index.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Ubah Barang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex justify-center items-center py-10">
  <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
    <h2 class="text-2xl font-bold text-center text-yellow-600 mb-6">Ubah Barang</h2>
    <?php
    $id = $_GET['id'];
    $result = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang=$id");
    $row = mysqli_fetch_assoc($result);
    
    if (!$row) {
        echo "<script>alert('Data tidak ditemukan!'); window.location.href='index.php';</script>";
        exit;
    }
    ?>
    <form method="post" class="space-y-4">
      <input type="hidden" name="id_barang" value="<?php echo $row['id_barang']; ?>">
      <div>
        <label class="block mb-1 font-semibold">Nama Barang</label>
        <input type="text" name="nama_barang" value="<?php echo htmlspecialchars($row['nama_barang']); ?>" class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400" required>
      </div>
      <div>
        <label class="block mb-1 font-semibold">Harga</label>
        <input type="number" name="harga" value="<?php echo $row['harga']; ?>" class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400" required>
      </div>
      <div>
        <label class="block mb-1 font-semibold">Stok</label>
        <input type="number" name="stok" value="<?php echo $row['stok']; ?>" class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400" required>
      </div>
      <div>
        <label class="block mb-1 font-semibold">Alamat Supplier</label>
        <textarea name="alamat_supplier" rows="3" class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400" placeholder="Masukkan alamat lengkap supplier"><?php echo isset($row['alamat_supplier']) ? htmlspecialchars($row['alamat_supplier']) : ''; ?></textarea>
      </div>
      <div>
        <label class="block mb-1 font-semibold">No HP Supplier</label>
        <input type="tel" name="no_hp_supplier" value="<?php echo isset($row['no_hp_supplier']) ? htmlspecialchars($row['no_hp_supplier']) : ''; ?>" class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400" placeholder="Contoh: 08123456789">
      </div>
      <div class="flex justify-between pt-4">
        <a href="index.php" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Kembali</a>
        <button type="submit" name="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Update</button>
      </div>
    </form>

    <?php
    if (isset($_POST['submit'])) {
      $id = mysqli_real_escape_string($koneksi, $_POST['id_barang']);
      $nama = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
      $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);
      $stok = mysqli_real_escape_string($koneksi, $_POST['stok']);
      $alamat_supplier = mysqli_real_escape_string($koneksi, $_POST['alamat_supplier']);
      $no_hp_supplier = mysqli_real_escape_string($koneksi, $_POST['no_hp_supplier']);

      $query = "UPDATE barang SET nama_barang='$nama', harga='$harga', stok='$stok', alamat_supplier='$alamat_supplier', no_hp_supplier='$no_hp_supplier' WHERE id_barang=$id";
      
      if (mysqli_query($koneksi, $query)) {
          echo "<script>alert('Data berhasil diupdate!'); window.location.href='index.php';</script>";
      } else {
          echo "<script>alert('Error: " . mysqli_error($koneksi) . "');</script>";
      }
    }
    ?>
  </div>
</body>
</html>