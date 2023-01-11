<?php
session_start();
include "connect.php";

$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan'])  : "";
$total = (isset($_POST['total'])) ? htmlentities($_POST['total'])  : "";
$uang = (isset($_POST['uang'])) ? htmlentities($_POST['uang'])  : "";
$kembalian = (int)$uang - (int)$total;

if (!empty($_POST['bayar_validate'])) {
    //pengecekan pembyaaran jika uangnya cukup lanjjut/sebaliknya
    if ($kembalian < 0) {
        $message = '<script>
                        alert("Nominal Uang Tidak Cukup!");
                        window.location = "../?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '";
                    </script>';
    } else {
        //jika uang cukup maka lanjutkan pembayaran
        $query = mysqli_query($conn, "INSERT INTO tb_bayar (id_bayar, nominal_uang, total_bayar) VALUES ('$kode_order','$uang','$total')");
        if (!$query) {
            $message = '<script>
                            alert("Pembayaran Gagal");
                            window.location = "../?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '";
                        </script>';
        } else {
            $message = '<script>
                            alert("Pembayaran Berhasil \nUANG KEMBALIAN Rp. ' . $kembalian . '");
                            window.location = "../?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '";
                        </script>';
        }
    }
}
echo $message;
