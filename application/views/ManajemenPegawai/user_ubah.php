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
                            <label>ID Pegawai</label>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="id_pegawai" name="id_pegawai" value="<?= $ubah_user['id_pegawai']; ?>" readonly>
                                <?= form_error('id_pegawai', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Pegawai</label>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="nm_pegawai" name="nm_pegawai" value="<?= $ubah_user['nama_pegawai']; ?>" readonly>
                                <?= form_error('nm_pegawai', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <div class="col-sm">
                                <select class="form-control" id="id_role" name="id_role">
                                    <?php foreach ($role as $r) : ?>
                                        <?php if ($r == $ubah_user['id_role']) : ?>
                                            <option value="<?= $r; ?>" selected>
                                                <?php
                                                if ($r == 1) {
                                                    echo "Admin";
                                                } else {
                                                    echo "Manajer";
                                                }
                                                ?>
                                            </option>
                                        <?php else : ?>
                                            <option value="<?= $r; ?>">
                                                <?php
                                                if ($r == 1) {
                                                    echo "Admin";
                                                } else {
                                                    echo "Manajer";
                                                }
                                                ?>
                                            </option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('id_role', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="username" name="username" maxlength="30" value="<?= $ubah_user['username']; ?>">
                                <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <div class="col-sm">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" maxlength="10" value="<?= $ubah_user['password']; ?>">
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
                                    <?php foreach ($status as $s) : ?>
                                        <?php if ($s == $ubah_user['status_akun']) : ?>
                                            <option value="<?= $s; ?>" selected><?= $s; ?></option>
                                        <?php else : ?>
                                            <option value="<?= $s; ?>"><?= $s; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('status_akun', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <a href="<?= base_url('ManajemenPegawai'); ?>" title="Kembali ke halaman Pengguna" class="btn btn-sm btn-secondary font-weight-bold mt-3">Kembali</a>
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