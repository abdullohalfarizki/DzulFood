<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_kategori_menu");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Kategori Menu
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col d-flex justify-content-end me-2">
                    <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalTambahUser"><i class="bi bi-plus-lg"></i> Tambah</a>
                </div>
            </div>
            <!-- Modal Tambah Kategori Menu Baru-->
            <div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-6" id="exampleModalLabel"><i class="bi bi-plus"></i> Tambah Kategori Menu </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_input_katmenu.php" method="POST">
                                <div class="form-floating mb-3">
                                    <select class="form-select" name="jenismenu" aria-label="Default select example" required>
                                        <option selected hidden value="">Pilih Jenis Menu</option>
                                        <option value="1">Makanan</option>
                                        <option value="2">Minuman</option>
                                    </select>
                                    <label for="floatingInput">Jenis Menu</label>
                                    <div class="invalid-feedback">
                                        Pilih Jenis Menu!
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="katmenu" id="floatingInput" placeholder="Kategori Menu" required>
                                    <label for="floatingInput">Kategori Menu</label>
                                    <div class="invalid-feedback">
                                        Masukan Kategori Menu!
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Keluar</button>
                                    <button type="submit" name="input_katmenu_validate" value="12345" class="btn btn-primary btn-sm">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Akhir Modal Tambah Kategori Menu Baru -->

            <?php
            foreach ($result as $row) {
            ?>

                <!-- Modal Edit Kategori Baru  -->
                <div class="modal fade" id="ModalEdit<?php echo $row['id_kat_menu']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-6" id="exampleModalLabel"><i class="bi bi-pencil-square"></i> Edit Data Kategori Menu </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_edit_katmenu.php" method="POST">
                                    <input type="hidden" value="<?php echo $row['id_kat_menu'] ?>" name="id">
                                    <div class="form-floating mb-3">
                                        <select name="jenismenu" id="jenismenu" class="form-select" aria-label="Default Select Example">
                                            <?php
                                            $data = array("Makanan", "Minuman");
                                            foreach ($data as $key => $value) {
                                                if ($row['jenis_menu'] == ++$key) {
                                                    echo "<option value='$key' selected>$value</option>";
                                                } else {
                                                    echo "<option value='$key'>$value</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                        <label for="floatingInput">Jenis Menu</label>
                                        <div class="invalid-feedback">
                                            Pilih Jenis Menu!
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="katmenu" value="<?php echo $row['kategori_menu'] ?>" id="floatingInput" placeholder="Kategori Menu" required>
                                        <label for="floatingInput">Kategori Menu</label>
                                        <div class="invalid-feedback">
                                            Masukan Kategori Menu!
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Keluar</button>
                                        <button type="submit" name="edit_katmenu_validate" value="12345" class="btn btn-primary btn-sm">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Akhir Modal Edit Kategori Baru -->

                <!-- Modal Hapus Kategori Baru -->
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
                <!-- Akhir Modal Hapus Kategori Baru -->

            <?php
            }
            if (empty($result)) {
                echo "Data User Tidak Ada!";
            } else {
            ?>
                <!-- Tabel Dafrtar Kategori Menu -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-nowrap">
                                <th scope="col">No</th>
                                <th scope="col">Jenis Menu</th>
                                <th scope="col">Kategori Menu</th>
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
                                    <td><?php echo ($row['jenis_menu'] == 1 ? "Makanan" : "Minuman"); ?></td>
                                    <td><?php echo $row['kategori_menu']; ?></td>
                                    <td class="">
                                        <div class="row">
                                            <div class="col d-flex">
                                                <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id_kat_menu']; ?>"><i class="bi bi-pencil-square"></i></button>
                                                <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalHapus<?php echo $row['id_kat_menu']; ?>"><i class="bi bi-trash"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- Akhir Daftar Kategori Menu -->
            <?php } ?>
        </div>
    </div>
</div>