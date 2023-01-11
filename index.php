<?php

session_start();

if (isset($_GET['x']) && $_GET['x'] == 'home') {
    $page = "home.php";
    include "main.php";
} else if (isset($_GET['x']) && $_GET['x'] == 'menu') {
    $page = "menu.php";
    include "main.php";
} else if (isset($_GET['x']) && $_GET['x'] == 'katmenu') {
    $page = "katmenu.php";
    include "main.php";
} else if (isset($_GET['x']) && $_GET['x'] == 'orderitem') {
    $page = "order_item.php";
    include "main.php";
} else if (isset($_GET['x']) && $_GET['x'] == 'order') {
    $page = "order.php";
    include "main.php";
} else if (isset($_GET['x']) && $_GET['x'] == 'dapur') {
    $page = "dapur.php";
    include "main.php";
} else if (isset($_GET['x']) && $_GET['x'] == 'user') {
    if ($_SESSION['level_dzulfood'] == 1) {
        $page = "user.php";
        include "main.php";
    } else { ?>
        <script>
            alert('Anda tidak memiliki akses !');
            window.location = 'main.php';
        </script>
    <?php
    }
} else if (isset($_GET['x']) && $_GET['x'] == 'report') {
    if ($_SESSION['level_dzulfood'] == 1) {
        $page = "report.php";
        include "main.php";
    } else { ?>
        <script>
            alert('Anda tidak memiliki akses !');
            window.location = 'main.php';
        </script>
<?php
    }
} else if (isset($_GET['x']) && $_GET['x'] == 'login') {
    include "login.php";
} else if (isset($_GET['x']) && $_GET['x'] == 'logout') {
    include "proses/proses_logout.php";
} else {
    $page = "home.php";
    include "main.php";
}
