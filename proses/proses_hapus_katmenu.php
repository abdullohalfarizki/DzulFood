<?php

include "connect.php";

//Hapus data kategori menu 
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";

if (!empty($_POST['hapus_kategori_validate'])) {
    $query = mysqli_query($conn, "DELETE FROM tb_kategori_menu WHERE id_kat_menu='$id'");
    if ($query) {
        $message = '<script>
                        alert("Kategori Menu Berhasil dihapus!");
                        window.location = "../katmenu";
                    </script>';
    } else {
        $message =  '<script>
                    alert("Data Gagal dihapus!");
                    window.location = "../katmenu";
                </script>';
    }
}
echo $message;
