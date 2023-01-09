<?php
include "proses/connect.php";

$query = mysqli_query($conn, "SELECT *, SUM(harga*jumlah) AS harganya FROM tb_list_order

        LEFT JOIN tb_order ON  tb_order.id_order = tb_list_order.order
        LEFT JOIN tb_daftar_menu ON  tb_daftar_menu.id = tb_list_order.menu
        GROUP BY id_list_order
        HAVING tb_list_order.order = $_GET[order] ");

while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
    $kode = $record['kode_order'];
    $meja = $record['meja'];
    $pelanggan = $record['pelanggan'];
}

// $select_kat_menu = mysqli_query($conn, "SELECT id_kat_menu,kategori_menu FROM tb_kategori_menu");
?>



<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Halaman Order Item
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="kodeOrder" value="<?= $kode; ?>">
                        <label for="kodeOrder">Kode Order</label>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-floating mb-3">
                        <input disabled type="text" value="<?= $meja; ?>" class="form-control" id="floatingInput">
                        <label for="floatingInput">Meja</label>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-floating mb-3">
                        <input disabled type="text" value="<?= $pelanggan; ?>" class="form-control" id="floatingInput">
                        <label for="floatingInput">Pelanggan</label>
                    </div>
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
                            <form class="needs-validation" novalidate action="proses/proses_input_menu.php" method="POST" enctype="multipart/form-data">
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
                                    <select class="form-select" name="kategori_menu" aria-label="Default select example" required>
                                        <option selected hidden value="">Pilih Kategori Menu</option>
                                        <?php
                                        foreach ($select_kat_menu as $value) {
                                            echo "<option value=" . $value['id_kat_menu'] . ">$value[kategori_menu]</option>";
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
            if (empty($result)) {
                echo "Data Order Item Tidak Ada!";
            } else {
                foreach ($result as $row) {
            ?>
                    <!-- Modal View Menu -->
                    <div class="modal fade" id="ModalView<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-6" id="exampleModalLabel"><i class="bi bi-eye"></i> View Menu Makanan dan Minuman </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_input_menu.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-floating mb-3">
                                            <input disabled type="text" class="form-control" value="<?php echo $row['nama_menu']; ?>">
                                            <label for="floatingInput">Nama Menu</label>
                                            <div class="invalid-feedback">
                                                Masukan Nama Menu!
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <textarea disabled class="form-control" id="floatingInput" cols="30" rows="10" style="height: 80px;"><?php echo $row['keterangan']; ?></textarea>
                                            <label for="floatingInput">Keterangan</label>
                                            <div class="invalid-feedback">
                                                Masukan Keterangan!
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select disabled class="form-select" aria-label="Default select example">
                                                <option selected hidden value="">Pilih Kategori Menu</option>
                                                <?php
                                                foreach ($select_kat_menu as $value) {
                                                    if ($row['kategori'] == $value['id_kat_menu']) {
                                                        echo "<option selected value=" . $value['id_kat_menu'] . ">$value[kategori_menu]</option>";
                                                    } else {
                                                        echo "<option value=" . $value['id_kat_menu'] . ">$value[kategori_menu]</option>";
                                                    }
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
                                                    <input disabled type="number" class="form-control" id="floatingInput" value="<?php echo $row['harga']; ?>">
                                                    <label for="floatingInput">Harga</label>
                                                    <div class="invalid-feedback">
                                                        Masukan Harga Menu!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <input disabled type="number" value="<?php echo $row['stok']; ?>" class="form-control" id="floatingInput">
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
                    <!-- Akhir Modal View Menu-->

                    <!-- Modal Edit Menu -->
                    <div class="modal fade" id="ModalEdit<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-6" id="exampleModalLabel"><i class="bi bi-pencil-square"></i> Edit Menu Makanan dan Minuman </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_edit_menu.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" value="<?php echo $row['id']; ?>" name="id">
                                        <div class="input-group mb-3">
                                            <input type="file" class="form-control" name="foto" id="uploadFoto" placeholder="Upload Foto Menu Makanan dan Minuman" required>
                                            <label class="input-group-text" for="uploadFoto">Upload Foto Menu</label>
                                            <div class="invalid-feedback">
                                                Masukan Foto Menu !
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="nama_menu" id="floatingInput" placeholder="nama menu" required value="<?php echo $row['nama_menu']; ?>">
                                            <label for="floatingInput">Nama Menu</label>
                                            <div class="invalid-feedback">
                                                Masukan Nama Menu!
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" name="keterangan" id="floatingInput" cols="30" rows="10" style="height: 80px;" required><?php echo $row['keterangan']; ?> </textarea>
                                            <label for="floatingInput">Keterangan</label>
                                            <div class="invalid-feedback">
                                                Masukan Keterangan!
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select" aria-label="Default select example" name="kategori_menu">
                                                <option selected hidden value="">Pilih Kategori Menu</option>
                                                <?php
                                                foreach ($select_kat_menu as $value) {
                                                    if ($row['kategori'] == $value['id_kat_menu']) {
                                                        echo "<option selected value=" . $value['id_kat_menu'] . ">$value[kategori_menu]</option>";
                                                    } else {
                                                        echo "<option value=" . $value['id_kat_menu'] . ">$value[kategori_menu]</option>";
                                                    }
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
                                                    <input type="number" name="harga" class="form-control" id="floatingInput" placeholder="harga" value="<?php echo $row['harga']; ?>" required>
                                                    <label for="floatingInput">Harga</label>
                                                    <div class="invalid-feedback">
                                                        Masukan Harga Menu!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <input type="number" name="stok" class="form-control" id="floatingInput" placeholder="120" value="<?php echo $row['stok']; ?>" required>
                                                    <label for="floatingInput">Stok</label>
                                                    <div class="invalid-feedback">
                                                        Masukan Stok Menu!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="input_edit_validate" value="12345" class="btn btn-primary btn-sm">Tambahkan Menu</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Akhir Modal Edit Menu-->

                    <!-- Modal Hapus -->
                    <div class="modal fade" id="ModalHapus<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-6" id="exampleModalLabel"><i class="bi bi-trash"></i> Hapus Data Menu </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_hapus_menu.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" name="foto" value="<?php echo $row['foto']; ?>">
                                        <div class="col lg-12 text-center mb-3">
                                            Apakah anda ingin menghapus menu <b><?php echo $row['nama_menu'] ?></b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="input_hapus_validate" value="12345" class="btn btn-danger btn-sm">Hapus</button>
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
                                <th scope="col">Total</th>
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
                                    <td><?php echo number_format($row['jumlah']); ?></td>
                                    <td>Rp. <?php echo $row['harganya']; ?></td>
                                    <td class="">
                                        <div class="row">
                                            <div class="col d-flex">
                                                <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalView<?php echo $row['id_order']; ?>"><i class="bi bi-eye"></i></button>
                                                <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id_order']; ?>"><i class="bi bi-pencil-square"></i></button>
                                                <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalHapus<?php echo $row['id_order']; ?>"><i class="bi bi-trash"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                                $total += $row['harganya'];
                            } ?>
                            <tr>
                                <td colspan="3" class="fw-bold">
                                    Total Harga
                                </td>
                                <td class="fw-bold">
                                    Rp. <?= number_format($total); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- tombol -->
                    <div class="mb-3">
                        <button class="btn btn-primary"><i class="bi bi-plus-circle"></i> Item</button>
                        <button class="btn btn-success"><i class="bi bi-cash-coin"></i> Bayar</button>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>