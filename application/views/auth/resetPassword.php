<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col"></div>
        <div class="col-md-8 col-sm-12 col-xs-12">
            <div class="card shadow">
                <div class="card-header text-center">
                    <h5 class="card-title">
                        Reset Password
                    </h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Password lama</label>
                        <input type="password" class="form-control" id="passwordLama">
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="">Password Baru</label>
                            <input type="password" class="form-control" id="passwordBaru">
                        </div>
                        <div class="col">
                            <label for="">Ulangi Password</label>
                            <input type="password" class="form-control" id="ulangPassBaru">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check" style="font-size: 0.8em;">
                            <input class="form-check-input" type="checkbox" value="" id="tampilPassword">
                            <label class="form-check-label" for="tampilPassword">
                                Tampilkan Password
                            </label>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <button class="btn btn-primary btn-sm" onclick="prosesReset()">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tampilPassword').click(function() {
            if ($(this).is(':checked')) {
                $('#passwordBaru').attr('type', 'text');
                $('#passwordLama').attr('type', 'text');
                $('#ulangPassBaru').attr('type', 'text');
            } else {
                $('#passwordBaru').attr('type', 'password');
                $('#passwordLama').attr('type', 'password');
                $('#ulangPassBaru').attr('type', 'password');
            }
        })
    })

    function prosesReset() {
        var passLama = $('#passwordLama').val();
        var pass = $('#passwordBaru').val();
        var ulang = $('#ulangPassBaru').val();
        if (passLama == '') {
            swal('Error', 'Password lama harus diisi', 'warning', {
                timer: 900,
                buttons: false
            })
        } else if (pass == '') {
            swal('Error', 'Password baru harus diisi', 'warning', {
                timer: 900,
                buttons: false
            });
        } else if (pass != ulang) {
            swal('Error', 'mohon ulangi password dengan benar', 'warning', {
                buttons: false,
                timer: 900
            })
        } else if (ulang == '') {
            swal('Error', 'Harap isi kolom ulangi password', 'warning', {
                timer: 900,
                buttons: false
            });
        } else {
            $.ajax({
                type: 'POST',
                data: 'passLama=' + passLama + '&passBaru=' + pass + '&ulang=&' + ulang,
                url: '<?= base_url('user/prosesReset'); ?>',
                dataType: 'text',
                success: function(hasil) {
                    if (hasil == 'oke') {
                        swal('Berhasil', 'Reset password berhasil dilakukan', 'success', {
                            buttons: false,
                            timer: 900
                        })
                        $('#passwordLama').val('');
                        $('#passwordBaru').val('');
                        $('#ulangPassBaru').val('');
                    } else {
                        swal('Error', 'Masukan password lama anda dengan benar', 'warning', {
                            timer: 900,
                            buttons: false
                        })
                    }
                }
            })
        }

    }
</script>