<?php
include('koneksi.php');
$db = new database();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title></title>
    <style type="text/css">
        form#background_border {
            margin: 0px 500px;
            color: black;
        }

        form#print_satuan {
            margin: 0px 250px;
            color: white;
        }

        .posisi_tombol {
            margin: 0px 200px;
        }

        .tombol_login {
            background: #47C0DB;
            color: white;
            font-size: 11pt;
            border: none;
            padding: 5px 20px;
        }
    </style>

</head>

<body>



    <form id="background_border" method="get">
        <input type="text" name="cari" placeholder="Cari Nama Barang">
        <input type="submit" value="Cari">
    </form>
    <a href="tambah_data.php"><button>Tambah Data</button></a>&nbsp;&nbsp;
    <a href="cetak.php" target="_BLANK"><button>PRINT Data BARANG</button></a>
    <?php
    if (isset($_GET['cari'])) {
        $cari = $_GET['cari'];
        echo "<b>Hasil pencarian : " . $cari . "</b>";
    }
    ?>

</body>

</html>

<table border="1">
    <tr>
        <th>No</th>
        <th>Kode</th>
        <th>Barang</th>
        <th>Stock</th>
        <th>Harga Beli</th>
        <th>Harga Jual</th>
        <th>Action</th>
    </tr>
    <?php if (!empty($data_barang)) {
        $no = 1;
        foreach ($data_barang as $row) {
    ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['kd_barang']; ?></td>
                <td><?php echo $row['nama_barang']; ?></td>
                <td><?php echo $row['stok'] ?></td>
                <td><?php echo $row['harga_beli']; ?></td>
                <td><?php echo $row['harga_jual']; ?></td>
                <td>
                    <a href="edit_data.php?id_barang=<?php echo $row['id_barang']; ?>&action=edit">Edit</a>
                    <a href="proses_barang.php?id_barang=<?php echo $row['id_barang']; ?>&action=delete">Hapus</a>
                </td>
            </tr>
    <?php
        }
    } else {
        echo "<tr><td colspan='6'>Tidak ada data barang.</td></tr>";
    }
    ?>
</table>
</body>

</html>