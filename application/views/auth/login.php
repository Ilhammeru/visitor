<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title><?= $title; ?></title>
</head>

<body>
    <div class="container mt-5">
        <div class="row mt-5">
            <div class="col"></div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h5 class="card-title">Login</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" id="nama" onchange="cekNama()" placeholder="Ex: Zola">
                            <span id="spanNama" class="fst-italic"></span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Password</label>
                            <input type="password" id="password" placeholder="Masukan kata sandi anda" class="form-control">
                            <span id="spanPass" class="fst-italic"></span>
                        </div>
                        <div class="form-group mt-3">
                            <button class="btn btn-primary btn-sm" onclick="login()" id="tombolLogin">Login</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>

    <!-- modal -->
    <div class="modal fade shadow" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Register</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" id="namaReg" placeholder="Nama Lengkap anda">
                        <span style="font-size: 0.6em; color: red;" id="spanNamaReg" class="fst-italic"></span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Username</label>
                        <input type="text" class="form-control" id="userReg" placeholder="Username anda untuk login">
                        <span style="font-size: 0.6em; color: red;" id="spanUserReg" class="fst-italic"></span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Password</label>
                        <input type="password" class="form-control" id="passwordReg" placeholder="Kata rahasia anda">
                        <span style="font-size: 0.6em; color: red;" id="spanPassReg" class="fst-italic"></span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Ulangi Password</label>
                        <input type="password" id="ulangiPass" class="form-control" oninput="cekPassReg()" placeholder="Ulangi kata rahasia anda">
                        <span style="font-size: 0.6em; color: red;" id="spanUlangReg" class="fst-italic"></span>
                    </div>
                    <div class="form-group mt-3">
                        <button class="btn btn-outline-primary" id="tombolRegister" onclick="register()">Register</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="<?= base_url(); ?>/assets/sweetalert/dist/sweetalert.min.js"></script>
    <script src="<?= base_url(); ?>/assets/jquery/dist/jquery.min.js"></script>


    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
    <script>
        $('.tombolModal').click(function(e) {
            e.preventDefault();
            $('.modal').modal('show');
            $('#tombolRegister').attr('onclick', 'register()');
        })

        function cekPassReg() {
            var pass = $('#passwordReg').val();
            var ulang = $('#ulangiPass').val();
            if (ulang != pass) {
                $('#spanUlangReg').text('Password tidak sama');
            } else {
                $('#spanUlangReg').text('');
                $('#tombolRegister').removeAttr('disabled');
            }
        }

        function cekNama() {
            var nama = $('#nama').val();
            $.ajax({
                type: 'POST',
                data: 'nama=' + nama,
                url: '<?= base_url('auth/cekUser'); ?>',
                success: function(data) {
                    if (data == 0) {
                        $('#spanNama').text('Nama belum tersedia');
                        $('#tombolLogin').attr('disabled', '');
                        $('#spanNama').attr('style', 'font-size: 0.6em; color: red');
                    } else {
                        $('#spanNama').text('Tersedia');
                        $('#spanNama').attr('style', 'font-size: 0.6em; color: green');
                        $('#tombolLogin').removeAttr('disabled');
                    }
                }
            })
        }

        function cekPass() {
            var nama = $('#nama').val();
            var pass = $('#password').val();
            $.ajax({
                type: 'POST',
                data: 'nama=' + nama + '&pass=' + pass,
                url: '<?= base_url('auth/cekPass'); ?>',
                dataType: 'json',
                success: function(data) {
                    var password = data[0].password;
                    if (pass != password) {
                        $('#spanPass').text('Password salah');
                        $('#tombolLogin').attr('disabled', '');
                        $('#spanPass').attr('style', 'font-size: 0.6em; color: red');
                    } else {
                        $('#spanPass').text('Tersedia');
                        $('#spanPass').attr('style', 'font-size: 0.6em; color: green');
                        $('#tombolLogin').removeAttr('disabled');
                    }
                }
            })
        }


        function login() {
            var nama = $('#nama').val();
            var password = $('#password').val();
            if (nama == '') {
                swal('Error', 'Kolom nama masih kosong');
            } else if (password == '') {
                swal('Error', 'Kolom password masih kosong');
            } else(
                $.ajax({
                    type: 'POST',
                    data: 'nama=' + nama + '&password=' + password,
                    url: '<?= base_url('auth/prosesLogin'); ?>',
                    dataType: 'text',
                    success: function(data) {
                        if (data == 1) {
                            swal('Error', 'Password anda salah', 'error')
                        } else {
                            swal('Berhasil', 'Login berhasil, tunggu sebentar anda akan diarhkan ke halaman dashboard', 'success', {
                                buttons: false
                            });
                            setTimeout(function() {
                                var url = '<?= base_url('dashboard'); ?>';
                                window.location = url;
                            }, 600)
                        }
                    }
                })
            )
        }
    </script>
</body>

</html>