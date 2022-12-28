<?php

include "connect.php";

//Hapus data user ke database
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";

if (!empty($_POST['input_hapus_validate'])) {
    $query = mysqli_query($conn, "DELETE FROM tb_user WHERE id='$id'");
    if ($query) {
        $message = '<script>
                        alert("Data User Berhasil dihapus!");
                        window.location = "../user";
                    </script>';
    } else {
        $message =  '<script>
                    alert("Data User Gagal dihapus!");
                </script>';
    }
}
echo $message;
