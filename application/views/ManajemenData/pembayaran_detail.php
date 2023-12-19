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
            <form action="" method="post">
                <div class="card mb-4">
                    <div class="card-body text-dark">
                        <table>
                            <tr>
                                <td class="font-weight-bold">No. Nota</td>
                                <td>: <?= $detail_pembayaran['no_nota']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Nama Admin</td>
                                <td>: <?= $detail_pembayaran['nm_admin']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tanggal</td>
                                <td>: <?= $detail_pembayaran['tgl']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">ID Servis</td>
                                <td>: <?= $detail_pembayaran['id_servis']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Nama Pelanggan</td>
                                <td>: <?= $detail_pembayaran['nm_pelanggan']; ?></td>
                            </tr>
                            <tr>
                            <tr>
                                <td class="font-weight-bold">Merk & Tipe Laptop</td>
                                <td>: <?= $detail_pembayaran['tipe_laptop']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Keluhan Awal</td>
                                <td>: <?= $detail_pembayaran['keluhan_awal']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Nama Teknisi</td>
                                <td>: <?= $detail_pembayaran['nm_teknisi']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Harga</td>
                                <td>: Rp <?= number_format($detail_pembayaran['total_harga'], 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Biaya Jasa</td>
                                <td>: Rp <?= number_format($detail_pembayaran['biaya_jasa'], 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Total</td>
                                <td>: Rp <?= number_format($detail_pembayaran['total'], 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="<?= base_url('ManajemenData/pembayaran'); ?>" title="Kembali ke halaman Pembayaran" class="btn btn-sm btn-secondary font-weight-bold mt-3">Kembali</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->