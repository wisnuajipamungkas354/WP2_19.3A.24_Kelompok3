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
                <div class="alert alert-warning" role="alert"><i class="fas fa-exclamation-circle"></i> Data Laporan yang dicari tidak ditemukan!</div>
            <?php endif; ?>

            <!-- Table -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
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
                                    <th bgcolor="#b2cef9">ID Laporan</th>
                                    <th bgcolor="#b2cef9">Tanggal</th>
                                    <th bgcolor="#b2cef9">No. Nota</th>
                                    <th bgcolor="#b2cef9">Total</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <?php
                                $sql = "SELECT SUM(total) FROM laporan";
                                $result = $this->db->query($sql)->row_array();
                                ?>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th class="text-dark">Jumlah : Rp <?= number_format($result['SUM(total)'], 0, ',', '.'); ?></th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($data_laporan as $laporan) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $laporan['id_laporan']; ?></td>
                                        <td><?= $laporan['tgl']; ?></td>
                                        <td><?= $laporan['no_nota']; ?></td>
                                        <td>Rp <?= number_format($laporan['total'], 0, ',', '.'); ?></td>
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