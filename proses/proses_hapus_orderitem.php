<?php

include "connect.php";

//Hapus data item ke database
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan'])  : "";

if (!empty($_POST['hapus_orderitem_validate'])) {

    $query = mysqli_query($conn, "DELETE FROM tb_list_order WHERE id_list_order='$id'");
    if ($query) {
        $message = '<script>
                        alert("Data Order Item Berhasil dihapus!");
                        window.location = "../?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '";
                        </script>';
    } else {
        $message =  '<script>
                    alert("Data Order Item Gagal dihapus!");
                    window.location = "../?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '";
                    </script>';
    }
}
echo $message;
