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
                            <label>No. Faktur</label>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="no_faktur" name="no_faktur" value="<?= $no_faktur; ?>" readonly>
                                <?= form_error('no_faktur', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Supplier</label>
                            <div class="col-sm">
                                <select class="form-control" id="id_supplier" name="id_supplier">
                                    <option value="">Pilih Supplier</option>
                                    <?php foreach ($data_supplier as $supplier) : ?>
                                        <option value="<?= $supplier['id_supplier']; ?>"><?= $supplier['id_supplier']; ?> - <?= $supplier['nm_supplier']; ?></option>
                                    <?php endforeach; ?>
                                </select> <?= form_error('id_supplier', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>ID Barang</label>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="id_part" name="id_part" value="<?= $ubah_barang['id_part']; ?>" readonly>
                                <?= form_error('id_part', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <div class="col-sm">
                                <input type="text" class="form-control text-capitalize" id="nm_part" name="nm_part" maxlength="30" value="<?= $ubah_barang['nm_part']; ?>">
                                <?= form_error('nm_part', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <div class="col-sm">
                                <input type="number" class="form-control" id="harga_part" name="harga_part" min="1" max="9999999999" value="<?= $ubah_barang['harga_part']; ?>">
                                <?= form_error('harga_part', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jumlah</label>
                            <div class="col-sm">
                                <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" max="99999" value="<?= $ubah_barang['stok']; ?>">
                                <?= form_error('jumlah', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <a href="<?= base_url('MonitoringData/barang'); ?>" title="Kembali ke halaman Pengguna" class="btn btn-sm btn-secondary font-weight-bold mt-3">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-success font-weight-bold ml-2 mt-3">Simpan</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->