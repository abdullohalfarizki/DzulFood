<?php
include "proses/connect.php";

date_default_timezone_set("Asia/Jakarta");
$query = mysqli_query($conn, "SELECT tb_order.*,nama, SUM(harga*jumlah) AS harganya FROM tb_order
        LEFT JOIN tb_user ON tb_user.id = tb_order.pelayan 
        LEFT JOIN tb_list_order ON  tb_list_order.kode_order = tb_order.id_order
        LEFT JOIN tb_daftar_menu ON  tb_daftar_menu.id = tb_list_order.menu
        GROUP BY id_order");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}

// $select_kat_menu = mysqli_query($conn, "SELECT id_kat_menu,kategori_menu FROM tb_kategori_menu");
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Daftar Order Menu
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col d-flex justify-content-end me-2">
                    <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalTambahMenu"><i class="bi bi-plus-lg"></i> Tambah Order</a>
                </div>
            </div>
            <!-- Modal Tambah Order Baru-->
            <div class="modal fade" id="ModalTambahMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-6" id="exampleModalLabel"><i class="bi bi-plus-circle"></i> Order Baru </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_input_order.php" method="POST">

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="kode_order" class="form-control" id="kodeOrder" value="<?= date("ymdHi") . rand(100, 999) ?>" readonly>
                                            <label for="kodeOrder">Kode Order</label>
                                            <div class="invalid-feedback">
                                                Masukan Kode Order!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-floating mb-3">
                                            <input type="number" name="meja" value="" class="form-control" id="floatingInput" required>
                                            <label for="floatingInput">Meja</label>
                                            <div class="invalid-feedback">
                                                Masukan No Meja!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="pelanggan" value="" class="form-control" id="floatingInput" required>
                                            <label for="floatingInput">Pelanggan</label>
                                            <div class="invalid-feedback">
                                                Masukan Nama Pelanggan!
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="catatan" id="floatingInput" placeholder="" required>
                                    <label for="floatingInput">Catatan</label>
                                    <div class="invalid-feedback">
                                        Masukan Catatan!
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="input_order_validate" value="12345" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Buat Order</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Akhir Modal Tambah Order Baru -->

            <?php
            if (empty($result)) {
                echo "Tidak Ada Data Daftar Order Menu Makanan dan Minuman!";
            } else {
                foreach ($result as $row) {
            ?>

                    <!-- Modal Edit Order -->
                    <div class="modal fade" id="ModalEdit<?php echo $row['id_order']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-6" id="exampleModalLabel"><i class="bi bi-pencil-square"></i> Edit Order </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_edit_order.php" method="POST">

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="kode_order" class="form-control" id="kodeOrder" value="<?= $row['id_order']; ?>" readonly>
                                                    <label for="kodeOrder">Kode Order</label>
                                                    <div class="invalid-feedback">
                                                        Masukan Kode Order!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-floating mb-3">
                                                    <input type="number" name="meja" value="<?= $row['meja']; ?>" class="form-control" id="floatingInput" required>
                                                    <label for="floatingInput">Meja</label>
                                                    <div class="invalid-feedback">
                                                        Masukan No Meja!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="pelanggan" value="<?= $row['pelanggan']; ?>" class="form-control" id="floatingInput" required>
                                                    <label for="floatingInput">Pelanggan</label>
                                                    <div class="invalid-feedback">
                                                        Masukan Nama Pelanggan!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="catatan" id="floatingInput" value="<?= $row['catatan']; ?>" required>
                                            <label for="floatingInput">Catatan</label>
                                            <div class="invalid-feedback">
                                                Masukan Catatan!
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="edit_order_validate" value="12345" class="btn btn-primary btn-sm">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Akhir Modal Edit Order-->

                    <!-- Modal Hapus -->
                    <div class="modal fade" id="ModalHapus<?php echo $row['id_order']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-6" id="exampleModalLabel"><i class="bi bi-trash"></i> Hapus Data Order </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_hapus_order.php" method="POST">
                                        <input type="hidden" name="kode_order" value="<?php echo $row['id_order']; ?>">
                                        <div class="col lg-12 text-center mb-3">
                                            Apakah anda ingin menghapus order atas nama <b><?= $row['pelanggan'] ?></b> dengan kode order <b><?= $row['id_order'] ?></b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="hapus_order_validate" value="12345" class="btn btn-danger btn-sm">Hapus</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Akhir Modal Hapus-->

                <?php
                }

                ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-nowrap">
                                <th scope="col">No</th>
                                <th scope="col">Kode Order</th>
                                <th scope="col">Pelanggan</th>
                                <th scope="col">Meja</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Pelayan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Waktu Order</th>
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
                                    <td><?php echo $row['id_order']; ?></td>
                                    <td><?php echo $row['pelanggan']; ?></td>
                                    <td><?php echo $row['meja']; ?></td>
                                    <td><?php echo number_format((int)$row['harganya'], 0,); ?></td>
                                    <td><?php echo $row['nama']; ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                    <td><?php echo $row['waktu_order']; ?></td>
                                    <td class="">
                                        <div class="row">
                                            <div class="col d-flex">
                                                <a class="btn btn-info btn-sm me-1" href="./?x=orderitem&order=<?php echo $row['id_order'] . "&meja=" . $row['meja'] . "&pelanggan=" . $row['pelanggan']; ?>"><i class="bi bi-eye"></i></a>

                                                <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id_order']; ?>"><i class="bi bi-pencil-square"></i></button>
                                                <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalHapus<?php echo $row['id_order']; ?>"><i class="bi bi-trash"></i></button>
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