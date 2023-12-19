<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card h4 mt-2 mb-4 border-bottom-success font-weight-bold text-secondary bg-light border-0 rounded-0">
        <div class="card-body text-dark">
            <?= $title; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-gradient-dark background2 shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                Pemasukan
                            </div>
                            <div class="h5 mb-0 font-weight-bold gold">
                                <?php
                                $sql = "SELECT SUM(total) FROM laporan";
                                $result = $this->db->query($sql)->row_array();
                                $harga = 0;
                                if (isset($result['SUM(total)'])) {
                                    $harga = number_format($result['SUM(total)'], 0, ',', '.');
                                    echo "Rp " . $harga;
                                } else {
                                    echo "Rp " . $harga;
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hand-holding-usd fa-2x gold"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-gradient-dark background2 shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                Laporan
                            </div>
                            <div class="h5 mb-0 font-weight-bold">
                                <?php
                                $sql = "SELECT COUNT(id_laporan) FROM laporan";
                                $result = $this->db->query($sql)->row_array();
                                ?>
                                <?= $result['COUNT(id_laporan)']; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-alt fa-2x gold"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-gradient-dark background2 shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold  text-uppercase mb-1">
                                Pembayaran
                            </div>
                            <div class="h5 mb-0 font-weight-bold">
                                <?php
                                $sql = "SELECT COUNT(no_nota) FROM pembayaran";
                                $result = $this->db->query($sql)->row_array();
                                ?>
                                <?= $result['COUNT(no_nota)']; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-invoice-dollar fa-2x gold"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-gradient-dark background2 shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                Servis
                            </div>
                            <div class="h6 mb-0 font-weight-bold">
                                <?php
                                $sql = "SELECT COUNT(id_servis) FROM servis";
                                $result = $this->db->query($sql)->row_array();
                                ?>
                                <?= $result['COUNT(id_servis)']; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tools fa-2x gold"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-gradient-dark background2 shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                Admin
                            </div>
                            <div class="h5 mb-0 font-weight-bold">
                                <?php
                                $sql = "SELECT COUNT(id_karyawan) FROM karyawan WHERE jabatan='Admin'";
                                $result = $this->db->query($sql)->row_array();
                                ?>
                                <?= $result['COUNT(id_karyawan)']; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-edit fa-2x gold"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-gradient-dark background2 shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                Owner
                            </div>
                            <div class="h5 mb-0 font-weight-bold">
                                <?php
                                $sql = "SELECT COUNT(id_karyawan) FROM karyawan WHERE jabatan='Owner'";
                                $result = $this->db->query($sql)->row_array();
                                ?>
                                <?= $result['COUNT(id_karyawan)']; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-tie fa-2x gold"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-gradient-dark background2 shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                Teknisi
                            </div>
                            <div class="h5 mb-0 font-weight-bold">
                                <?php
                                $sql = "SELECT COUNT(id_karyawan) FROM karyawan WHERE jabatan='Teknisi'";
                                $result = $this->db->query($sql)->row_array();
                                ?>
                                <?= $result['COUNT(id_karyawan)']; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-cog gold fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-gradient-dark background2 shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                Barang
                            </div>
                            <div class="h5 mb-0 font-weight-bold">
                                <?php
                                $sql = "SELECT COUNT(id_part) FROM part";
                                $result = $this->db->query($sql)->row_array();
                                ?>
                                <?= $result['COUNT(id_part)']; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x gold"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->