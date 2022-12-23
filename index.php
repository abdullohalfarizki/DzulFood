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
            <div class="col-lg-9 mt-2">
                <div class="card">
                    <div class="card-header">
                        Home
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Ini adalah bagian home</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content. Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit ullam odit animi modi fugiat a. Repellendus ut saepe veniam, ea explicabo culpa. Velit ea laboriosam ipsam aliquam accusantium placeat eius.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <!-- End Content -->
        </div>

        <!-- Footer -->
        <?php include "footer.php" ?>
        <!-- End Footer -->

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>