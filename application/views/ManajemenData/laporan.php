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

            <?php if (empty($data_laporan)) : ?>
                <div class="alert alert-warning" role="alert"><i class="fas fa-exclamation-circle"></i> Data Laporan tidak ditemukan!</div>
            <?php endif; ?>

            <!-- Table -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a href="<?= base_url('ManajemenData/laporan_tambah'); ?>" title="Tambah Data" class="btn btn-success font-weight-bold"><i class="fas fa-fw fa-plus"></i> Tambah</a>
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
                                    <th bgcolor="#b2cef9">ID Laporan</th>
                                    <th bgcolor="#b2cef9">Tanggal</th>
                                    <th bgcolor="#b2cef9">No. Nota</th>
                                    <th bgcolor="#b2cef9">Total</th>
                                    <th bgcolor="#b2cef9"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($data_laporan as $laporan) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $laporan['id_laporan']; ?></td>
                                        <td><?= $laporan['tgl']; ?></td>
                                        <td><?= $laporan['no_nota']; ?></td>
                                        <td>Rp <?= number_format($laporan['total'], 0, ',', '.'); ?></td>
                                        <td style="text-align: center;">
                                            <a href="<?= base_url('ManajemenData/laporan_ubah/'); ?><?= $laporan['id_laporan']; ?>" title="Ubah" class="btn btn-circle btn-warning my-1"><i class="fas fa-fw fa-edit"></i></a>
                                            <a href="<?= base_url('ManajemenData/laporan_hapus/'); ?><?= $laporan['id_laporan']; ?>" title="Hapus" class="btn btn-danger btn-circle delete-laporan"><i class="fas fa-fw fa-trash"></i></a>
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

    <!-- Delete Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin ingin menghapus data?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih tombol 'Hapus' jika kamu ingin menghapus data yang dipilih</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-danger" href="<?= base_url('ManajemenData/laporan_hapus/'); ?><?= $laporan['id_laporan']; ?>">Hapus</a>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->