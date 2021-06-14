<div class="container mt-5">
    <div class="row">
        <div class="col">


        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-3">
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <button class="btn btn-primary btn-sm nav-link bulanan w-50" data-bs-toggle="collapse" id="aria" role="button" href="#cariTanggal" aria-expanded="false" aria-controls="cariBulanan">Harian</button>
                </li>
                <div class="collapse mb-2" id="cariTanggal">
                    <div class="table-responsive">
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-1">
                                    <input type="text" class="form-control form-control-sm tanggalAwal" id="tanggalAwal">
                                </div>
                            </div>
                            -
                            <div class="col">
                                <div class="form-group mb-1">
                                    <input type="text" class="form-control form-control-sm tanggalAkhir" onchange="cariTanggal()" id="tanggalAkhir">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <li class="nav-item mb-2">
                    <button class="btn btn-primary btn-sm nav-link bulanan w-50" data-bs-toggle="collapse" id="aria" role="button" href="#cariBulan" aria-expanded="false" aria-controls="cariBulanan">Bulanan</button>
                </li>
                <div class="collapse mb-2" id="cariBulan">
                    <div class="form-group mb-1">
                        <input type="text" class="form-control form-control-sm datepicker" placeholder="Pilih Bulan" onchange="cariDataBulan()">
                    </div>
                </div>

                <li class="nav-item mb-2">
                    <button class="btn btn-primary btn-sm nav-link brand w-50" data-bs-toggle="collapse" id="aria" role="button" href="#cariBrand" aria-expanded="false" aria-controls="cariBrand">Brand</button>
                </li>
                <div class="collapse mb-2" id="cariBrand">
                    <div class="form-group mb-1">
                        <input type="text" class="form-control form-control-sm cariDataBrand" oninput="cariDataBrandd()" placeholder="Masukan nama brand">
                    </div>
                </div>

                <li class="nav-item mb-2">
                    <button class="btn btn-primary btn-sm nav-link w-50" id="semua">Semua</button>
                </li>
            </ul>
        </div>
        <div class="col-md-9 col-sm-9">
            <div class="card shadow">
                <div class="card-header text-center">
                    <h5 class="card-title">Visitor</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3 mt-2">
                        <div class="col-md-8">
                        </div>
                        <div class="col-md-4">
                            <div class="text-end">
                                <a href="<?= base_url('visitor/tambahVisit'); ?>" class="btn btn-outline-info btn-sm"><i class="fas fa-plus"></i> Tambah</a>
                            </div>
                        </div>
                    </div>
                    <div id="targetVisit"></div>
                    <div class="table-resonsive" id="target">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>Hp</th>
                                    <th>Alasan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($visit as $row) : ?>
                                    <tr>
                                        <td><?= tanggal($row['tanggal_input']); ?></td>
                                        <td><?= $row['nama']; ?></td>
                                        <td><?= $row['hp']; ?></td>
                                        <?php if (isset($brand['b' . $row['brand']])) { ?>
                                            <td><?= $brand['b' . $row['brand']]; ?></td>
                                        <?php } ?>
                                        <td><a onclick="edit(<?= $row['id_visit']; ?>)" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i></a> <a class="btn btn-outline-danger btn-sm" onclick="hapusVisitor(<?= $row['id_visit']; ?>)"><i class="fas fa-trash-alt"></i></a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="paginationn">
                        <?= $link; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal -->
<!-- modal -->
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
            </div>
            <div class="modal-body" id="targetModal">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="editVisit">Edit</button>
                <button type="button" class="btn btn-success" onclick="tutup()">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- modal -->
<!-- modal -->

<script>
    $(document).ready(function() {
        ambilData(0);
        $('.pagination ul').on('click', 'a', function(e) {
            e.preventDefault();
            var halaman = $(this).attr('data-ci-pagination-page');
            ambilData(halaman);
        })

        $('#semua').click(function() {
            $('#targetVisit').html('');
            $('#target').removeAttr('hidden');
            $('.paginationn').removeAttr('hidden');
            $('#targetJumlah').prop('hidden', true);
            $('button[id="aria"]').attr('aria-expanded', 'false');
            $('button[id="aria"]').attr('class', 'btn btn-primary btn-sm nav-link bulanan w-50');
            $('#cariBrand').attr('class', 'collapse');
            $('#cariTanggal').attr('class', 'collapse');
            $('#cariBulan').attr('class', 'collapse');
        })

        $('.datepicker').datepicker({
            format: 'MM, yyyy',
            startView: 'months',
            minViewMode: 'months',
            autoclose: true
        })

        $('.tanggalAwal').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true
        });

        $('.tanggalAkhir').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true
        })
    })

    function ambilData(halaman) {
        $.ajax({
            type: 'GET',
            url: '<?= base_url(); ?>/pagination/index/' + halaman,
            dataType: 'text',
        })
    }

    function cariDataBulan() {
        var bulan = $('.datepicker').val();
        $.ajax({
            type: 'POST',
            data: 'bulan=' + bulan,
            url: '<?= base_url('visitor/ambilVisitBulan'); ?>',
            dataType: 'text',
            success: function(data) {
                $('.paginationn').prop('hidden', true);
                $('#target').prop('hidden', true);
                $('#targetVisit').html(data);
                $('#targetJumlah').removeAttr('hidden');
                $('#cariBulan').attr('class', 'collapse');
                $('.datepicker').val('');
            }
        })
    }

    function cariDataBrandd() {
        var brand = $('.cariDataBrand').val();
        if (brand == '') {
            $('#target').removeAttr('hidden');
            $('.paginationn').removeAttr('hidden');
            $('#targetVisit').html('');
        } else {
            $.ajax({
                type: 'POST',
                data: 'brand=' + brand,
                url: '<?= base_url('visitor/cariBrand'); ?>',
                dataType: 'text',
                success: function(data) {
                    $('.paginationn').prop('hidden', true);
                    $('#target').prop("hidden", true);
                    $('#targetVisit').html(data);
                    $('#targetJumlah').removeAttr('hidden');
                }
            })
        }
    }

    function cariTanggal() {
        var tanggalAwal = $('#tanggalAwal').val();
        var tanggalAkhir = $('#tanggalAkhir').val();
        if (tanggalAwal == '') {
            swal({
                text: 'Tanggal awal masih kosong',
                icon: "warning",
                buttons: false,
                timer: 800
            });
            $('#tanggalAkhir').val('');
        } else {
            $.ajax({
                type: 'POST',
                data: 'tanggalAwal=' + tanggalAwal + '&tanggalAkhir=' + tanggalAkhir,
                url: '<?= base_url('visitor/ambilVisitTanggal'); ?>',
                dataType: 'text',
                success: function(data) {
                    $('.paginationn').prop('hidden', true);
                    $('#target').prop("hidden", true);
                    $('#targetVisit').html(data);
                    $('#targetJumlah').removeAttr('hidden');
                    $('#cariTanggal').attr('class', 'collapse');
                }
            })
        }
    }

    function tambahVisit() {
        $('.modal').modal('show');
    }

    function ambilVisit() {
        $.ajax({
            type: 'POST',
            url: '<?= base_url('visitor/ambilPagination'); ?>',
            dataType: 'text',
            success: function(data) {
                $('#targetVisit').html(data);
                $('#alertHapus').remove();
            }
        })
    }

    function hapusVisitor(id) {
        swal({
                title: "Hapus data",
                text: 'Yakin ingin menghapus data ini?',
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: 'POST',
                        data: 'id=' + id + '&table=visit',
                        url: '<?= base_url('visitor/hapus'); ?>',
                        success: function() {
                            ambilVisit();
                            swal('Berhasil', 'Data berhasil di hapus', 'success');
                        }

                    })
                } else {
                    swal("Data anda aman");
                }
            })
    }

    function edit(id) {
        $('.modal').modal('show');
        $.ajax({
            type: 'POST',
            data: {
                id: id
            },
            url: '<?= base_url('visitor/ambilDetail'); ?>',
            dataType: 'text',
            success: function(hasil) {
                $('#targetModal').html(hasil);
                $('#editVisit').attr('onclick', 'prosesEdit(' + id + ')');
                $.ajax({
                    type: 'POST',
                    data: {
                        id: id
                    },
                    url: '<?= base_url('visitor/ambilAlasan'); ?>',
                    dataType: 'text',
                    success: function(data) {
                        for ($a = 0; $a < data.length; $a++) {
                            $('input[value="' + data[$a] + '"]').prop('checked', true);
                        }
                    }
                })
            }
        })
    }

    function tutup() {
        $('.modal').modal('hide');
        $('#nama').val('');
        $('#hp').val('');
        $('#targetMarketing').val('');
        $('#targetPerusahaan').val('');
        $('#targetBrand').val('');
        $('input[type="checkbox"]').prop('checked', false);
    }

    function brand() {
        var department = $('#perusahaan').val();
        if (department == '') {
            $('#brand').html('');
            $('#brand').attr('readonly', '');
            $('#marketing').html('');
            $('#marketing').attr('readonly', '');
        }
        $.ajax({
            type: 'POST',
            data: {
                id: department
            },
            url: '<?= base_url('visitor/ambilNama'); ?>',
            dataType: 'json',
            success: function(hasil) {
                var isi = '';
                for ($i = 0; $i < hasil.length; $i++) {
                    isi += '<option value="' + hasil[$i].id + '">' + hasil[$i].name + '</option>';
                }
                $('#marketing').html(isi);
                $('#marketing').removeAttr('readonly');
                $.ajax({
                    type: 'POST',
                    data: {
                        id: department
                    },
                    url: '<?= base_url('visitor/ambilBrand'); ?>',
                    dataType: 'json',
                    success: function(brand) {
                        var baris = '';
                        for ($u = 0; $u < brand.length; $u++) {
                            baris += '<option value="' + brand[$u].id + '">' + brand[$u].nama_franchise + '</option>';
                        }
                        $('#brand').html(baris);
                        $('#brand').removeAttr('readonly');
                    }
                })
            }
        })
    }

    function prosesEdit(id) {
        var nama = $('#nama').val();
        var hp = $('#hp').val();
        var marketing = $('#marketing').val();
        var perusahaan = $('#perusahaan').val();
        var brand = $('#brand').val();
        var alasan = $('input[type="checkbox"]:checked').map(function() {
            return $(this).val();
        }).toArray();

        if (nama == '') {
            swal('Error', 'Nama harus diisi', 'error');
        } else if (hp == '') {
            swal('Error', 'No Telfon harus diisi', 'error');
        } else if (alasan == '') {
            swal('Error', 'Setidaknya pilih salah satu alasan', 'error');
        } else if (marketing == '') {
            swal('Error', 'Nama marketing harus diisi');
        } else if (perusahaan == '') {
            swal('Error', 'Perusahaan harus diisi');
        } else {
            //cek hp dan brand apakah sudah ada di database atau belum
            swal("Anda yakin ingin menyimpan data ini?", {
                    buttons: {
                        catch: {
                            text: 'Yakin',
                            value: 'yakin',
                        },
                        cancel: 'Belum',
                    },
                })
                .then((value) => {
                    switch (value) {

                        case "yakin":
                            $.ajax({
                                type: 'POST',
                                data: 'nama=' + nama + '&hp=' + hp + '&marketing=' + marketing + '&perusahaan=' + perusahaan + '&brand=' + brand + '&alasan=' + alasan + '&id=' + id,
                                url: '<?= base_url('visitor/editVisitor'); ?>',
                                dataType: 'text',
                                success: function(data) {
                                    if (data == 'brand sama') {
                                        swal("Anda yakin ingin menyimpan data dengan brand yang sama?", {
                                                buttons: {
                                                    catch: {
                                                        text: 'Yakin',
                                                        value: 'yakin',
                                                    },
                                                    cancel: 'Belum',
                                                },
                                            })
                                            .then((value) => {
                                                switch (value) {
                                                    case "yakin":
                                                        $.ajax({
                                                            type: 'POST',
                                                            data: 'nama=' + nama + '&hp=' + hp + '&marketing=' + marketing + '&perusahaan=' + perusahaan + '&brand=' + brand + '&alasan=' + alasan + '&id=' + id,
                                                            url: '<?= base_url('visitor/editVisitor2'); ?>',
                                                            dataType: 'text',
                                                            success: function() {
                                                                swal('Berhasil', 'Data berhasil diinput ke database', 'success');
                                                                $('#nama').val('');
                                                                $('#hp').val('');
                                                                $('#department').val('');
                                                                $('#marketing').html('');
                                                                $('#brand').html('');
                                                                $('#marketing').attr('readonly', '');
                                                                $('#brand').attr('readonly', '');
                                                                $('input[type="checkbox"]').prop('checked', false);
                                                                $('.modal').modal('hide');
                                                                ambilData(0);
                                                            }
                                                        })
                                                        break;
                                                    default:
                                                        swal("Silahkan cek kembali");
                                                }
                                            })
                                    } else {
                                        swal('Berhasil', 'Data berhasil diinput ke database', 'success');
                                        $('#nama').val('');
                                        $('#hp').val('');
                                        $('#department').val('');
                                        $('#marketing').html('');
                                        $('#brand').html('');
                                        $('#marketing').attr('readonly', '');
                                        $('#brand').attr('readonly', '');
                                        $('input[type="checkbox"]').prop('checked', false);
                                        $('.modal').modal('hide');
                                        ambilData(0);
                                    }
                                }
                            })
                            break;

                        default:
                            swal("Silahkan cek kembali");
                    }
                })
        }
    }
</script>