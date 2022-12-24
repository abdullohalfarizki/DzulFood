<?php

if (isset($_GET['x']) && $_GET['x'] == 'home') {
    include "main.php";
} else if (isset($_GET['x']) && $_GET['x'] == 'order') {
    include "main.php";
} else if (isset($_GET['x']) && $_GET['x'] == 'product') {
    include "main.php";
} else if (isset($_GET['x']) && $_GET['x'] == 'customer') {
    include "main.php";
} else if (isset($_GET['x']) && $_GET['x'] == 'report') {
    include "main.php";
} else if (isset($_GET['x']) && $_GET['x'] == 'login') {
    include "login.php";
} else {
    include "main.php";
}
