<!DOCTYPE html>
<html>

<head>
    <title>Hasil Pencarian</title>
</head>

<body>
    <?php
    if (isset($_GET['search_result'])) {
        $search_result = json_decode(urldecode($_GET['search_result']), true);
        echo "<h1>Hasil Pencarian</h1>";
        if (count($search_result) > 0) {
            echo "<table border='1'>
                <tr>
                    <th>NO</th>
                    <th>Barang</th>
                    <th>Stok</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                </tr>";
            $no = 1;
            foreach ($search_result as $row) {
                echo "<tr>
                    <td>{$no}</td>
                    <td>" . htmlspecialchars($row['nama_barang']) . "</td>
                    <td>{$row['stok']}</td>
                    <td>{$row['harga_beli']}</td>
                    <td>{$row['harga_jual']}</td>
                </tr>";
                $no++;
            }
            echo "</table>";
        } else {
            echo "Tidak ada hasil yang ditemukan.";
        }
    }
    ?>
</body>

</html>