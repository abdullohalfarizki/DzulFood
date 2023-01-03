<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_daftar_menu
    LEFT JOIN tb_kategori_menu ON tb_kategori_menu.id = tb_daftar_menu.kategori ");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}

$select_kat_menu = mysqli_query($conn, "SELECT kategori_menu FROM tb_kategori_menu");
?>



<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Daftar Menu
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col d-flex justify-content-end me-2">
                    <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalTambahMenu"><i class="bi bi-plus-lg"></i> Tambah Menu</a>
                </div>
            </div>
            <!-- Modal Tambah Data Menu-->
            <div class="modal fade" id="ModalTambahMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-6" id="exampleModalLabel"><i class="bi bi-plus"></i> Tambah Menu Makanan dan Minuman </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_input_user.php" method="POST">
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" name="foto" id="uploadFoto" placeholder="Upload Foto Menu Makanan dan Minuman" required>
                                    <label class="input-group-text" for="uploadFoto">Upload Foto Menu</label>
                                    <div class="invalid-feedback">
                                        Masukan Foto Menu !
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="nama_menu" id="floatingInput" placeholder="" required>
                                    <label for="floatingInput">Nama Menu</label>
                                    <div class="invalid-feedback">
                                        Masukan Nama Menu!
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" name="keterangan" id="floatingInput" cols="30" rows="10" style="height: 80px;" required></textarea>
                                    <label for="floatingInput">Keterangan</label>
                                    <div class="invalid-feedback">
                                        Masukan Keterangan!
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select" name="ket_menu" aria-label="Default select example" required>
                                        <option selected hidden value="">Pilih Kategori Menu</option>
                                        <?php
                                        foreach ($select_kat_menu as $value) {
                                            echo "<option value=" . $value['kategori_menu'] . ">$value[kategori_menu]</option>";
                                        }
                                        ?>
                                    </select>
                                    <label for="floatingInput">Kategori Makanan atau Minuman</label>
                                    <div class="invalid-feedback">
                                        Pilih Kategori Makanan atau Minuman!
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="number" name="harga" class="form-control" id="floatingInput" placeholder="Password" value="" required>
                                            <label for="floatingInput">Harga</label>
                                            <div class="invalid-feedback">
                                                Masukan Harga Menu!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="number" name="stok" class="form-control" id="floatingInput" placeholder="120" required>
                                            <label for="floatingInput">Stok</label>
                                            <div class="invalid-feedback">
                                                Masukan Stok Menu!
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="input_menu_validate" value="12345" class="btn btn-primary btn-sm">Tambahkan Menu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Akhir Modal Tambah Data Menu -->

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
                echo "Tidak Ada Data Menu!";
            } else {
            ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-nowrap">
                                <th scope="col">No</th>
                                <th scope="col">Foto Menu</th>
                                <th scope="col">Nama menu</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Jenis Menu</th>
                                <th scope="col">kategori</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Stok</th>
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
                                    <td>
                                        <div style="width: 80px;">
                                            <img src="assets/img/<?php echo $row['foto']; ?>" class=" img-thumbnail" alt="...">
                                        </div>
                                    </td>
                                    <td><?php echo $row['nama_menu']; ?></td>
                                    <td><?php echo $row['keterangan']; ?></td>
                                    <td><?php echo ($row['jenis_menu'] == 1) ? "Makanan" : "Minuman"; ?></td>
                                    <td><?php echo $row['kategori_menu']; ?></td>
                                    <td>Rp. <?php echo number_format($row['harga']); ?></td>
                                    <td><?php echo $row['stok']; ?></td>
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