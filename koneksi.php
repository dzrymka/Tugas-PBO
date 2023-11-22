<?php
class database
{
    var $host = "localhost";
    var $username = "root";
    var $password = "";
    var $database = "belajar_oop";
    var $koneksi = "";

    function __construct()
    {
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (mysqli_connect_error()) {
            die("Koneksi database gagal: " . mysqli_connect_error());
        }
    }

    function tampil_data()
    {
        $data = mysqli_query($this->koneksi, "select * from tb_barang");
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    function tambah_data($kd_barang, $nama_barang, $stok, $harga_beli, $harga_jual, $gambar_produk)
    {
        //cek dulu jika ada gambar produk jalankan coding ini
        if ($gambar_produk != "") {
            $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg'); //ekstensi file gabar yang bisa diupload
            $x = explode('.', $gambar_produk); //memisahkan nama file dengan ekstensi yang diupload
            $ekstensi = strtolower(end($x));
            $file_tmp = $_FILES['gambar_produk']['tmp_name'];
            $angka_acak = rand(1, 999);
            $nama_gambar_baru = $angka_acak . '-' . $gambar_produk; // menggabungkan angka dengan nama file sebenarnya
            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                move_uploaded_file($file_tmp, 'gambar/' . $nama_gambar_baru); //memindah file gambar ke folder gambar
                // jalankan query untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
                $query = "INSERT INTO tb_barang (id_barang,kd_barang,nama_barang,stok,harga_beli,harga_jual,gambar_produk) VALUE ('','$kd_barang','$nama_barang','$stok','$harga_beli','$harga_jual','$nama_gambar_baru')";
                $result = mysqli_query($this->koneksi, $query);
                // periska query apakah error
                if (!$result) {
                    die("Query gagal dijalankan: " . mysqli_errno($this->koneksi) . " - " . mysqli_error($this->koneksi));
                } else {
                    //tampilan alert dan akan redirect ke halaman index.php
                    //silahkan ganti index.php sesuai halaman yang akan disetujui
                    echo "<script>alert('Data berhasil ditambah.');window.location='tampilan.php';</script>";
                }
            } else {
                //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                echo "<script>alert('Ekstensi gambar yang boleh hanya jpg, jpeg atau png.');window.location='tambah_data.php';</script>";
            }
        } else {
            //jika ada gambar maka akan menjalankan codingan
            $query = "INSERT INTO tb_barang (id_barang,kd_barang,nama_barang,stok,harga_beli,harga_jual,gambar_produk) VALUE ('','$kd_barang','$nama_barang','$stok','$harga_beli','$harga_jual',null)";
            $result = mysqli_query($this->koneksi, $query);
            // periksa query apakah ada error
            if (!$result) {
                die("Query gagal dijalankan: " . mysqli_errno($this->koneksi) . "-" . mysqli_error($this->koneksi));
            } else {
                //tampilkan alert dan akan redirect ke halaman index.php
                //silahkan ganti index.php sesuai halaman yang akan dituju
                echo "<script>alert('Data berhasil diupdate.');window.location='tampilan.php';</script>";
            }
        }
        mysqli_query($this->koneksi, "insert into tb_barang values ('$kd_barang','$nama_barang','$stok','$harga_beli','$harga_jual')");
    }

    function tampil_edit_data($id_barang)
    {
        $data = mysqli_query($this->koneksi, "select * from tb_barang where id_barang='$id_barang'");
        while ($d = mysqli_fetch_array($data)) {
            $hasil[] = $d;
        }
        return $hasil;
    }

    function edit_data($id_barang, $nama_barang, $stok, $harga_beli, $harga_jual, $gambar_produk)
    {
        //jalankan apabila terdapat gambar edit yang di upload
        if ($gambar_produk != "") {
        }
        mysqli_query($this->koneksi, "update tb_barang set nama_barang = '$nama_barang', stok='$stok', harga_beli='$harga_beli', harga_jual='$harga_jual' where id_barang='$id_barang'");
    }

    function delete_data($id_barang)
    {
        mysqli_query($this->koneksi, "delete from tb_barang where id_barang='$id_barang'");
    }

    function kode_barang()
    {
        $data = mysqli_query($this->koneksi, "SELECT MAX(kd_barang) as kd_barang FROM tb_barang");
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = $row;
        }
        return $hasil;
    }
}
