<nav class="navbar navbar-expand navbar-dark bg-info sticky-top">
    <div class="container-lg">
        <a class="navbar-brand" href="."><i class="bi bi-circle-square"></i> DzulFood</a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $hasil['nama']; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end mt-2">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalView"><i class="bi bi-person-fill"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalUbahPassword"><i class="bi bi-key"></i> Ubah Password</a></li>
                        <li><a class="dropdown-item" href="logout"><i class="bi bi-box-arrow-in-left"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>


<!-- Modal Ubah Password-->
<div class="modal fade" id="ModalUbahPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-6" id="exampleModalLabel"><i class="bi bi-key"></i> Ubah Password </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="proses/proses_input_user.php" method="POST">
                    <div class="form-floating mb-3">
                        <input disabled type="email" class="form-control" name="username" id="floatingInput" placeholder="name@example.com" value="<?php echo $_SESSION['username_dzulfood']; ?>">
                        <label for="floatingInput">Username</label>
                        <div class="invalid-feedback">
                            Masukan Username!
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="passwordlama" class="form-control" id="floatingPassword" placeholder="Password" required>
                        <label for="floatingPassword">Password Lama.</label>
                        <div class="invalid-feedback">
                            Masukan Password Lama!
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" name="passwordbaru" class="form-control" id="floatingPassword" placeholder="Password" required>
                        <label for="floatingPassword">Password Baru.</label>
                        <div class="invalid-feedback">
                            Masukan Password Baru!
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="repasswordbaru" class="form-control" id="floatingPassword" placeholder="Password" required>
                        <label for="floatingPassword">Ulangi Password Baru.</label>
                        <div class="invalid-feedback">
                            Ulangi Password Baru!
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="input_edit_validate" value="12345" class="btn btn-primary btn-sm">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<!-- End Modal Ubah Password -->