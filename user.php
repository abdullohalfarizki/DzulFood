<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_user");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Data User
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col d-flex justify-content-end me-2">
                    <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalTambahUser"><i class="bi bi-plus-lg"></i> Tambah</a>
                </div>
            </div>
            <!-- Modal Tambah Data User-->
            <div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-6" id="exampleModalLabel"><i class="bi bi-plus"></i> Tambah User </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_input_user.php" method="POST">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="nama" id="floatingInput" placeholder="Your Name" required>
                                    <label for="floatingInput">Nama</label>
                                    <div class="invalid-feedback">
                                        Masukan Nama!
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" name="username" id="floatingInput" placeholder="name@example.com" required>
                                    <label for="floatingInput">Username</label>
                                    <div class="invalid-feedback">
                                        Masukan Username!
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select" name="level" aria-label="Default select example" required>
                                        <option selected hidden value="">Pilih level user</option>
                                        <option value="1">Owner/Admin</option>
                                        <option value="2">Kasir</option>
                                        <option value="3">Pelayan</option>
                                        <option value="3">Dapur</option>
                                    </select>
                                    <label for="floatingInput">Level</label>
                                    <div class="invalid-feedback">
                                        Pilih Level User!
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" value="" required>
                                    <label for="floatingPassword">Password</label>
                                    <div class="invalid-feedback">
                                        Masukan Password!
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="number" name="telp" class="form-control" id="floatingInput" placeholder="082122223333" required>
                                    <label for="floatingInput">No Telp</label>
                                    <div class="invalid-feedback">
                                        Masukan No Telpon!
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" name="alamat" id="floatingInput" cols="30" rows="10" style="height: 90px;" required></textarea>
                                    <label for="floatingInput">Alamat</label>
                                    <div class="invalid-feedback">
                                        Masukan Alamat!
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="input_user_validate" value="12345" class="btn btn-primary btn-sm">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Akhir Modal Tambah Data User -->

            <?php
            foreach ($result as $row) {
            ?>
                <!-- Modal View -->
                <div class="modal fade" id="ModalView<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-6" id="exampleModalLabel"><i class="bi bi-eye"></i> Detail Data User </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_input_user.php" method="POST">
                                    <div class="form-floating mb-3">
                                        <input disabled type="text" class="form-control" name="nama" id="floatingInput" placeholder="Your Name" value="<?php echo $row['nama']; ?>">
                                        <label for="floatingInput">Nama</label>
                                        <div class="invalid-feedback">
                                            Masukan Nama!
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input disabled type="email" class="form-control" name="username" id="floatingInput" placeholder="name@example.com" value="<?php echo $row['username']; ?>">
                                        <label for="floatingInput">Username</label>
                                        <div class="invalid-feedback">
                                            Masukan Username!
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select disabled name="level" id="level" class="form-select" aria-label="Default Select Example">
                                            <?php
                                            $data = array("Owner/Admin", "Kasir", "Pelayan", "Dapur");
                                            foreach ($data as $key => $value) {
                                                if ($row['level'] == $key + 1) {
                                                    echo "<option value='$key' selected>$value</option>";
                                                } else {
                                                    echo "<option value='$key'>$value</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                        <label for="floatingInput">Level User</label>
                                        <div class="invalid-feedback">
                                            Pilih Level User!
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input disabled type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" value="<?php echo $row['password'] ?>">
                                        <label for="floatingPassword">Password</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input disabled type="number" name="telp" class="form-control" id="floatingInput" placeholder="082122223333" value="<?php echo $row['telp'] ?>">
                                        <label for="floatingInput">No Telp</label>
                                        <div class="invalid-feedback">
                                            Masukan No Telpon!
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea disabled class="form-control" name="alamat" id="floatingInput" cols="30" rows="10" style="height: 90px;"><?php echo $row['alamat'] ?></textarea>
                                        <label for="floatingInput">Alamat</label>
                                        <div class="invalid-feedback">
                                            Masukan Alamat!
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Akhir Modal View-->
                <!-- Modal Edit -->
                <div class="modal fade" id="ModalEdit<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-6" id="exampleModalLabel"><i class="bi bi-pencil-square"></i> Edit Data User </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_edit_user.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="nama" id="floatingInput" required placeholder="Your Name" value="<?php echo $row['nama']; ?>">
                                        <label for="floatingInput">Nama</label>
                                        <div class="invalid-feedback">
                                            Masukan Nama!
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input <?php echo ($row['username'] == $_SESSION['username_dzulfood']) ? 'disabled' : ''; ?> required type="email" class="form-control" name="username" id="floatingInput" placeholder="name@example.com" value="<?php echo $row['username']; ?>">
                                        <label for="floatingInput">Username</label>
                                        <div class="invalid-feedback">
                                            Masukan Username!
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select name="level" id="level" class="form-select" aria-label="Default Select Example">
                                            <?php
                                            $data = array("Owner/Admin", "Kasir", "Pelayan", "Dapur");
                                            foreach ($data as $key => $value) {
                                                if ($row['level'] == ++$key) {
                                                    echo "<option value='$key' selected>$value</option>";
                                                } else {
                                                    echo "<option value='$key'>$value</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                        <label for="floatingInput">Level User</label>
                                        <div class="invalid-feedback">
                                            Pilih Level User!
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input required type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" value="<?php echo $row['password'] ?>">
                                        <label for="floatingPassword">Password</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input required type="number" name="telp" class="form-control" id="floatingInput" placeholder="082122223333" value="<?php echo $row['telp'] ?>">
                                        <label for="floatingInput">No Telp</label>
                                        <div class="invalid-feedback">
                                            Masukan No Telpon!
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea required class="form-control" name="alamat" id="floatingInput" cols="30" rows="10" style="height: 90px;"><?php echo $row['alamat'] ?></textarea>
                                        <label for="floatingInput">Alamat</label>
                                        <div class="invalid-feedback">
                                            Masukan Alamat!
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
                <!-- Akhir Modal Edit-->

                <!-- Modal Hapus -->
                <div class="modal fade" id="ModalHapus<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-6" id="exampleModalLabel"><i class="bi bi-trash"></i> Hapus Data User </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_hapus_user.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <div class="col lg-12 text-center mb-3">
                                        <?php
                                        if ($row['username'] == $_SESSION['username_dzulfood']) {
                                            echo '<div class="alert alert-danger">Anda tidak dapat menghapus akun sendiri</div>';
                                        } else {
                                            echo "Apakah anda yakin ingin menghapus user <b>$row[username]</b>";
                                        }
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="input_hapus_validate" value="12345" class="btn btn-danger btn-sm" <?php echo ($row['username'] == $_SESSION['username_dzulfood']) ? 'disabled' : ''; ?>>Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Akhir Modal Hapus-->

                <!-- Modal Reset Password-->
                <div class="modal fade" id="ModalResetPassword<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-6" id="exampleModalLabel"><i class="bi bi-key"></i> Reset Password </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_reset_password.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <div class="col lg-12 text-center mb-3">
                                        <?php
                                        if ($row['username'] == $_SESSION['username_dzulfood']) {
                                            echo '<div class="alert alert-danger">Anda tidak dapat mereset password sendiri</div>';
                                        } else {
                                            echo "Apakah anda yakin ingin mereset password user <b>$row[username]</b> menjadi password bawaan sistem yaitu <b>12345</b>";
                                        }
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="reset_password_validate" value="12345" class="btn btn-success btn-sm" <?php echo ($row['username'] == $_SESSION['username_dzulfood']) ? 'disabled' : ''; ?>>Reset Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Akhir Modal Reset Password-->
            <?php
            }
            if (empty($result)) {
                echo "Data User Tidak Ada!";
            } else {
            ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Username</th>
                                <th scope="col">Level</th>
                                <th scope="col">No HP</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($result as $row) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $no++; ?></th>
                                    <td><?php echo $row['nama']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td>
                                        <?php if ($row['level'] == 1) {
                                            echo "Admin";
                                        } elseif ($row['level'] == 2) {
                                            echo "Kasir";
                                        } elseif ($row['level'] == 3) {
                                            echo "Pelayan";
                                        } elseif ($row['level'] == 4) {
                                            echo "Dapur";
                                        } ?>
                                    </td>
                                    <td><?php echo $row['telp']; ?></td>
                                    <td class="">
                                        <div class="row">
                                            <div class="col d-flex">
                                                <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalView<?php echo $row['id']; ?>"><i class="bi bi-eye"></i></button>
                                                <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id']; ?>"><i class="bi bi-pencil-square"></i></button>
                                                <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalHapus<?php echo $row['id']; ?>"><i class="bi bi-trash"></i></button>
                                                <button class="btn btn-secondary btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalResetPassword<?php echo $row['id']; ?>"><i class="bi bi-key"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        </div>
    </div>
</div>