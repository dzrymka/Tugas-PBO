<?php
include 'koneksi.php';
$db = new database();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password1'];

    $result = mysqli_query($conn, "SELECT * FROM user_pengguna WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password1'])) {
            header('Location: tampilan.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Form Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="kontak_login">
        <h3><b>Sistem Informasi Penjualan Barang </b> <br /> Politeknik Negeri Subang</h3>
        <center><img src="gambar/logo_aplikasi.png" width="200" height="200">
        </center>
    </div>
    <div class="kontak_login2">
        <p class="tulisan_login">Silahkan Login</p>
        <form name="form1" method="post" action="proses_barang.php?action=login">
            <label>Username</label>
            <input name="username" type="text" id="username" class="form_login" placeholder="Username" />

            <label>Password</label>
            <input name="password" type="text" id="password" class="form_login" placeholder="Password" />

            <input type="submit" name="Submit" class="tombol_login" value="Login" />&nbsp;
            <input type="reset" name="Reset" class="tombol_reset" value="Reset" />
        </form>
    </div>
    </form>
    </div>
</body>

</html>