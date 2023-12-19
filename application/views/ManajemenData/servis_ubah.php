                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <div class="card h4 mt-2 mb-4 border-bottom-success font-weight-bold text-secondary bg-light border-0 rounded-0">
                            <div class="card-body text-dark">
                                <?= $title; ?>
                            </div>
                        </div>
                        <?= $this->session->flashdata('message'); ?>
                        <div class="row">
                            <div class="col-lg-7">
                                <form action="" method="post">
                                    <div class="card mb-4">
                                        <div class="card-body text-dark font-weight-bold">
                                            <div class="form-group">
                                                <label>ID Servis</label>
                                                <div class="col-sm">
                                                    <input type="text" class="form-control" id="id_servis" name="id_servis" value="<?= $ubah_servis['id_servis']; ?>" readonly>
                                                    <?= form_error('id_servis', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>ID Pelanggan</label>
                                                <div class="col-sm">
                                                    <input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan" value="<?= $ubah_servis['id_pelanggan']; ?>" readonly>
                                                    <?= form_error('id_pelanggan', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Pelanggan</label>
                                                <div class="col-sm">
                                                    <input type="text" class="form-control text-capitalize" id="nm_pelanggan" name="nm_pelanggan" maxlength="30" value="<?= $ubah_servis['nm_pelanggan']; ?>">
                                                    <?= form_error('nm_pelanggan', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>No. Telepon Pelanggan</label>
                                                <div class="col-sm">
                                                    <input type="text" class="form-control" id="no_hp" name="no_hp" maxlength="15" value="<?= $ubah_servis['no_hp']; ?>">
                                                    <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Merk & Tipe Laptop</label>
                                                <div class="col-sm">
                                                    <input type="text" class="form-control text-capitalize" id="tipe_laptop" name="tipe_laptop" maxlength="30" value="<?= $ubah_servis['tipe_laptop']; ?>">
                                                    <?= form_error('merk', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Keluhan Awal</label>
                                                <div class="col-sm">
                                                    <textarea class="form-control" id="keluhan_awal" name="keluhan_awal"><?= $ubah_servis['keluhan_awal']; ?></textarea>
                                                    <?= form_error('keluhan', '<small class="text-danger pl-3">', '</small>'); ?>
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
                                                            <?php if ($teknisi['nm_karyawan'] == $ubah_servis['nm_teknisi']) : ?>
                                                                <option value="<?= $teknisi['nm_karyawan']; ?>" selected><?= $teknisi['nm_karyawan']; ?></option>
                                                            <?php else : ?>
                                                                <option value="<?= $teknisi['nm_karyawan']; ?>"><?= $teknisi['nm_karyawan']; ?></option>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <?= form_error('nm_teknisi', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                            </div>

                                            <div class="col-sm">
                                                <div class="form-group">
                                                    <h6 class="font-weight-bold mt-4">List Rekomendasi Servis</h6>
                                                    <table class="table table-responsive-sm" id="upTable">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th scope="col">Id Part</th>
                                                                <th scope="col">Nama Part</th>
                                                                <th scope="col" style="text-align: right;">Biaya</th>
                                                                <th scope="col"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($detail_servis as $ds) : ?>
                                                                <tr>
                                                                    <th scope="row" style="width:15%;">
                                                                        <input type="text" class="form-control-plaintext" name="id_part[]" value="<?= $ds['id_part'] ?>" readonly>
                                                                    </th>
                                                                    <td style="width:65%;">
                                                                        <input type="text" class="form-control-plaintext" name="nm_part[]" value="<?= $ds['nm_part'] ?>" readonly>
                                                                    </td>
                                                                    <td style="width:15%;">
                                                                        <input type="text" class="form-control-plaintext val-harga" name="harga[]" style="text-align:right;" value="<?= $ds['harga'] ?>" readonly>
                                                                    </td>
                                                                    <td style="width:5%;">
                                                                        <button type="button" id="tombol-hapus" class="delete btn btn-sm btn-danger btn-circle">
                                                                            <i class="fas fa-fw fa-trash"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
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
                                            <div class="form-group">
                                                <label>Total Biaya</label>
                                                <div class="col-sm">
                                                    <input type="text" class="form-control" id="total_sum_value" name="total_harga" value="" readonly>
                                                </div>
                                            </div>

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