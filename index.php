<?php 
session_start();
include 'koneksi.php'; 
include 'auth_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col items-center py-10">
    <div class="w-full max-w-6xl bg-white shadow-lg rounded-lg p-6">
        <!-- Header with User Info -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-blue-600">📦 Data Barang & Supplier</h2>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-sm text-gray-600">Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></p>
                    <p class="text-xs text-gray-500">
                        Role: <span class="px-2 py-1 rounded <?php echo isAdmin() ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700'; ?>">
                            <?php echo strtoupper($_SESSION['role']); ?>
                        </span>
                    </p>
                </div>
                <a href="logout.php" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Logout</a>
            </div>
        </div>
        
        <?php if (isAdmin()): ?>
        <div class="mb-4 text-right">
            <a href="tambah.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ Tambah Barang</a>
        </div>
        <?php endif; ?>

        <?php
        // Cek apakah tabel dan kolom ada
        $check_table = mysqli_query($koneksi, "SHOW TABLES LIKE 'barang'");
        if (mysqli_num_rows($check_table) == 0) {
            echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4'>";
            echo "Error: Tabel 'barang' tidak ditemukan. Silakan buat tabel terlebih dahulu.";
            echo "</div>";
            exit;
        }

        // Cek struktur kolom
        $check_columns = mysqli_query($koneksi, "SHOW COLUMNS FROM barang");
        $columns = [];
        while ($col = mysqli_fetch_assoc($check_columns)) {
            $columns[] = $col['Field'];
        }

        // Periksa apakah kolom baru ada
        $has_alamat = in_array('alamat_supplier', $columns);
        $has_hp = in_array('no_hp_supplier', $columns);
        
        if (!$has_alamat || !$has_hp) {
            echo "<div class='bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4'>";
            echo "Peringatan: Kolom alamat_supplier atau no_hp_supplier belum ada. Silakan jalankan ALTER TABLE terlebih dahulu.";
            echo "</div>";
        }
        ?>

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-200 shadow-sm rounded-lg overflow-hidden">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Nama Barang</th>
                        <th class="px-4 py-2 text-left">Harga</th>
                        <th class="px-4 py-2 text-left">Stok</th>
                        <?php if ($has_alamat): ?>
                        <th class="px-4 py-2 text-left">Alamat Supplier</th>
                        <?php endif; ?>
                        <?php if ($has_hp): ?>
                        <th class="px-4 py-2 text-left">No HP Supplier</th>
                        <?php endif; ?>
                        <?php if (isAdmin()): ?>
                        <th class="px-4 py-2 text-center">Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($koneksi, "SELECT * FROM barang");
                    
                    if (!$result) {
                        echo "<tr><td colspan='7' class='text-center py-4 text-red-500'>Error: " . mysqli_error($koneksi) . "</td></tr>";
                    } elseif (mysqli_num_rows($result) == 0) {
                        echo "<tr><td colspan='7' class='text-center py-4 text-gray-500'>Belum ada data barang</td></tr>";
                    } else {
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Handle kolom baru yang mungkin belum ada
                            $alamat_supplier = ($has_alamat && isset($row['alamat_supplier'])) ? $row['alamat_supplier'] : '-';
                            $no_hp_supplier = ($has_hp && isset($row['no_hp_supplier'])) ? $row['no_hp_supplier'] : '-';
                            
                            echo "<tr class='border-b hover:bg-gray-50'>";
                            echo "<td class='px-4 py-2'>{$row['id_barang']}</td>";
                            echo "<td class='px-4 py-2'>" . htmlspecialchars($row['nama_barang']) . "</td>";
                            echo "<td class='px-4 py-2'>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
                            echo "<td class='px-4 py-2'>{$row['stok']}</td>";
                            if ($has_alamat) {
                                echo "<td class='px-4 py-2 max-w-xs truncate' title='" . htmlspecialchars($alamat_supplier) . "'>" . htmlspecialchars($alamat_supplier) . "</td>";
                            }
                            if ($has_hp) {
                                echo "<td class='px-4 py-2'>" . htmlspecialchars($no_hp_supplier) . "</td>";
                            }
                            
                            if (isAdmin()) {
                                echo "<td class='px-4 py-2 text-center'>";
                                echo "<a href='ubah.php?id={$row['id_barang']}' class='text-yellow-500 hover:underline mr-3'>Ubah</a>";
                                echo "<a href='hapus.php?id={$row['id_barang']}' class='text-red-500 hover:underline' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>";
                                echo "</td>";
                            }
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
        <div class="mt-4 text-sm text-gray-600">
            <p>Total data: <?php echo mysqli_num_rows($result); ?> barang</p>
            <?php if (isUser()): ?>
            <p class="text-yellow-600 mt-2">ℹ️ Anda login sebagai User (hanya dapat melihat data)</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>