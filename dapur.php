<?php
include "proses/connect.php";

$query = mysqli_query($conn, "SELECT * FROM tb_list_order

        LEFT JOIN tb_order ON  tb_order.id_order = tb_list_order.kode_order
        LEFT JOIN tb_daftar_menu ON  tb_daftar_menu.id = tb_list_order.menu
        LEFT JOIN tb_bayar ON  tb_bayar.id_bayar = tb_order.id_order
        GROUP BY id_list_order ORDER BY id_list_order ASC");

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
            Halaman Dapur
        </div>
        <div class="card-body">

            <?php
            if (empty($result)) {
                echo "Tidak Ada Data Order Item!";
            } else {
                foreach ($result as $row) {
            ?>
                    <!-- Modal Terima -->
                    <div class="modal fade" id="terima<?php echo $row['id_list_order']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-6" id="exampleModalLabel">Item Menu Makanan dan Minuman </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_terima_orderitem.php" method="POST">
                                        <input type="hidden" name="id" value="<?= $row['id_list_order']; ?>">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="form-floating mb-4">
                                                    <select disabled class="form-select" name="menu" id="menu" aria-label="Default select example" required>
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
                                                    <input disabled type="number" value="<?= $row['jumlah'] ?>" name="jumlah" class="form-control" id="floatingInput" placeholder="Jumlah Porsi" required>
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
                                            <button type="submit" name="terima_order_validate" value="12345" class="btn btn-primary btn-sm">Terima Order</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Akhir Modal Terima-->

                    <!-- Modal Siap Saji -->
                    <div class="modal fade" id="siapsaji<?php echo $row['id_list_order']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-6" id="exampleModalLabel">Item Menu Makanan dan Minuman </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_siapsaji_orderitem.php" method="POST">
                                        <input type="hidden" name="id" value="<?= $row['id_list_order']; ?>">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="form-floating mb-4">
                                                    <select disabled class="form-select" name="menu" id="menu" aria-label="Default select example" required>
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
                                                    <input disabled type="number" value="<?= $row['jumlah'] ?>" name="jumlah" class="form-control" id="floatingInput" placeholder="Jumlah Porsi" required>
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
                                            <button type="submit" name="siap_order_validate" value="12345" class="btn btn-primary btn-sm">Siap Saji</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Akhir Siap Saji -->

                <?php
                }
                ?>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-nowrap">
                                <th scope="col">No</th>
                                <th scope="col">Kode Order</th>
                                <th scope="col">Waktu Order</th>
                                <th scope="col">Menu</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Catatan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($result as $row) {
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['kode_order']; ?></td>
                                    <td><?php echo $row['waktu_order']; ?></td>
                                    <td><?php echo $row['nama_menu']; ?></td>
                                    <td><?php echo $row['jumlah']; ?></td>
                                    <td><?php echo $row['catatan']; ?></td>
                                    <td>
                                        <?php
                                        if ($row['status'] == 1) {
                                            echo "<span class='badge text-bg-warning'>proses</span>";
                                        } elseif ($row['status'] == 2) {
                                            echo "<span class='badge text-bg-success'>siap saji</span>";
                                        }
                                        ?>
                                    </td>
                                    <td class="">
                                        <div class="row">
                                            <div class="col d-flex text-nowrap">
                                                <button class="<?= (!empty($row['status'])) ? "btn btn-secondary btn-sm me-1 disabled" : "btn btn-warning btn-sm me-1"; ?>" data-bs-toggle="modal" data-bs-target="#terima<?php echo $row['id_list_order']; ?>">Terima</button>
                                                <button class="<?= (empty($row['status']) || $row['status'] != 1) ? "btn btn-secondary btn-sm me-1 disabled" : "btn btn-success btn-sm me-1"; ?>" data-bs-toggle="modal" data-bs-target="#siapsaji<?php echo $row['id_list_order']; ?>">Siap Saji</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            } ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        </div>
    </div>
</div>