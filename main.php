<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DzulFood</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
</head>

<body style="height: 3000px;">

    <!-- Header -->
    <?php include "header.php" ?>
    <!-- End Header -->

    <div class="container-lg">
        <div class="row">
            <!-- Sidebar -->
            <?php include "sidebar.php" ?>
            <!-- End Sidebar -->

            <!-- Content -->

            <?php

            if (isset($_GET['x']) && $_GET['x'] == 'home') {
                include "home.php";
            } else if (isset($_GET['x']) && $_GET['x'] == 'order') {
                include "order.php";
            } else if (isset($_GET['x']) && $_GET['x'] == 'product') {
                include "product.php";
            } else if (isset($_GET['x']) && $_GET['x'] == 'customer') {
                include "customer.php";
            } else if (isset($_GET['x']) && $_GET['x'] == 'report') {
                include "report.php";
            } else {
                include "home.php";
            }
            ?>

            <!-- End Content -->
        </div>

        <!-- Footer -->
        <?php include "footer.php" ?>
        <!-- End Footer -->

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>