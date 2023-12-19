<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/login/'); ?>ahayy-rounded.png" />

    <title><?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet" />
</head>

<style>
    body {
        background-image: url("<?= base_url('assets/img/login/'); ?>bg-login.svg");
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
</style>

<body class="bg-gradient-grey">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-9 col-lg-9 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-3">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img src="<?= base_url('assets/img/login/'); ?>bg-login3.jpg" alt="image" width="100%" height="100%">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-3">
                                    <div class="text-center">
                                        <img src="<?= base_url('assets/img/login/'); ?>logo2.png" alt="avatar" width="150">
                                        <h2 class="h5 text-dark mt-4 mb-3 text-monospace">SISTEM PENGELOLAAN SERVIS<br>WISNU-TECH</h2>
                                    </div>
                                    <?= $this->session->flashdata('message'); ?>
                                    <hr />
                                    <form class="user" method="post" action="<?= base_url('auth'); ?>">
                                        <div class="form-group">
                                            <i class="fas fa-user text-dark"> Username</i>
                                            <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukkan Username">
                                            <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <i class="fas fa-key text-dark"> Password</i>
                                            <input type="password" class="form-control form-control-user form-password" id="password" name="password" placeholder="Masukkan Password">
                                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="form-checkbox text-dark custom-control-input" id="customCheck" />
                                                <label class="custom-control-label" for="customCheck">Tampilkan Password</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <hr />
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('auth/lupa_password'); ?>">Lupa Password?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>

    <!-- Show password -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('.form-checkbox').click(function() {
                if ($(this).is(':checked')) {
                    $('.form-password').attr('type', 'text');
                } else {
                    $('.form-password').attr('type', 'password');
                }
            });
        });
    </script>

</body>

</html>