<?php
session_start();
include "connect.php";

$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$catatan = (isset($_POST['catatan'])) ? htmlentities($_POST['catatan']) : "";

if (!empty($_POST['siap_order_validate'])) {
    $query = mysqli_query($conn, "UPDATE tb_list_order SET catatan='$catatan', status=2 WHERE id_list_order='$id' ");
    if (!$query) {
        $message = '<script>
                        alert("Menu Gagal Untuk Disajikan!");
                        window.location = "../dapur";
                        </script>';
    } else {
        $message = '<script>
                        alert("Menu Siap Untuk Disajikan");
                        window.location = "../dapur";
                    </script>';
    }
}
echo $message;
