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
                            <label>Nama Karyawan</label>
                            <?php
                            $query = "SELECT * FROM karyawan WHERE jabatan!='Mekanik' AND id_karyawan NOT IN (SELECT id_karyawan FROM user)";
                            $result = $this->db->query($query)->result_array();
                            ?>
                            <div class="col-sm">
                                <select class="form-control" id="id_karyawan" name="id_karyawan">
                                    <option value="">Pilih Karyawan</option>
                                    <?php foreach ($result as $karyawan) : ?>
                                        <option value="<?= $karyawan['id_karyawan']; ?>"><?= $karyawan['nm_karyawan']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('id_karyawan', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm">
                                <input type="hidden" class="form-control" id="nm_karyawan" name="nm_karyawan" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <div class="col-sm">
                                <select class="form-control" id="id_role" name="id_role">
                                    <option value="">Pilih Role</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Owner</option>
                                </select>
                                <?= form_error('id_role', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="username" name="username" maxlength="30" placeholder="Masukkan username">
                                <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <div class="col-sm">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" maxlength="10" placeholder="Masukkan password">
                                    <div class="input-group-append">
                                        <span id="eye-button" onclick="change()" class="input-group-text">
                                            <i class="fas fa-fw fa-eye" title="tampilkan password"></i>
                                        </span>
                                    </div>
                                </div>
                                <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Status Akun</label>
                            <div class="col-sm">
                                <select class="form-control" id="status_akun" name="status_akun">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                </select>
                                <?= form_error('status_akun', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <a href="<?= base_url('ManajemenKaryawan'); ?>" title="Kembali ke halaman Pengguna" class="btn btn-sm btn-secondary font-weight-bold mt-3">Kembali</a>
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