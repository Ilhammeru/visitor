<div class="container mt-5">
    <div class="row mt-5">
        <div class="col col-md-12 col-sm-12">
            <div class="card shadow">
                <div class="card-header text-center">
                    <h5 class="card-title">
                        Daftar User
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-end">
                        <button class="btn btn-outline-info btn-sm" id="tambahUser" onclick="tambahUser()"><i class="fas fa-plus"></i> Tambah</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Perusahaan</th>
                                    <th>Status</th>
                                    <?php if ($_SESSION['role'] < 3) { ?>
                                        <th>Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody id="targetUser">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal -->
<div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" onchange="cekNama()" class="form-control" id="nama">
                        <span id="spanNama" style="font-size: 0.6em; color:red;"></span>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="form-group">
                        <label for="">Aksesbilitas</label>
                        <select name="akses" id="akses" class="form-control">
                            <optgroup label="Pilihan Sebelumnya" class="pilihanAksesSebelumnya">
                                <option value="" id="pilihanAksesSebelumnya"></option>
                            </optgroup>
                            <optgroup label="Data">
                                <option value="" id="pilihAkses">-- Pilih --</option>
                                <option value="1">Admin</option>
                                <option value="2">Preview</option>
                                <option value="3">Marketing</option>
                            </optgroup>
                        </select>
                        <span id="spanAkses" style="font-size: 0.6em; color:red;"></span>
                    </div>
                </div>
                <div class="row mt-3" <?= ($_SESSION['role'] > 0) ? 'hidden' : ''; ?>>
                    <div class="form-group">
                        <label for="">Perusahaann</label>
                        <select name="pt" id="pt" class="form-control">
                            <?php if ($_SESSION['id'] != 0) { ?>
                            <optgroup label="Pilihan sebelumnya" class="pilihanPtSebelumnya">
                                <option value="" id="pilihanPtSebelumnya"></option>
                            </optgroup>
                            <optgroup label="Data">
                                <option value="<?= $_SESSION['pt']; ?>"><?= $_SESSION['pt']; ?></option>
                            </optgroup>
                            <?php } else { ?>
                                <optgroup label="List PT" class="ptList"></optgroup>
                            <?php } ?>
                        </select>
                        <span id="spanPt" style="font-size: 0.6em; color:red;"></span>
                    </div>
                </div>
                <div id="passGrup">
                    <div class="row mt-3">
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" id="password">
                            <span id="spanPass" style="font-size: 0.6em; color:red;"></span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group">
                            <label for="">Ulangi password</label>
                            <input type="password" class="form-control" id="ulangPass">
                            <span id="spanUlang" style="font-size: 0.6em; color:red;"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="register" onclick="register()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="targetEdit">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="editUser">Edit</button>
                <button type="button" class="btn btn-primary" id="tutupModal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- modal  -->

<script>
    $(document).ready(function() {
        ambilUser();
        getPt();

        $('#tutupModal').click(function() {
            ambilUser();
            $('.modal').modal('hide');
            $('#register').removeAttr('hidden');
            $('#editUser').prop('hidden', true);
            // $('#tutupModal').prop('hidden', true);
            $('button[class="btn-close"]').removeAttr('hidden');
            $('#editUser').removeAttr('onclick');
            $('#passGrup').removeAttr('hidden');
        })
    })

    function ambilUser() {
        $.ajax({
            type: 'POST',
            data: 'table=user',
            url: '<?= base_url('user/ambilUser'); ?>',
            dataType: 'text',
            success: function(hasil) {
                $('#targetUser').html(hasil);
            }
        })
    }

    function editUser(id) {
        $.ajax({
            type: 'POST',
            data: 'id=' + id,
            url: '<?= base_url('user/detail'); ?>',
            dataType: 'text',
            success: function(hasil) {
                $('#editUser').attr('onclick', 'prosesEdit(' + id + ')');
                $('#modalEdit').modal('show');
                $('#targetEdit').html(hasil);
            }
        })
    }

    function prosesEdit(id) {
        var nama = $('#namaEdit').val();
        var akses = $('#aksesEdit').val();
        var database = $('#database').val();
        var pt = $('#ptEdit').val();

        $.ajax({
            type: 'POST',
            data: {
                nama: nama, 
                akses: akses,
                database: database, 
                pt: pt,
                id: id
            },
            url: '<?= base_url('user/prosesEdit'); ?>',
            dataType: 'text',
            success: function(hasil) {
                ambilUser();
                $('.modal').modal('hide');
                swal('Berhasil', 'Edit data berhasil', 'success');
                $('#pilihanAksesSebelumnya').val('');
                $('#pilihanPtSebelumnya').val('');
                $('.pilihanAksesSebelumnya').prop('hidden', true);
                $('.pilihanPtSebelumnya').prop('hidden', true);
                $('#register').removeAttr('hidden');
                $('#editUser').removeAttr('onclick');
                $('#passGrup').removeAttr('hidden');
            }
        });
    }

    function hapusUser(id) {
        $.ajax({
            type: 'POST',
            data: {
                id: id
            },
            url: '<?= base_url('user/cekUser'); ?>',
            dataType: 'json',
            success: function(data) {
                var nama = data[0].nama_user;
                swal({
                        title: "Hapus data",
                        text: "Apakah anda yakin ingin menghapus user " + nama + "?",
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
                                url: '<?= base_url('user/hapus'); ?>',
                                success: function() {
                                    swal('Berhasil', 'Data berhasil di hapus', 'success');
                                    ambilUser();
                                }
                            })
                        } else {
                            swal('Yeayy, user tidak jadi dihapus');
                        }
                    });
            }
        })
    }

    function ambilDataD() {
        $.ajax({
            type: 'POST',
            data: 'table=ansena_department',
            url: '<?= base_url('user/ambilData'); ?>',
            dataType: 'json',
            success: function(hasil) {
                console.log(hasil);
                return false;
            }
        })
    }

    function tambahUser() {
        $('#modalTambah').modal('show');
        $('#passGrup').removeAttr('hidden');
        $('#pilihAkses').prop('selected', true);
        $('#pilihPt').prop('selected', true);
        $('.pilihanAksesSebelumnya').prop('hidden', true);
        $('#nama').val('');
    }

    function cekNama() {
        var nama = $('#nama').val();
        $.ajax({
            type: 'POST',
            data: 'nama=' + nama,
            url: '<?= base_url('auth/cekNama'); ?>',
            dataType: 'text',
            success: function(hasil) {
                if (hasil > 0) {
                    swal('Nama sama', 'Nama sudah ada di database', 'error');
                    $('#nama').val('');
                }
            }
        })
    }

    function getPt() {
        $.ajax({
            type: 'post',
            url: '<?=site_url('user/getPt');?>',
            dataType: 'json',
            success: function(response) {
                var pt = '';
                for (var i = 0; i < response.length; i++) {
                    pt += '<option value="'+ response[i].id +'">'+ response[i].name +'</option>';
                }

                $('.ptList').html(pt);
            }
        })
    }

    function register() {
        var nama = $('#nama').val();
        var akses = $('#akses').val();
        var pass = $('#password').val();
        var ulangPass = $('#ulangPass').val();
        var pt = $('#pt').val();

        if (nama == '') {
            $('#spanNama').text('Nama tidak boleh kosong');
        } else if (akses == '') {
            $('#spanAkses').text('User tidak boleh kosong');
        } else if (pass == '') {
            $('#spanPass').text('Password tidak boleh kosong');
        } else if (ulangPass == '') {
            $('#spanUlang').text('Password harus diulangi');
        } else if (pt == '') {
            $('#spanPt').text('Perusahaan tidak boleh kosong');
        } else {
            $('#spanNama').text('');
            $('#spanAkses').text('');
            $('#spanPass').text('');
            $('#spanUlang').text('');
            $('#spanPt').text('');
            $.ajax({
                type: 'POST',
                data: 'nama=' + nama + '&akses=' + akses + '&pass=' + pass + '&pt=' + pt,
                url: '<?= base_url('auth/prosesRegister'); ?>',
                dataType: 'text',
                success: function(hasil) {
                    if (hasil == 0) {
                        swal('Berhasil', 'Register berhasil', 'success', {
                            buttons: false,
                            timer: 900
                        });
                        $('.modal').modal('hide');
                        $('#nama').val('');
                        $('#user').val('');
                        $('#password').val('');
                        $('#ulangPass').val('');
                        ambilUser();
                    } else {
                        swal('Register gagal', 'Data sudah ada di database', 'error');
                    }
                }
            })
        }
    }
</script>