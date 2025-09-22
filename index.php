<<<<<<< HEAD
<thead class="bg-blue-500 text-white">
  <tr>
    <th class="px-4 py-2 text-left">ID</th>
    <th class="px-4 py-2 text-left">Nama Barang</th>
    <th class="px-4 py-2 text-left">Harga</th>
    <th class="px-4 py-2 text-left">Stok</th>
    <th class="px-4 py-2 text-left">Alamat Supplier</th>
    <th class="px-4 py-2 text-left">No HP Supplier</th>
    <th class="px-4 py-2 text-center">Aksi</th>
  </tr>
</thead>
<tbody>
<?php
$result = mysqli_query($koneksi, "SELECT * FROM barang");
while ($row = mysqli_fetch_assoc($result)) {
  echo "<tr class='border-b hover:bg-gray-50'>
          <td class='px-4 py-2'>{$row['id_barang']}</td>
          <td class='px-4 py-2'>{$row['nama_barang']}</td>
          <td class='px-4 py-2'>Rp " . number_format($row['harga'],0,',','.') . "</td>
          <td class='px-4 py-2'>{$row['stok']}</td>
          <td class='px-4 py-2'>{$row['supplier_alamat']}</td>
          <td class='px-4 py-2'>{$row['supplier_hp']}</td>
          <td class='px-4 py-2 text-center'>
            <a href='ubah.php?id={$row['id_barang']}' class='text-yellow-500 hover:underline mr-3'>✏️ Ubah</a>
            <a href='hapus.php?id={$row['id_barang']}' class='text-red-500 hover:underline'>🗑️ Hapus</a>
          </td>
        </tr>";
}
?>
</tbody>
       
=======
<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col items-center py-10">
    <div class="w-full max-w-6xl bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">📦 Data Barang & Supplier</h2>
        
        <div class="mb-4 text-right">
            <a href="tambah.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ Tambah Barang</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-200 shadow-sm rounded-lg overflow-hidden">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Nama Barang</th>
                        <th class="px-4 py-2 text-left">Harga</th>
                        <th class="px-4 py-2 text-left">Stok</th>
                        <th class="px-4 py-2 text-left">Alamat Supplier</th>
                        <th class="px-4 py-2 text-left">No HP Supplier</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($koneksi, "SELECT * FROM barang");
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Handle null values for new fields
                        $alamat_supplier = isset($row['alamat_supplier']) ? $row['alamat_supplier'] : '-';
                        $no_hp_supplier = isset($row['no_hp_supplier']) ? $row['no_hp_supplier'] : '-';
                        
                        echo "<tr class='border-b hover:bg-gray-50'>
                            <td class='px-4 py-2'>{$row['id_barang']}</td>
                            <td class='px-4 py-2'>{$row['nama_barang']}</td>
                            <td class='px-4 py-2'>Rp " . number_format($row['harga'],0,',','.') . "</td>
                            <td class='px-4 py-2'>{$row['stok']}</td>
                            <td class='px-4 py-2 max-w-xs truncate' title='{$alamat_supplier}'>{$alamat_supplier}</td>
                            <td class='px-4 py-2'>{$no_hp_supplier}</td>
                            <td class='px-4 py-2 text-center'>
                                <a href='ubah.php?id={$row['id_barang']}' class='text-yellow-500 hover:underline mr-3'>Ubah</a>
                                <a href='hapus.php?id={$row['id_barang']}' class='text-red-500 hover:underline' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
>>>>>>> 82cc10f0fb93b8047af80a0a070cc4c7905801a0
