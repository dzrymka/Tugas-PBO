<?php
include('koneksi.php');
$koneksi = new database();

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == "add") {
    $kd_barang = $_POST['kd_barang'];
    $nama_barang = $_POST['nama_barang'];
    $stok = $_POST['stok'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];

    // Perlu menyertakan $_FILES['gambar_produk'] jika digunakan untuk upload gambar
    $gambar_produk = isset($_FILES['gambar_produk']) ? $_FILES['gambar_produk']['name'] : '';

    $koneksi->tambah_data('', $kd_barang, $nama_barang, $stok, $harga_beli, $harga_jual, $gambar_produk);
    header('location:tampilan.php');
} elseif ($action == "edit") {
    $id_barang = $_GET['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $stok = $_POST['stok'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];

    $koneksi->edit_data($id_barang, $nama_barang, $stok, $harga_beli, $harga_jual);
    header('location:index.php');
} elseif ($action == "delete") {
    $id_barang = $_GET['id_barang'];
    $koneksi->delete_data($id_barang);
    header('location:index.php');
}
