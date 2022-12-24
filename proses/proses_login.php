<?php

session_start();

include "connect.php";

$username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : "";
$password = (isset($_POST['password'])) ? md5(htmlentities($_POST['password']))  : "";
if (!empty($_POST['submit_validate'])) {
    //cek username dan password yang diinputkan apakah sesuai dengan yang  ada di database
    $query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' && password = '$password' ");
    $hasil = mysqli_fetch_array($query);
    //jika data yang inputkan sesuai dengan yang ada di database maka login berhasil 
    if ($hasil) {
        //dibuatkan session dengan nama username_dzulfood

        $_SESSION['username_dzulfood'] = $username;
        header("location: login");
        header('Location:../home');
    } else { ?>
        <script>
            alert('Username dan password yang anda masukan salah');
            window.location = '../login';
        </script>
<?php
    }
}
?>