<?php

include "connect.php";

//menambahkan data user ke database
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$nama = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : "";
$username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : "";
$password = (isset($_POST['password'])) ? md5(htmlentities($_POST['password']))  : "";
$level = (isset($_POST['level'])) ? htmlentities($_POST['level']) : "";
$telp = (isset($_POST['telp'])) ? htmlentities($_POST['telp']) : "";
$alamat = (isset($_POST['alamat'])) ? htmlentities($_POST['alamat']) : "";

if (!empty($_POST['input_edit_validate'])) {
    $query = mysqli_query($conn, "UPDATE tb_user SET nama='$nama', username='$username', password='$password', level='$level', telp='$telp', alamat='$alamat' WHERE id='$id' ");
    if ($query) {
        $message = '<script>
                        alert("Data User Berhasil diupdate!");
                        window.location = "../user";
                    </script>';
    } else {
        $message =  '<script>
                    alert("Data User Gagal diupdate!");
                </script>';
    }
}
echo $message;
