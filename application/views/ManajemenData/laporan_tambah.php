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
                                                 <label>ID Laporan</label>
                                                 <div class="col-sm">
                                                     <input type="text" class="form-control" id="id_laporan" name="id_laporan" value="<?= $id_laporan; ?>" readonly>
                                                 </div>
                                             </div>
                                             <div class="form-group">
                                                 <label>No. Nota</label>
                                                 <?php
                                                    $query = "SELECT * FROM pembayaran WHERE no_nota NOT IN (SELECT no_nota FROM laporan)";
                                                    $result = $this->db->query($query)->result_array();
                                                    ?>
                                                 <div class="col-sm">
                                                     <select class="form-control" id="no_nota" name="no_nota">
                                                         <option value="">Pilih No. Nota</option>
                                                         <?php foreach ($result as $nota) : ?>
                                                             <option value="<?= $nota['no_nota']; ?>"><?= $nota['no_nota']; ?></option>
                                                         <?php endforeach; ?>
                                                     </select>
                                                     <?= form_error('no_nota', '<small class="text-danger pl-3">', '</small>'); ?>
                                                 </div>
                                             </div>
                                             <div class="form-group">
                                                 <label>Total</label>
                                                 <div class="col-sm">
                                                     <input type="text" class="form-control" id="total" name="total" readonly>
                                                 </div>
                                             </div>

                                             <a href="<?= base_url('ManajemenData/laporan'); ?>" title="Kembali ke halaman Laporan" class="btn btn-sm btn-secondary font-weight-bold mt-3">Kembali</a>
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