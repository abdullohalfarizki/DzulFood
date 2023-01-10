<?php

include "connect.php";

//Hapus data user ke database
$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";

if (!empty($_POST['hapus_order_validate'])) {
    $select = mysqli_query($conn, "SELECT kode_order FROM tb_list_order WHERE kode_order='$kode_order'");
    //cek apakah datanya sudah berelasi/ sudah melakukan order item
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>
        alert("Order telah memiliki data item order, data ini tidak boleh dihapus!");
        window.location = "../order";
        </script>';
    } else {
        $query = mysqli_query($conn, "DELETE FROM tb_order WHERE id_order='$kode_order'");
        if ($query) {
            $message = '<script>
                        alert("Data Order Berhasil dihapus!");
                        window.location = "../order";
                    </script>';
        } else {
            $message =  '<script>
                    alert("Data Order Gagal dihapus!");
                    window.location = "../order";
                </script>';
        }
    }
}
echo $message;
