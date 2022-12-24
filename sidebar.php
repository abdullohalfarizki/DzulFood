<div class="col-lg-3">
    <nav class="navbar navbar-expand-lg bg-light rounded border mt-2">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="width: 250px;">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">DzulFood</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav nav-pills  flex-column justify-content-end flex-grow-1">
                        <li class="nav-item">
                            <a class="nav-link <?php echo ((isset($_GET['x']) && $_GET['x'] == 'home') || !isset($_GET['x'])) ? 'active link-light bg-info'  : 'link-dark'; ?>  ps-2" aria-current="page" href="home"><i class="bi bi-houses"></i> Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (isset($_GET['x']) && $_GET['x'] == 'menu') ? 'active link-light bg-info'  : 'link-dark'; ?> ps-2" href="menu"><i class="bi bi-cart-check"></i> Daftar Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (isset($_GET['x']) && $_GET['x'] == 'order') ? 'active link-light bg-info'  : 'link-dark'; ?> ps-2" href="order"><i class="bi bi-cart-check"></i> Order</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (isset($_GET['x']) && $_GET['x'] == 'customer') ? 'active link-light bg-info'  : 'link-dark'; ?> ps-2" href="customer"><i class="bi bi-person-fill-check"></i> Customer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (isset($_GET['x']) && $_GET['x'] == 'product') ? 'active link-light bg-info'  : 'link-dark'; ?> ps-2" href="product"><i class="bi bi-card-checklist"></i> Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (isset($_GET['x']) && $_GET['x'] == 'report') ? 'active link-light bg-info'  : 'link-dark'; ?> ps-2" href="report"><i class="bi bi-file-earmark-bar-graph"></i> Report</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>