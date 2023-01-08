<?php

include "connect.php";

//Hapus data menu ke database
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";

if (!empty($_POST['input_hapus_validate'])) {
    $query = mysqli_query($conn, "DELETE FROM tb_daftar_menu WHERE id='$id'");
    if ($query) {
        $message = '<script>
                        alert("Data menu Berhasil dihapus!");
                        window.location = "../menu";
                    </script>';
    } else {
        $message =  '<script>
                    alert("Data Gagal dihapus!");
                    window.location = "../menu";
                </script>';
    }
}
echo $message;
