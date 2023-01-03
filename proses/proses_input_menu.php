<?php

include "connect.php";

//menambahkan data user ke database
$nama_menu = (isset($_POST['nama_menu'])) ? htmlentities($_POST['nama_menu']) : "";
$keterangan = (isset($_POST['keterangan'])) ? htmlentities($_POST['keterangan']) : "";
$kategori_menu = (isset($_POST['kategori_menu'])) ? htmlentities($_POST['kategori_menu'])  : "";
$harga = (isset($_POST['harga'])) ? htmlentities($_POST['harga']) : "";
$stok = (isset($_POST['stok'])) ? htmlentities($_POST['stok']) : "";
// $alamat = (isset($_POST['alamat'])) ? htmlentities($_POST['alamat']) : "";


$kode_rand = random_int(10000, 99999) . "-";
$target_dir = "../assets/img/" . $kode_rand;
$target_file = $target_dir . basename($_FILES['foto']['name']);
$imageType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (!empty($_POST['input_menu_validate'])) {
    //cek apakah gambar/bukan
    $cek = getimagesize($_FILES['foto']['tmp_name']);
    if ($cek ===  false) {
        $message = "Ini bukan file gambar";
        $statusUpload = 0;
    } else {
        $statusUpload = 1;
        if (file_exists($target_file)) {
            $message = "Maaf File yang dimasukan telah ada";
            $statusUpload = 0;
        } else {
            if ($_FILES['foto']['size'] > 500000) { //500rb kb
                $message = "Maaf File yang dimasukan terlalu besar";
                $statusUpload = 0;
            } else {
                if ($imageType != 'jpg' && $imageType != 'jpeg' && $imageType != 'png' && $imageType != 'gif') {
                    $message = "Maaf hanya diperbolehkan gambar yang berformat jpg, jpeg, png dan gif";
                    $statusUpload = 0;
                }
            }
        }
    }

    if ($statusUpload == 0) {
        $message = '<script>
                    alert("' . $message . ', Gambar tidak dapat di upload!");
                    window.history.back()</script>';
    } else {
        $select = mysqli_query($conn, "SELECT * FROM tb_daftar_menu WHERE nama_menu = '$nama_menu'");
        //kalo ada
        if (mysqli_num_rows($select) > 0) {
            $message = '<script>
            alert"Nama yang dimasuka telah ada!");
            window.history.back()</script>';
        } else { //lakukan upload
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
                $query = mysqli_query($conn, "INSERT INTO tb_daftar_menu (foto, nama_menu, keterangan, kategori, harga, stok) VALUES ('" . $kode_rand . $_FILES['foto']['name'] . "','$nama_menu','$keterangan','$kategori_menu','$harga','$stok')");
                if ($query) {
                    $message = '<script>
                                        alert("Data berhasil ditambahkan!");
                                        window.location="../menu"</script>';
                } else {
                    $message = '<script>
                                        alert("Data gagal ditambahkan!");
                                        window.location="../menu"</script>';
                }
            } else { //tidak berhasil upload
                $message = '<script>
                            alert("Maaf terjadi kesalahan file tidak dapat diupload!");
                            window.location="../menu"</script>';
            }
        }
    }
}
echo $message;
