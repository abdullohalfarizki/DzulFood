<?php
session_start();
include "connect.php";

//menambahkan order menu ke database
$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan'])  : "";
$catatan = (isset($_POST['catatan'])) ? htmlentities($_POST['catatan']) : "";

if (!empty($_POST['edit_order_validate'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_order WHERE id_order = '$kode_order'");
    $query = mysqli_query($conn, "UPDATE tb_order 
                                    SET meja='$meja', pelanggan='$pelanggan', catatan='$catatan' 
                                    WHERE  id_order='$kode_order'");
    if (!$query) {
        $message = '<script>
                        alert("Data Order Gagal diedit!");
                        window.location = "../order";
                    </script>';
    } else {
        $message = '<script>
                        alert("Data Order Berhasil diedit!");
                        window.location = "../order";
                    </script>';
    }
}
echo $message;
