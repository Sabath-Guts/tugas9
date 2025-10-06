<?php
session_start();
include 'koneksi.php';
include 'auth_check.php';

// Only admin can delete
if (!isAdmin()) {
    echo "<script>alert('Access Denied! Only admin can delete data.'); window.location.href='index.php';</script>";
    exit;
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // Check if record exists
    $check = mysqli_query($koneksi, "SELECT id_barang FROM barang WHERE id_barang=$id");
    
    if (mysqli_num_rows($check) > 0) {
        $result = mysqli_query($koneksi, "DELETE FROM barang WHERE id_barang=$id");
        
        if ($result) {
            echo "<script>alert('Data berhasil dihapus!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($koneksi) . "'); window.location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('Data tidak ditemukan!'); window.location.href='index.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak valid!'); window.location.href='index.php';</script>";
}
?>