<?php

include "connect.php";

$nama = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : "";
$username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : "";
$password = (isset($_POST['password'])) ? md5(htmlentities($_POST['password']))  : "";
$level = (isset($_POST['level'])) ? htmlentities($_POST['level']) : "";
$telp = (isset($_POST['telp'])) ? htmlentities($_POST['telp']) : "";
$alamat = (isset($_POST['alamat'])) ? htmlentities($_POST['alamat']) : "";

if (!empty($_POST['input_user_validate'])) {
    $query = mysqli_query($conn, "INSERT INTO tb_user (nama, username, password, level, telp, alamat) VALUES ('$nama','$username','$password','$level','$telp','$alamat')");
    if (!$query) {
        $message = '<script>
                        alert("Data User Gagal ditambahkan!");
                    </script>';
    } else {
        $message = '<script>
                        alert("Data User Berhasil ditambahkan!");
                        window.location = "../user";
                    </script>';
    }
}
echo $message;
