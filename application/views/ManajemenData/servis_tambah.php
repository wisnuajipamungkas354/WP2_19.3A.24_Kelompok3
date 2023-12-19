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
                            <label>ID Servis</label>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="id_servis" name="id_servis" value="<?= $id_servis; ?>" readonly>
                                <?= form_error('id_servis', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>ID Pelanggan</label>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan" value="<?= $id_pelanggan; ?>" readonly>
                                <?= form_error('id_pelanggan', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Pelanggan</label>
                            <div class="col-sm">
                                <input type="text" class="form-control text-capitalize" id="nm_pelanggan" name="nm_pelanggan" maxlength="30" placeholder="Masukkan nama pelanggan" value="<?= set_value('nm_pelanggan'); ?>">
                                <?= form_error('nm_pelanggan', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>No. Telepon Pelanggan</label>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="no_hp" name="no_hp" maxlength="15" placeholder="Masukkan no. telepon pelanggan" value="<?= set_value('no_hp'); ?>">
                                <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Merk & Tipe Laptop</label>
                            <div class="col-sm">
                                <input type="text" class="form-control text-capitalize" id="tipe_laptop" name="tipe_laptop" maxlength="35" placeholder="Masukkan Merk & Tipe Laptop" value="<?= set_value('tipe_laptop'); ?>">
                                <?= form_error('tipe_laptop', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Keluhan Awal</label>
                            <div class="col-sm">
                                <textarea class="form-control" id="keluhan_awal" name="keluhan_awal" placeholder="Masukkan Keluhan" value="<?= set_value('keluhan_awal'); ?>"></textarea>
                                <?= form_error('keluhan_awal', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Teknisi</label>
                            <?php
                            $query = "SELECT * FROM karyawan WHERE jabatan='Teknisi'";
                            $result = $this->db->query($query)->result_array();
                            ?>
                            <div class="col-sm">
                                <select class="form-control" id="nm_teknisi" name="nm_teknisi">
                                    <option value="">Pilih Teknisi</option>
                                    <?php foreach ($result as $teknisi) : ?>
                                        <option value="<?= $teknisi['nm_karyawan']; ?>"><?= $teknisi['nm_karyawan']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('nm_teknisi', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>List Rekomendasi Servis</label>
                            <table class="table table-responsive-sm">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Id Part</th>
                                        <th scope="col">Nama Part</th>
                                        <th scope="col" style="text-align: right;">Biaya</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <hr>
                            <div class="col-sm">
                                <select class="selectpicker form-control" id="part" name="part" data-live-search="true" data-size="5">
                                    <option value="">Pilih Part Yang Akan Diganti</option>
                                    <?php foreach ($part as $p) : ?>
                                        <option data-id="<?= $p['id_part'] ?>" data-harga="<?= $p['harga_part'] ?>" value="<?= $p['nm_part']; ?>"><?= $p['nm_part']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('nm_part', '<small class="text-danger pl-3">', '</small>'); ?>
                                <br>
                                <button type="button" class="btn btn-sm btn-primary font-weight-bold my-2" id="tombol-add">Add Part</button>
                            </div>
                        </div>
                        <hr>
                        <a href="<?= base_url('ManajemenData'); ?>" title="Kembali ke halaman Servis" class="btn btn-sm btn-secondary font-weight-bold mt-3">Kembali</a>
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