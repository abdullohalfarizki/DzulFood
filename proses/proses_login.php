<?php
$username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : "";
$password = (isset($_POST['password'])) ? htmlentities($_POST['password']) : "";
if (!empty($_POST['submit_validate'])) {
    //cek username dan password
    if ($username == "admin@gmail.com" && $password == "12345") {
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