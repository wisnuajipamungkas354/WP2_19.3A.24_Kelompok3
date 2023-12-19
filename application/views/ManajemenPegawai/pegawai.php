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

            <?php if (empty($data_pegawai)) : ?>
                <div class="alert alert-warning" role="alert"><i class="fas fa-exclamation-circle"></i><span> Data Pegawai tidak ditemukan!</span></div>
            <?php endif; ?>

            <!-- Table -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a href="<?= base_url('ManajemenPegawai/pegawai_tambah'); ?>" title="Tambah Data" class="btn btn-success font-weight-bold"><i class="fas fa-fw fa-plus"></i> Tambah</a>
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
                        <table class="table" id="table" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-dark">
                                    <th bgcolor="#b2cef9">#</th>
                                    <th bgcolor="#b2cef9">ID Pegawai</th>
                                    <th bgcolor="#b2cef9">Nama Pegawai</th>
                                    <th bgcolor="#b2cef9">No. Telepon</th>
                                    <th bgcolor="#b2cef9">Jabatan</th>
                                    <th bgcolor="#b2cef9"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($data_pegawai as $pegawai) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $pegawai['id_pegawai']; ?></td>
                                        <td><?= $pegawai['nm_pegawai']; ?></td>
                                        <td><?= $pegawai['noTlp_pegawai']; ?></td>
                                        <td><?= $pegawai['jabatan']; ?></td>
                                        <td style="text-align: center;">
                                            <a href="<?= base_url('ManajemenPegawai/pegawai_ubah/'); ?><?= $pegawai['id_pegawai']; ?>" title="Ubah" class="btn btn-circle btn-warning my-1"><i class="fas fa-fw fa-edit"></i></a>
                                            <a href="<?= base_url('ManajemenPegawai/pegawai_hapus/'); ?><?= $pegawai['id_pegawai']; ?>" title="Hapus" class="btn btn-danger btn-circle delete-pegawai"><i class="fas fa-fw fa-trash"></i></a>
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