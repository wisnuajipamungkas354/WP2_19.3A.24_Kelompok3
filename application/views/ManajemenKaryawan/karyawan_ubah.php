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
                                                 <label>ID Karyawan</label>
                                                 <div class="col-sm">
                                                     <div class="col-sm">
                                                         <input type="text" class="form-control" id="id_karyawan" name="id_karyawan" value="<?= $ubah_karyawan['id_karyawan']; ?>" readonly>
                                                         <?= form_error('id_karyawan', '<small class="text-danger pl-3">', '</small>'); ?>
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="form-group">
                                                 <label>Nama karyawan</label>
                                                 <div class="col-sm">
                                                     <input type="text" class="form-control text-capitalize" id="nm_karyawan" name="nm_karyawan" maxlength="30" value="<?= $ubah_karyawan['nm_karyawan']; ?>">
                                                     <?= form_error('nm_karyawan', '<small class="text-danger pl-3">', '</small>'); ?>
                                                 </div>
                                             </div>
                                             <div class="form-group">
                                                 <label>No Telepon Karyawan</label>
                                                 <div class="col-sm">
                                                     <input type="text" class="form-control" id="noTlp" name="noTlp" maxlength="15" value="<?= $ubah_karyawan['noHp_karyawan']; ?>">
                                                     <?= form_error('noTlp', '<small class="text-danger pl-3">', '</small>'); ?>
                                                 </div>
                                             </div>
                                             <div class="form-group">
                                                 <label>Jabatan</label>
                                                 <div class="col-sm">
                                                     <select class="form-control" id="jabatan" name="jabatan">
                                                         <?php foreach ($jabatan as $j) : ?>
                                                             <?php if ($j == $ubah_karyawan['jabatan']) : ?>
                                                                 <option value="<?= $j; ?>" selected><?= $j; ?></option>
                                                             <?php else : ?>
                                                                 <option value="<?= $j; ?>"><?= $j; ?></option>
                                                             <?php endif; ?>
                                                         <?php endforeach; ?>
                                                     </select>
                                                     <?= form_error('jabatan', '<small class="text-danger pl-3">', '</small>'); ?>
                                                 </div>
                                             </div>

                                             <a href="<?= base_url('ManajemenKaryawan/karyawan'); ?>" title="Kembali ke halaman Karyawan" class="btn btn-sm btn-secondary font-weight-bold mt-3">Kembali</a>
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