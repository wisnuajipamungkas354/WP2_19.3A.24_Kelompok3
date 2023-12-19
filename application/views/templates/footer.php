</div>
<!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Footer -->
<footer class="sticky-footer pl-3">
    <div class="container my-auto">
        <div class="copyright text-center">
            <span>Copyright &copy; Sistem Pengelolaan Servis - Wisnu Tech <?= date('Y'); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-chevron-circle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih tombol "Logout" jika kamu ingin mengakhiri sesi.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-danger" href="<?= base_url('auth/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

<!-- Sweetalert core JavaScript -->
<script src="<?= base_url('assets/'); ?>js/popper.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/promise-polyfill.js"></script>
<script src="<?= base_url('assets/'); ?>js/js-delete-sweetAlert.js"></script>

<!-- Bootstrap SelectPicker -->
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url('assets/'); ?>dist/js/bootstrap-select.min.js"></script>
<script src="<?= base_url('assets/'); ?>dist/js/i18n/defaults-en_US.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Remove search field -->
<style>
    .dataTables_filter {
        display: none;
    }
</style>

<!-- Script CRUD Riwayat Servis -->
<script>
    $(document).ready(function() {
        $('.selectpicker').selectpicker();
        $('#tombol-add').on('click', function() {
            $tableBody = $('table tbody');
            $idPart = $('#part option:selected').data('id');
            $nmPart = $('#part').val();
            $harga = $('#part option:selected').data('harga')

            markup = "<tr><th scope='row' style='width:15%;'><input type='text' class='form-control-plaintext' name='id_part[]' value='" + $idPart + "' readonly>" + "</th><td style='width:65%;'><input type='text' class='form-control-plaintext' name='nm_part[]' value='" + $nmPart + "' readonly>" + "</td><td style='width:15%;'><input type='text' class='form-control-plaintext val-harga' name='harga[]' style='text-align:right;' value='" + $harga + "' readonly>" + "</td><td style='width:5%;'><button type='button' class='delete btn btn-sm btn-danger btn-circle'><i class='fas fa-fw fa-trash'></i></button></td></tr>";
            $tableBody.append(markup);
        });

        var totalHarga = 0
        $('.val-harga').each(function() {
            totalHarga = totalHarga + parseInt($(this).val());
            $('#total_sum_value').val(totalHarga);
        })

        $('#tombol-add').click(function() {
            totalHarga = totalHarga + parseInt($('.val-harga:last').val());
            $('#total_sum_value').val(totalHarga);
        })

        $('table').on('click', '.delete', function() {
            totalHarga = totalHarga - parseInt($(this).closest('tr').find('.val-harga').val());
            $('#total_sum_value').val(totalHarga);
            $(this).closest('tr').remove();
        });

    });
</script>

<!-- Script Data tables -->
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        var t = $('#table').DataTable({
            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0
            }],
            "order": [
                [1, 'asc']
            ],
            "language": {
                "sProcessing": "Sedang memproses ...",
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecord": "Maaf data tidak tersedia",
                "info": "Menampilkan _PAGE_ halaman dari _PAGES_ halaman",
                "infoEmpty": "Tidak ada data yang tersedia",
                "infoFiltered": "(difilter dari _MAX_ total data)",
                "sSearch": "Cari",
                "oPaginate": {
                    "sFirst": "Pertama",
                    "sPrevious": "Sebelumnya",
                    "sNext": "Selanjutnya",
                    "sLast": "Terakhir"
                }
            }
        });
        t.on('order.dt search.dt', function() {
            t.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
    });
    $('#btn-refresh').on('click', () => {
        $('#ic-refresh').addClass('fa-spin');
        var oldURL = window.location.href;
        var index = 0;
        var newURL = oldURL;
        index = oldURL.indexOf('?');
        if (index == -1) {
            window.location = window.location.href;

        }
        if (index != -1) {
            window.location = oldURL.substring(0, index)
        }
    });
</script>

<!--Script data autofill-->
<script type="text/javascript">
    $(document).ready(function() {
        $('#id_brg').change(function() {
            var barang = $(this).val();
            $.ajax({
                url: "<?= base_url('ManajemenData/barang_list'); ?>",
                type: "POST",
                data: "id_brg=" + barang,
                async: true,
                dataType: 'json',
                success: function(data) {
                    $('#nm_brg').val(data.nm_brg);
                    $('#harga').val(data.harga_brg);
                }
            });
        });
    });
    // fungsi pembayaran
    $(document).ready(function() {
        $('#id_servis').change(function() {
            var servis = $(this).val();
            $.ajax({
                url: "<?= base_url('ManajemenData/servis_list'); ?>",
                type: "POST",
                data: "id_servis=" + servis,
                async: true,
                dataType: 'json',
                success: function(data) {
                    $('#nm_pelanggan').val(data.nm_pelanggan);
                    $('#tipe_laptop').val(data.tipe_laptop);
                    $('#keluhan_awal').val(data.keluhan_awal);
                    $('#nm_teknisi').val(data.teknisi);
                    $('#total_harga').val(data.total_harga);
                    // $('.nm_part').val(data.nm_part);
                    // $('.total-harga').val(data.totalHarga);
                }
            });
        });
    });
    $(document).ready(function() {
        $('#no_nota').change(function() {
            var nota = $(this).val();
            $.ajax({
                url: "<?= base_url('ManajemenData/nota_list'); ?>",
                type: "POST",
                data: "no_nota=" + nota,
                async: true,
                dataType: 'json',
                success: function(data) {
                    $('#total').val(data.total);
                }
            });
        });
    });
    $(document).ready(function() {
        $('#id_karyawan').change(function() {
            var karyawan = $(this).val();
            $.ajax({
                url: "<?= base_url('ManajemenKaryawan/karyawan_list'); ?>",
                type: "POST",
                data: "id_karyawan=" + karyawan,
                async: true,
                dataType: 'json',
                success: function(data) {
                    $('#nm_karyawan').val(data.nama);
                }
            });
        });
    });
</script>

<script>
    function change() {
        var x = document.getElementById('password').type;
        if (x == 'password') {
            document.getElementById('password').type = 'text';
            document.getElementById('eye-button').innerHTML = `<i class="fas fa-fw fa-eye-slash" title="sembunyikan password"></i>`;
        } else {
            document.getElementById('password').type = 'password';
            document.getElementById('eye-button').innerHTML = `<i class="fas fa-fw fa-eye" title="tampilkan password"></i>`;
        }
    }
</script>

</body>

</html>