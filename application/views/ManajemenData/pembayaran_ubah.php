<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card h4 mt-2 mb-4 border-bottom-success font-weight-bold text-secondary bg-light border-0 rounded-0">
        <div class="card-body text-dark">
            <?= $title; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-7">
            <form action="" method="post">
                <div class="card mb-4">
                    <div class="card-body text-dark font-weight-bold">
                        <div class="form-group">
                            <label>No. Nota</label>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="no_nota" name="no_nota" value="<?= $ubah_pembayaran['no_nota']; ?>" readonly>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" id="nm_admin" name="nm_admin" value="<?= $user['nm_karyawan']; ?>">
                        <div class="form-group">
                            <label>ID Servis</label>
                            <?php
                            $query = "SELECT * FROM servis";
                            $result = $this->db->query($query)->result_array();
                            ?>
                            <div class="col-sm">
                                <select class="form-control" id="id_servis" name="id_servis">
                                    <?php foreach ($result as $s) : ?>
                                        <?php if ($s['id_servis'] == $ubah_pembayaran['id_servis']) : ?>
                                            <option value="<?= $s['id_servis']; ?>" selected><?= $s['id_servis']; ?></option>
                                        <?php else : ?>
                                            <option value="<?= $s['id_servis']; ?>"><?= $s['id_servis']; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('id_servis', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Pelanggan</label>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="nm_pelanggan" name="nm_pelanggan" value="<?= $ubah_pembayaran['nm_pelanggan']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Merk & Tipe Laptop</label>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="tipe_laptop" name="tipe_laptop" value="<?= $ubah_pembayaran['tipe_laptop']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Keluhan Awal</label>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="keluhan_awal" name="keluhan_awal" value="<?= $ubah_pembayaran['keluhan_awal']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Teknisi</label>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="nm_teknisi" name="nm_teknisi" value="<?= $ubah_pembayaran['nm_teknisi']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <div class="col-sm">
                                <input type="number" class="form-control" id="total_harga" name="total_harga" value="<?= $ubah_pembayaran['total_harga']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Biaya Jasa</label>
                            <div class="col-sm">
                                <input type="number" class="form-control" id="biaya_jasa" name="biaya_jasa" value="<?= $ubah_pembayaran['biaya_jasa']; ?>">
                                <?= form_error('jasa', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <a href="<?= base_url('ManajemenData/pembayaran'); ?>" title="Kembali ke halaman Pembayaran" class="btn btn-sm btn-secondary font-weight-bold mt-3">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-success font-weight-bold ml-2 mt-3">Simpan</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->