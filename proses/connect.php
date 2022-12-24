<?php
$conn =  mysqli_connect('localhost', 'root', '', 'db_dzulfood');
if (!$conn) {
    echo "Gagal Koneksi ke database!";
}
