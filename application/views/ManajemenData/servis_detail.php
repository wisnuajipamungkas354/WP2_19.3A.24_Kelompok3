                     <!-- Begin Page Content -->
                     <div class="container-fluid">

                         <!-- Page Heading -->
                         <div class="card h4 mt-2 mb-4 border-bottom-success font-weight-bold text-secondary bg-light border-0 rounded-0">
                             <div class="card-body text-dark">
                                 <?= $title; ?>
                             </div>
                         </div>
                         <form action="" method="post">
                             <div class="card mb-4">
                                 <div class="card-body text-dark">
                                     <div class="row">
                                         <div class="col-sm">
                                             <table>
                                                 <tr>
                                                     <td class="font-weight-bold">ID Servis</td>
                                                     <td>: <?= $riwayat_servis['id_servis']; ?></td>
                                                 </tr>
                                                 <tr>
                                                     <td class="font-weight-bold">Tanggal</td>
                                                     <td>: <?= $riwayat_servis['tgl']; ?></td>
                                                 </tr>
                                                 <tr>
                                                     <td class="font-weight-bold">ID Pelanggan</td>
                                                     <td>: <?= $riwayat_servis['id_pelanggan']; ?></td>
                                                 </tr>
                                                 <tr>
                                                     <td class="font-weight-bold">Nama Pelanggan</td>
                                                     <td>: <?= $riwayat_servis['nm_pelanggan']; ?></td>
                                                 </tr>
                                                 <tr>
                                                     <td class="font-weight-bold"> No. Telepon</td>
                                                     <td>: <?= $riwayat_servis['no_hp']; ?></td>
                                                 </tr>
                                                 <tr>
                                                     <td class="font-weight-bold"> Merk & Tipe Laptop</td>
                                                     <td>: <?= $riwayat_servis['tipe_laptop']; ?></td>
                                                 </tr>
                                                 <tr>
                                                     <td class="font-weight-bold">Keluhan</td>
                                                     <td>: <?= $riwayat_servis['keluhan_awal']; ?></td>
                                                 </tr>
                                                 <tr>
                                                     <td class="font-weight-bold">Nama Teknisi</td>
                                                     <td>: <?= $riwayat_servis['nm_teknisi']; ?></td>
                                                 </tr>
                                             </table>
                                         </div>
                                         <div class="col-sm">
                                             <h6 class="font-weight-bold mt-4">List Rekomendasi Servis</h6>
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
                                                     <?php foreach ($detail_servis as $ds) : ?>
                                                         <tr>
                                                             <td><?= $ds['id_part'] ?></td>
                                                             <td><?= $ds['nm_part'] ?></td>
                                                             <td style="text-align:right;"><?= $ds['harga'] ?></td>
                                                         </tr>
                                                     <?php endforeach ?>
                                                     <tr>
                                                         <td colspan="2" style="text-align: right;" class="font-weight-bold">Total</td>
                                                         <?php foreach ($total_harga as $total) : ?>
                                                             <td style="text-align: right;" class="font-weight-bold"><?= $total['harga'] ?></td>
                                                         <?php endforeach ?>
                                                     </tr>
                                                 </tbody>
                                             </table>
                                         </div>
                                     </div>
                                     <a href="<?= base_url('ManajemenData'); ?>" title="Kembali ke halaman Servis" class="btn btn-sm btn-secondary font-weight-bold mt-3">Kembali</a>
                                 </div>
                             </div>
                         </form>
                     </div>
                     </div>
                     <!-- /.container-fluid -->

                     </div>
                     <!-- End of Main Content -->