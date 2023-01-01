<?php

include "connect.php";

//reset password user
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";

if (!empty($_POST['reset_password_validate'])) {
    $query = mysqli_query($conn, "UPDATE tb_user SET password=md5('12345') WHERE id='$id'");
    if ($query) {
        $message = '<script>
                        alert("Password Berhasil direset!");
                        window.location = "../user";
                    </script>';
        echo $query;
        exit();
    } else {
        $message =  '<script>
                    alert("Password Gagal direset!");
                </script>';
    }
}
echo $message;
