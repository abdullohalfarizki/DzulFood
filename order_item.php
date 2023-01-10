<?php
include "proses/connect.php";

$query = mysqli_query($conn, "SELECT *, SUM(harga*jumlah) AS harganya FROM tb_list_order

        LEFT JOIN tb_order ON  tb_order.id_order = tb_list_order.kode_order
        LEFT JOIN tb_daftar_menu ON  tb_daftar_menu.id = tb_list_order.menu
        GROUP BY id_list_order
        HAVING tb_list_order.kode_order = $_GET[order] ");

$kode = $_GET['order'];
$meja = $_GET['meja'];
$pelanggan = $_GET['pelanggan'];

while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
    // $kode = $record['id_order'];
    // $meja = $record['meja'];
    // $pelanggan = $record['pelanggan'];
}

$select_menu = mysqli_query($conn, "SELECT id,nama_menu FROM tb_daftar_menu");

?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Halaman Order Item
        </div>
        <div class="card-body">
            <a href="order" class="btn btn-secondary btn-sm mb-3"><i class="bi bi-arrow-left"></i></a>
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="kodeOrder" value="<?= $kode; ?>">
                        <label for="kodeOrder">Kode Order</label>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-floating mb-3">
                        <input disabled type="text" value="<?= $meja; ?>" class="form-control" id="floatingInput">
                        <label for="floatingInput">Meja</label>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-floating mb-3">
                        <input disabled type="text" value="<?= $pelanggan; ?>" class="form-control" id="floatingInput">
                        <label for="floatingInput">Pelanggan</label>
                    </div>
                </div>
            </div>

            <!-- Modal Tambah Item-->
            <div class="modal fade" id="tambahItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-6" id="exampleModalLabel"><i class="bi bi-plus-circle"></i> Tambah Item Order Menu Makanan dan Minuman </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_input_orderitem.php" method="POST">
                                <input type="hidden" name="kode_order" value="<?= $kode; ?>">
                                <input type="hidden" name="meja" value="<?= $meja; ?>">
                                <input type="hidden" name="pelanggan" value="<?= $pelanggan; ?>">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-floating mb-4">
                                            <select class="form-select" name="menu" id="menu" aria-label="Default select example" required>
                                                <option selected hidden value="">Pilih Menu</option>
                                                <?php
                                                foreach ($select_menu as $value) {
                                                    echo "<option value=" . $value['id'] . ">$value[nama_menu]</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="menu">Menu Makanan / Minuman</label>
                                            <div class="invalid-feedback">
                                                Pilih Menu!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="number" name="jumlah" class="form-control" id="floatingInput" placeholder="Jumlah Porsi" required>
                                            <label for="floatingInput">Jumlah Porsi</label>
                                            <div class="invalid-feedback">
                                                Masukan Jumlah Porsi!
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" name="catatan" id="floatingInput" cols="30" rows="10" style="height: 80px;"></textarea>
                                    <label for="floatingInput">Catatan</label>
                                    <div class="invalid-feedback">
                                        Masukan Catatan!
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="input_orderitem_validate" value="12345" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Akhir Modal Tambah Item -->

            <?php
            if (empty($result)) {
                echo "Tidak Ada Data Order Item!";
            } else {
                foreach ($result as $row) {
            ?>
                    <!-- Modal Edit Item order -->
                    <div class="modal fade" id="ModalEdit<?php echo $row['id_list_order']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-6" id="exampleModalLabel"><i class="bi bi-pencil-square"></i> Edit Item Menu Makanan dan Minuman </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_edit_orderitem.php" method="POST">
                                        <input type="hidden" name="id" value="<?= $row['id_list_order']; ?>">
                                        <input type="hidden" name="kode_order" value="<?= $kode; ?>">
                                        <input type="hidden" name="meja" value="<?= $meja; ?>">
                                        <input type="hidden" name="pelanggan" value="<?= $pelanggan; ?>">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="form-floating mb-4">
                                                    <select class="form-select" name="menu" id="menu" aria-label="Default select example" required>
                                                        <option selected hidden value="">Pilih Menu</option>
                                                        <?php
                                                        foreach ($select_menu as $value) {
                                                            if ($row['menu'] == $value['id']) {
                                                                echo "<option selected value=" . $value['id'] . ">$value[nama_menu]</option>";
                                                            } else {
                                                                echo "<option value=" . $value['id'] . ">$value[nama_menu]</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="menu">Menu Makanan / Minuman</label>
                                                    <div class="invalid-feedback">
                                                        Pilih Menu!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input type="number" value="<?= $row['jumlah'] ?>" name="jumlah" class="form-control" id="floatingInput" placeholder="Jumlah Porsi" required>
                                                    <label for="floatingInput">Jumlah Porsi</label>
                                                    <div class="invalid-feedback">
                                                        Masukan Jumlah Porsi!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" name="catatan" id="floatingInput" cols="30" rows="10" style="height: 80px;"><?= $row['catatan'] ?></textarea>
                                            <label for="floatingInput">Catatan</label>
                                            <div class="invalid-feedback">
                                                Masukan Catatan!
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="edit_orderitem_validate" value="12345" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Akhir Modal Edit Item Order-->

                    <!-- Modal Hapus -->
                    <div class="modal fade" id="ModalHapus<?php echo $row['id_list_order']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-6" id="exampleModalLabel"><i class="bi bi-trash"></i> Hapus Item Menu </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_hapus_orderitem.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $row['id_list_order']; ?>">
                                        <input type="hidden" name="kode_order" value="<?= $kode; ?>">
                                        <input type="hidden" name="meja" value="<?= $meja; ?>">
                                        <input type="hidden" name="pelanggan" value="<?= $pelanggan; ?>">
                                        <div class="col lg-12 text-center mb-3">
                                            Apakah anda ingin menghapus menu <b><?php echo $row['nama_menu'] ?></b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="hapus_orderitem_validate" value="12345" class="btn btn-danger btn-sm">Hapus</button>
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
                                <th scope="col">Menu</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Status</th>
                                <th scope="col">Total</th>
                                <th scope="col">Catatan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            foreach ($result as $row) {
                            ?>
                                <tr>
                                    <td><?php echo $row['nama_menu']; ?></td>
                                    <td>Rp. <?php echo number_format($row['harga']); ?></td>
                                    <td><?php echo $row['jumlah']; ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                    <td>Rp. <?php echo number_format($row['harganya']); ?></td>
                                    <td><?php echo $row['catatan']; ?></td>
                                    <td class="">
                                        <div class="row">
                                            <div class="col d-flex">
                                                <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id_list_order']; ?>"><i class="bi bi-pencil-square"></i></button>
                                                <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalHapus<?php echo $row['id_list_order']; ?>"><i class="bi bi-trash"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                                $total += $row['harganya'];
                            } ?>
                            <tr>
                                <td colspan="4" class="fw-bold">
                                    Total Harga
                                </td>
                                <td class="fw-bold">
                                    Rp. <?= number_format($total); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
            <!-- tombol -->
            <div class="mb-3">
                <button class="btn btn-primary btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#tambahItem"><i class="bi bi-plus-circle"></i> Item</button>

                <button class="btn btn-success btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#bayar"><i class="bi bi-cash-coin"></i> Bayar</button>
            </div>
        </div>
    </div>
</div>