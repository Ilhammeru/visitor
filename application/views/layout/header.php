<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?= base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/main.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/jquery-ui/jquery-ui.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/jquery-ui/jquery-ui.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/datepicker/css/datepicker.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/select2/dist/css/select2.min.css" />
    <script src="<?= base_url(); ?>assets/jquery/dist/jquery.min.js"></script>


    <title><?= $title; ?></title>
    <style>
        .searchDiv {
            position: relative;
            width: 100%;
            height: 40px;
            margin-top: 1em;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }

        input[data-trigg="searchCrew"] {
            border: none !important;
            position: absolute !important;
            top: 0;
            left: 0;
            width: 90% !important;
            height: 31px !important;
            line-height: 20px !important;
            display: block;
            font-size: 0.9em !important;
            border-radius: 20px;
            padding: 0 10px !important;
            margin-top: 0.3em !important;
        }

        input[data-trigg="searchCrew"]:focus {
            border: none !important;
            box-shadow: none !important;
        }

        .fa {
            box-sizing: border-box;
            padding: 2px;
            width: 42.5px;
            height: 42.5px;
            position: absolute;
            top: 0;
            right: 0;
            border-radius: 50%;
            color: #07051a;
            text-align: center;
            font-size: 1em;
            transition: all 1s;
        }

        .modalDetailVisitor {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1050;
            width: 100%;
            height: 100%;
            outline: 0;
        }

        .modal-dialog.modal-fullscreen-sm-down {
            margin: 0 !important;
            width: 100%;
            height: 100%;
            max-width: 100% !important;
        }

        .modalDetailVisitor>.modal-dialog.modal-fullscreen-sm-down>.modal-content {
            height: 100%;
        }

        .noResponRow {
            margin-top: 1.2em;
        }

        .targetJumlahNorespon {
            font-weight: 100 !important;
        }

        .rtr {
            transform: rotate(-180deg);
        }

        .chevron-down {
            transition: ease .3s;
        }

        .targetJumlah,
        .targetTanggal {
            font-size: 0.5em;
            color: gray;
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md fixed-top navbar-light bg-light ">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto justify-content-end bg-light justify-content-end headbar" style="font-size: 1em;">
                    <?php if ($_SESSION['id'] == 1) { ?>
                        <li class="nav-item">
                            <a class="nav-link active text-dark dashboard" aria-current="page" href="<?= base_url('double_rekap'); ?>">Super Rekap</a>
                        </li>
                    <?php } ?>

                    <?php if ($_SESSION['pt'] == 41) { ?>
                        <li class="nav-item">
                            <a class="nav-link active text-dark dashboard" aria-current="page" href="<?= base_url('visitor/masterEdit'); ?>">Master Edit</a>
                        </li>
                    <?php } ?>

                    <?php if ($_SESSION['role'] == 5) { ?>
                        <li class="nav-item">
                            <a class="nav-link active text-dark dashboard" aria-current="page" href="<?= base_url('rekap'); ?>">Rekap</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="<?= base_url('auth/logout'); ?>" id="logout" title="Logout"><i class="fas fa-power-off"></i></a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link active text-dark dashboard" aria-current="page" href="<?= base_url('dashboard'); ?>">Search</a>
                        </li>
                        <?php if ($_SESSION['role'] == 1) { ?>
                            <li class="nav-item">
                                <a class="nav-link active text-dark dashboard" aria-current="page" href="<?= base_url('rekap'); ?>">Rekap</a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="<?= base_url('visitor'); ?>" data-target="visitor">Visitor</a>
                        </li>
                        <?php if ($_SESSION['role'] == 0) { ?>
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="<?= base_url('alasan'); ?>" id="navAlasan">Alasan</a>
                            </li>
                        <?php } ?>
                        <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 0) { ?>
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="<?= base_url('closing'); ?>">Closing</a>
                            </li>
                        <?php } ?>
                        <?php if ($_SESSION['role'] == 0) { ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" type="button" href="#" id="user-dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?= $_SESSION['perusahaan']; ?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="user-dropdown">
                                    <?php if ($_SESSION['role'] <= 2) { ?>
                                        <li><a class="dropdown-item" href="<?= base_url('auth/user'); ?>">User</a></li>
                                    <?php } ?>
                                    <li><a class="dropdown-item" href="<?= base_url('user/resetPassword'); ?>">Reset Password</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="<?= base_url('auth/logout'); ?>" id="logout" title="Logout"><i class="fas fa-power-off"></i></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <div id="popover_content_wrapper" style="display: none">
        <div class="row mb-3">
            <div class="col-md-2 col-sm-2 align-self-center border-end">
                <i class="far fa-envelope"></i>
            </div>
            <div class="col-md-8 col-sm-8" style="font-size: 0.8em;">
                <strong>Perbaikan validasi</strong> pada form <span class="text-primary">input visitor</span>
            </div>
        </div>
        <div class="row mb-2 border-top pt-3">
            <div class="col-md-2 col-sm-2 align-self-center border-end">
                <i class="far fa-envelope"></i>
            </div>
            <div class="col-md-8 col-sm-8">
                <strong>Perbaikan tampilan data</strong> pada form <span class="text-primary">edit visitor</span>
            </div>
        </div>
    </div>

</body>