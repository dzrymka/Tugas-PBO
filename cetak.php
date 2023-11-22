<?php
include("koneksi.php");
$db = new database();
?>
<!DOCTYPE html>
<html>

<head>
    <tittle>Print Data Barang</tittle>
    <style type="text/css">
        form#background_border {
            margin: 0px 230;
            color: white;
        }
    </style>
</head>

<body>
    <a href="tampilan.php">Tampilan Transaksi</a></br>
    <h2>Laporan Data Barang CV JAYA</h2>
    <table width="667" border="1">
        <tr>
            <th width="21">No</th>
            <th width="122">Kode Barang</th>
            <th width="158">Barang</th>
            <th width="47">Stok</th>
            <th width="76">Harga Beli </th>
            <th width="83">Harga Jual</th>
            <th width="114">Keuntungan</th>
        </tr>

        <?php
        $data_barang = $db->tampil_data();
        $no = 1;
        foreach ($data_barang as $row) {
        ?>
            <tr>
                <td><?php echo $no++; ?></th>
                <td><?php echo $row['kd_barang']; ?></td>
                <td><?php echo $row['nama_barang']; ?></td>
                <td><?php echo $row['stok']; ?></td>
                <td><?php echo $row['harga_beli']; ?></td>
                <td><?php echo $row['harga_jual']; ?></td>
                <td><?php echo ($row['harga_jual'] - $row['harga_beli']); ?></td>
            </tr>
        <?php
        }    ?>

    </table>
    <script>
        window.print();
    </script>
</body>

</html>