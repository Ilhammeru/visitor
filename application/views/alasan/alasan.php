<div class="container mt-5">
    <div class="row">
        <div class="col"></div>
        <div class="col-md-10 col-sm-12 col-xs-12">
            <div class="card shadow">
                <div class="card-header text-center">
                    <h5 class="card-title">Database Alasan</h5>
                </div>
                <div class="card-body">
                    <div class="text-end">
                        <button class="btn btn-outline-info btn-sm" onclick="tambahAlasan()"><i class="fas fa-plus"></i> Tambah</button>
                    </div>
                    <div class="table-responsive" id="targetAlasan">

                    </div>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>
</div>

<!-- modal -->
<div class="modal modalAlasan fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Alasan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close"></button>
            </div>
            <div class="modal-body">
                <div class="hapusBaris">
                    <div class="table-responsive">
                        <div class="row">
                            <div class="col-md-10 col-sm-10 col-xs-10">
                                <input type="text" class="form-control alasan0" onchange="cekAlasan(0)" id="alasan">
                            </div>
                            <div class="col md-2 col-sm-2 col-xs-2">
                                <button type="button" class="btn" id="tambahForm"><i class="fas fa-plus text-primary"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="targetForm"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary simpanAlasan" onclick="simpan()">Simpan</button>
                <button type="button" class="btn btn-primary editAlasan" hidden>Edit</button>
                <button type="button" class="btn btn-success tutupAlasan" hidden>Tutup</button>
            </div>
        </div>
    </div>
</div>


<div class="modal modalPassword fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close"></button>
            </div>
            <div class="modal-body">
                <div class="hapusBaris">
                    <div class="row">
                        <input type="password" class="form-control" id="password" placeholder="Masukan password anda">
                    </div>
                </div>
                <div id="targetForm"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary simpanAlasan" onclick="prosesSimpan()">Lanjut</button>
            </div>
        </div>
    </div>
</div>


<!-- modal -->

<script>
    $(document).ready(function() {
        ambilAlasan(0);
        var i = 0;
        $('#tambahForm').click(function() {
            i++;
            var baris = '<div class="row mt-3" id="hapusBaris' + i + '">' +
                '<div class="col col-md-8 col-sm-12">' +
                '<div class="form-group">' +
                '<label>Alasan</label>' +
                '<input type="text" onchange="cekAlasan(' + i + ')" class="form-control alasan' + i + '" id="alasan">' +
                '</div>' +
                '</div>' +
                '<div class="col col-md-4 col-sm-12">' +
                '<div class="form-group">' +
                '<button class="btn btn-outline-warning mt-4" onclick="hapusForm(' + i + ')">Hapus</button>' +
                '</div>' +
                '</div>' +
                '</div>';
            $('#targetForm').append(baris);
        })

        $('.tutupAlasan').click(function() {
            $('.modal').modal('hide');
            $('input[id="alasan"]').val('');
            $('.modal-title').text('Tambah Alasan');
            $('.editAlasan').prop('hidden', true);
            $('.tutupAlasan').prop('hidden', true);
            $('.editAlasan').removeAttr('onclick');
            $('#tambahForm').removeAttr('hidden');
            $('.simpanAlasan').removeAttr('hidden');
            $('#close').removeAttr('hidden');
        })

        $(document).on('click', '.pagination li a', function() {
            var halaman = $(this).attr('data-page');
            ambilAlasan(halaman);
        })

    })

    function tambahAlasan() {
        $('.modalAlasan').modal('show');
        $('.tutupAlasan').prop('hidden', true);
    }

    function ambilAlasan(halaman) {
        $.ajax({
            type: 'POST',
            data: 'halaman=' + halaman,
            url: '<?= base_url('alasan/ambilAlasan'); ?>',
            dataType: 'text',
            success: function(data) {
                $('#targetAlasan').html(data);
            }
        })
    }

    function simpan() {
        var cek = $('.alasan0').val();

        if (cek == '') {
            swal('Error', 'Kolom alasan harus diisi', 'error');
        } else {
            $('.modalAlasan').modal('hide');
            $('.modalPassword').modal('show');
        }
    }

    function prosesSimpan() {
        var alasan = $('input[id="alasan"]').map(function() {
            return $(this).val();
        }).toArray();
        var pass = $('#password').val();

        $.ajax({
            type: 'POST',
            data: 'alasan=' + alasan + '&pass=' + pass,
            url: '<?= base_url('alasan/prosesAlasan'); ?>',
            dataType: 'text',
            success: function(hasil) {
                if (hasil == 'Tidak ada') {
                    swal('Error', 'Kolom alasan harus diisi', 'error');
                } else if (hasil == 'password salah') {
                    swal('Error', 'Password salah', 'error', {
                        buttons: false,
                        timer: 800
                    })
                } else {
                    swal('Berhasil', 'Data berhasil di input', 'success', {
                        buttons: false,
                        timer: 900
                    });
                    $('input[id="alasan"]').val('');
                    $('.modal').modal('hide');
                    $('.tutupAlasan').attr('hidden', '');
                    $('#alertHapus').remove();
                    $('#targetForm').html('');
                    ambilAlasan();
                }
            }
        })
    }

    function cekAlasan(x) {
        var alasan = $('.alasan' + x).val();
        $.ajax({
            type: 'POST',
            data: {
                alasan: alasan
            },
            url: '<?= base_url('alasan/cekAlasan'); ?>',
            dataType: 'text',
            success: function(data) {
                if (data == 1) {
                    swal({
                        title: 'Duplikat data',
                        text: "Data sudah ada di database",
                        icon: "warning",
                    })
                    $('.alasan' + x).val('');
                }
            }
        })
    }

    function hapusForm(x) {
        $('#hapusBaris' + x).remove();
    }

    function hapusAlasan(id) {
        $.ajax({
            type: 'POST',
            data: {
                id: id
            },
            url: '<?= base_url('alasan/ambilId'); ?>',
            dataType: 'json',
            success: function(data) {
                var alasan = data[0].alasan;
                swal({
                        title: "Hapus data",
                        text: "Apakah anda yakin ingin menghapus  " + alasan + "?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                type: 'POST',
                                data: {
                                    id: id
                                },
                                url: '<?= base_url('alasan/hapus'); ?>',
                                success: function() {
                                    swal('Berhasil', 'Data berhasil di hapus', 'success', {
                                        buttons: false,
                                        timer: 900
                                    });
                                    ambilAlasan();
                                }
                            })
                        } else {
                            swal('Yeayy, alasan tidak jadi dihapus');
                        }
                    });
            }
        })
    }
</script>