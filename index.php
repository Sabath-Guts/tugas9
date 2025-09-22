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
       
