<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card h4 mt-2 mb-4 border-bottom-success font-weight-bold text-secondary bg-light border-0 rounded-0">
        <div class="card-body text-dark">
            <?= $title; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">

            <?= $this->session->flashdata('message'); ?>

            <?php if (empty($data_user)) : ?>
                <div class="alert alert-warning" role="alert"><i class="fas fa-exclamation-circle"></i><span> Data Pengguna yang dicari tidak ditemukan!</span></div>
            <?php endif; ?>

            <!-- Table -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a href="<?= base_url('ManajemenKaryawan/user_tambah'); ?>" title="Tambah Data" class="btn btn-success font-weight-bold"><i class="fas fa-fw fa-plus"></i> Tambah</a>
                    <button id="btn-refresh" class="btn btn-primary box-title" title="Refresh Data"><i class="fas fa-fw fa-sync-alt"></i></button>

                    <form action="" method="post" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search float-right">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" name="keyword" placeholder="Cari">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm" title="Cari data"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-dark">
                                    <th bgcolor="#b2cef9">#</th>
                                    <th bgcolor="#b2cef9">ID Karyawan</th>
                                    <th bgcolor="#b2cef9">Nama Karyawan</th>
                                    <th bgcolor="#b2cef9">Role</th>
                                    <th bgcolor="#b2cef9">Username</th>
                                    <th bgcolor="#b2cef9">Status Akun</th>
                                    <th bgcolor="#b2cef9"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($data_user as $user) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $user['id_karyawan']; ?></td>
                                        <td><?= $user['nm_karyawan']; ?></td>
                                        <?php
                                        if ($user['id_role'] == 1) {
                                            echo "<td>Admin</td>";
                                        } else if ($user['id_role'] == 2) {
                                            echo "<td>Owner</td>";
                                        }
                                        ?>
                                        <td><?= $user['username']; ?></td>
                                        <td><?= $user['status_akun']; ?></td>
                                        <td style="text-align: center;">
                                            <?php if ($user['nm_karyawan'] == $userasli['nm_karyawan']) { ?>
                                                <a href="<?= base_url('ManajemenKaryawan/user_ubah/'); ?><?= base64_encode($user['id_karyawan']); ?>" title="Ubah" class="btn btn-circle btn-warning my-1" hidden><i class="fas fa-fw fa-edit"></i></a>
                                            <?php } else { ?>
                                                <a href="<?= base_url('ManajemenKaryawan/user_ubah/'); ?><?= base64_encode($user['id_karyawan']); ?>" title="Ubah" class="btn btn-circle btn-warning my-1"><i class="fas fa-fw fa-edit"></i></a>
                                            <?php }; ?>
                                            <?php if ($user['nm_karyawan'] == $userasli['nm_karyawan']) { ?>
                                                <a href="<?= base_url('ManajemenKaryawan/user_hapus/'); ?><?= base64_encode($user['id_karyawan']); ?>" title="Hapus" class="btn btn-danger btn-circle delete-pengguna" hidden><i class="fas fa-fw fa-trash"></i></a>
                                            <?php } else { ?>
                                                <a href="<?= base_url('ManajemenKaryawan/user_hapus/'); ?><?= base64_encode($user['id_karyawan']); ?>" title="Hapus" class="btn btn-danger btn-circle delete-pengguna"><i class="fas fa-fw fa-trash"></i></a>
                                            <?php }; ?>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->