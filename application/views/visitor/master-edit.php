<div class="container mt-5 pt-4">
    <div class="row">
        <div class="col-lg-3 col-md-12 col-sm-12 mb-3">
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <button class="btn btn-light btn-sm nav-link w-50" id="visitor">Visitor</button>
                </li>
                <?php if ($_SESSION['role'] < 3) { ?>
                    <li class="nav-item" id="cariTanggalGroup" hidden>
                        <button class="btn btn-primary btn-sm nav-link bulanan w-50" style="font-size: 0.7em;">Pilih Tanggal</button>
                    </li>
                    <div class="collapse mb-2" id="cariTanggalCheck" style="font-size: 0.8em;">
                        <div class="table-responsive">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-1">
                                        <label for="">Pilih Tanggal</label>
                                        <input type="text" class="form-control w-100" name="daterangepicker">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </ul>
        </div>
        <div class="col-lg-9 col-md-12 col-sm-12" id="masterVisitor" hidden>
        </div>
        <div class="col-lg-9 col-md-12 col-sm-12" id="masterVisitor1" hidden>
            <div class="card shadow">
                <div class="card-header text-center">
                    <h5 class="card-title">Detail</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col"></div>
                        <div class="col-md-6 col-sm-12 tanggalCari">

                        </div>
                        <div class="col"></div>
                    </div>
                    <?php if ($_SESSION['role'] < 3) { ?>
                        <div class="row">
                            <div class="col-md-7 col-sm-12 col-xs-12"></div>
                            <div class="col-md-5 col-sm-12 col-xs-12">
                                <!-- <div class="text-end">
                                    <form class="d-flex">
                                        <input class="form-control form-control-sm" id="cari" type="search" placeholder="Search" aria-label="Search" oninput="triggerPencarian()">
                                        <button class="btn rounded-circle text-primary" type="submit" id="sorting"><i class="fas fa-search"></i></button>
                                    </form>
                                </div> -->
                            </div>
                        </div>
                    <?php } ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">No</th>
                                    <th style="text-align: center;">Tanggal</th>
                                    <th style="text-align: center;">Nama</th>
                                    <th style="text-align: center;">Hp</th>
                                    <th style="text-align: center;">Brand</th>
                                    <th style="text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="targetBody"></tbody>
                        </table>
                        <div class="paginationDefault"></div>
                        <div class="paginationTanggal"></div>
                        <?php if ($_SESSION['role'] < 3) { ?>
                            <div class="closing text-end mt-3 mb-3" hidden>
                                <button class="btn btn-sm" style="border-radius: 10px; background-color: #71C1D8" id="closing">Closing </button>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal -->
<div class="modal modalEdit fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
            </div>
            <div class="modal-body" id="targetModal">

                <div class="table-responsive mb-3">
                    <div class="row mb-2">
                        <div class="col-md-12 col-sm-12">
                            <label for="">Tanggal</label>
                            <div class="searchDiv">
                                <input type="text" data-trigg="searchCrew" class="editTanggalForm" id="editTanggalForm">
                                <input type="text" style="display:none;" data-trigg="searchCrew" class="editTanggalForm1" id="editTanggalForm1">
                                <i class="fa fa-pen tanggalButton" style="margin-top: 0.5em;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="">Marketing</label>
                                <select id="marketing" class="form-control marketing" onchange="deleteOptgroup('marketing')">
                                    <optgroup label="Pilihan sebelumnya" class="currentMarketing">

                                    </optgroup>
                                    <optgroup label="Marketing list" class="targetMarketingList">

                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="">Brand</label>
                                <select id="brand" class="form-control brand" onchange="deleteOptgroup('brand')">
                                    <optgroup label="Pilihan sebelumnya" class="currentBrand">

                                    </optgroup>
                                    <optgroup label="Brand list" class="targetBrandList">

                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mb-3">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Nama Customer</label>
                                <input type="text" class="form-control namaEdit" id="nama">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mb-3">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">No Telfon Customer</label>
                                <input type="text" class="form-control hpEdit" id="hp">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mb-3">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Sumber Customer</label>
                                <select name="sumber" id="sumber" class="form-control">
                                    <optgroup class="sumberSebelumnya" label="Pilihan Sebelumnya"></optgroup>
                                    <optgroup class="sumberList" label="Pilihan Sumber"></optgroup>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mb-3">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Kategori</label>
                                <select name="" class="form-control" id="kategoriSelectEdit" onchange="changeGroup('kategori')">
                                    <optgroup label="Pilihan sebelumnya" class="currentKategori">

                                    </optgroup>
                                    <optgroup label="Kategori List" class="targetKategoriList">

                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mb-3">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Umur</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="umur" id="umurEdit1" value="1">
                                    <label class="form-check-label" for="30">
                                        < 20 tahun</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="umurEdit2" name="umur" value="2">
                                    <label class="form-check-label" for="30">20 - 30 tahun</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="umurEdit3" name="umur" value="3">
                                    <label class="form-check-label" for="30">30 - 40 tahun</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="umur" id="umurEdit4" value="4">
                                    <label class="form-check-label" for="atas">> 40 tahun</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mb-3" id="alasanGroupEdit">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Alasan</label>
                                <div class="targetAlasanEdit">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive" id="ratingGroupEdit">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="">Rating</label>
                                <div class="table-responsive">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="ratingEdit" type="radio" id="rating1" value="1">
                                        <label class="form-check-label" for="rating1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="30" fill="gold" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="ratingEdit" type="radio" id="rating2" value="2">
                                        <label class="form-check-label" for="rating2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="30" fill="gold" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="30" fill="gold" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="ratingEdit" type="radio" id="rating3" value="3">
                                        <label class="form-check-label" for="rating3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="30" fill="gold" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="30" fill="gold" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="30" fill="gold" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="editVisit">Edit</button>
                <button type="button" class="btn btn-success" onclick="tutup()">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal modalClosing fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Closing data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="targetClosing">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" onclick="btnClosing('<?= date('Y-m-d'); ?>')">Closing</button>
            </div>
        </div>
    </div>
</div>
<!-- modal -->

<script>
    $(document).ready(function() {
        //collapse 
        $('#visitor').click((e) => {
            e.preventDefault();
            // $('#cariTanggalCheck').collapse('toggle');
            $('#cariTanggalGroup').removeAttr('hidden');
        })

        $('.bulanan').click((e) => {
            e.preventDefault();
            $('#cariTanggalCheck').collapse('toggle');
            $('#cariTanggalGroup').removeAttr('hidden');
        })

        // condition collapse 
        var collapseTanggal = document.getElementById('cariTanggalCheck')
        // collapseTanggal.addEventListener('show.bs.collapse', function () {
        // })
        // $(function() {
        //     $('input[name="daterangepicker"]').daterangepicker({
        //         opens: 'left',
        //         showDropdowns: true,
        //         locale: {
        //             format: 'YYYY-MM-DD'
        //         }
        //     }, function(start, end, label) {
        //         var awal = start.format('YYYY-MM-DD');
        //         var akhir = end.format('YYYY-MM-DD');
        //         getDataByTanggal(awal, akhir, 0);
        //     });
        // })

        $('input[name="daterangepicker"]').daterangepicker({
            opens: 'left',
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD'
            }
        }, function(start, end, label) {
            var awal = start.format('YYYY-MM-DD');
            var akhir = end.format('YYYY-MM-DD');
            getDataByTanggal(awal, akhir, 0);
        });

        $('.datepicker').datepicker({
            format: 'MM, yyyy',
            startView: 'months',
            minViewMode: 'months',
            autoclose: true
        })

        $('.paginationDefault').on('click', 'a', function(e) {
            e.preventDefault();
            var pageno = $(this).attr('data-ci-pagination-page');
            ambilVisit(pageno);
        });

        $('.paginationTanggal').on('click', 'a', function(e) {
            e.preventDefault();
            var tanggalawal = $(this).attr('tanggalawal');
            var tanggalakhir = $(this).attr('tanggalakhir');
            var halaman = $(this).attr('data-ci-pagination-page');
            getDataByTanggal(tanggalawal, tanggalakhir, halaman);
        });

        $('#tambah').click(function() {
            $(this).attr('class', 'btn btn-primary btn-sm nav-link w-50');
            $('#visitor').attr('class', 'btn btn-light btn-sm nav-link w-50');
            $('#cariTanggalGroup').prop('hidden', true);
            $('#cariKategoriGroup').prop('hidden', true);
            $('#cariTanggal').attr('class', 'collapse');
            $.ajax({
                type: 'POST',
                url: '<?= base_url('visitor/tambahVisit'); ?>',
                dataType: 'text',
                beforeSend: function() {
                    var x = '<div class="text-center">' +
                        '<span>Loading ....</span> <br>' +
                        '<div class="spinner-grow text-info m-1" role="status">' +
                        '<span class="visually-hidden">Loading...</span>' +
                        '</div>' +
                        '<div class="spinner-grow text-warning m-1" role="status">' +
                        '<span class="visually-hidden">Loading...</span>' +
                        '</div>' +
                        '<div class="spinner-grow text-danger m-1" role="status">' +
                        '<span class="visually-hidden">Loading...</span>' +
                        '</div>' +
                        '<div class="spinner-grow text-success m-1" role="status">' +
                        '<span class="visually-hidden">Loading...</span>' +
                        '</div>' +
                        '</div>';
                    $('#masterVisitor').html(x);
                    $('#masterVisitor').removeAttr('hidden');
                    $('#targetBody').html('');
                    $('#masterVisitor1').attr('hidden', '');
                },
                success: function(hasil) {
                    $('#masterVisitor').fadeIn(100);
                    $('#masterVisitor').html(hasil);
                    $('#masterVisitor').removeAttr('hidden');
                    $('#targetBody').html('');
                    $('#masterVisitor1').attr('hidden', '');
                }
            })
        })

        $('#visitor').click(function() {
            $('.targetBody').html('');
            $(this).attr('class', 'btn btn-primary btn-sm nav-link w-50');
            $('#tambah').attr('class', 'btn btn-light btn-sm nav-link w-50');
            $('#cariTanggalGroup').removeAttr('hidden');
            $('#cariKategoriGroup').removeAttr('hidden');
            $('.paginationTanggal').html('');
            $('.tanggalCari').fadeOut('slow');
            $('#masterVisitor').attr('hidden', '');
            ambilVisit(0);
        })

        $('#closing').click(function() {
            $('.modalClosing').modal('show');
            $.ajax({
                type: 'POST',
                url: '<?= base_url('visitor/closing'); ?>',
                dataType: 'text',
                success: function(hasil) {
                    $('#targetClosing').html(hasil);
                }
            })
        })
    })

    function cariTanggal(tanggalAwal, tanggalAkhir, halaman) {
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '<?= site_url(); ?>/visitor/ambilVisitTanggal/' + '/' + tanggalAwal + '/' + tanggalAkhir + '/' + halaman,
            beforeSend: function() {
                var loading = '<p>Loading....</p>';
                $('#masterVisitor').html(loading);
                $('#targetJumlah').removeAttr('hidden');
                $('#cariTanggal').attr('class', 'collapse');
            },
            success: function(data) {
                if (data == 'tidak ada data') {
                    var isi = '<tr class="text-center fst-italic">' +
                        '<td colspan="6">Belum ada data</td>' +
                        '</tr>';
                    $('#masterVisitor1').removeAttr('hidden');
                    $('#targetBody').html(isi);
                } else {
                    // $('#masterVisitor').html(data);
                    var tanggalCari = data.tglTitleA + ' - ' + data.tglTitleK;
                    $('#targetJumlah').removeAttr('hidden');
                    $('#cariTanggal').attr('class', 'collapse');
                    $('.closing').prop('hidden', true);
                    $('#targetBody').html('');
                    $('.paginationTanggal').fadeIn('slow');
                    $('.paginationTanggal').html(data.pagination);
                    $('.paginationTanggal a').attr('tanggalawal', tanggalAwal);
                    $('.paginationTanggal a').attr('tanggalakhir', tanggalAkhir);
                    $('.paginationDefault').html('');
                    $('.tanggalCari').html(tanggalCari);
                    table(data.hasil, data.halaman, data.brandArray, data.tanggal, data.isClose, data.join);
                }
            }
        })
    }

    function triggerPencarian() {
        var data = $('#cari').val();
        if (data == '') {
            ambilVisit(0);
            $('#closing').removeAttr('hidden');
        } else {
            $.ajax({
                type: 'POST',
                data: {
                    data: data,
                    page: 0
                },
                url: '<?= base_url('visitor/sortingData'); ?>',
                dataType: 'text',
                beforeSend: function() {
                    var loading = '<p>Loading ....</p>';
                    $('.tableBody').prop('hidden', true);
                    $('.targetSorting').html(loading);
                    $('.targetSorting').removeAttr('hidden');
                    $('.tfoot').prop('hidden', true);
                    $('#closing').prop('hidden', true);
                },
                success: function(hasil) {
                    console.log(hasil)
                    return false;
                    $('#targetBody').html(hasil);
                    $('.paginationDefault').html('');
                    $('.paginationTanggal').html('');
                    // $('#masterVisitor1').html('');
                }
            })
        }
    }


    function tambahVisit() {
        $('.modal').modal('show');
    }

    function table(hasil, halaman, brandArr, tanggal, isClose, join) {
        var isi = '';
        for ($i = 0; $i < hasil.length; $i++) {
            var brand = 'b' + hasil[$i].brand;
            if (brand in brandArr) {
                var brandList = brandArr[brand];
            }
            if (isClose[$i] > 0) {
                var is = '<span style="font-size: 0.8em;" class="fst-italic">Sudah Closing</span>';
            } else if (join[$i] != null) {
                var is = '<span style="font-size: 0.8em;" class="fst-italic text-success">Sudah Join</span>';
            } else {
                var is = '<div class="btn-group" role="group">' +
                    '<a class="btn btn-sm text-warning" onclick="edit(' + hasil[$i].id_visit + ')"><i class="fas fa-pen"></i></a>' +
                    '<a class="btn btn-sm text-danger" onclick="hapusVisitor(' + hasil[$i].id_visit + ')"><i class="fas fa-trash"></i></a>' +
                    '</div>';
            }
            isi += '<tr class="rowVisitor" id="rowVisitor' + hasil[$i].id_visit + '">' +
                '<td>' + ++halaman + '</td>' +
                '<td>' + tanggal[$i] + ' </td>' +
                '<td>' + hasil[$i].nama + '</td>' +
                '<td>' + hasil[$i].hp + '</td>' +
                '<td>' + brandList + '</td>' +
                '<td>' + is + '</td>' +
                '</tr>';
        }
        $('#targetBody').html(isi);
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
                            //check row 
                            var row = $('.rowVisitor');
                            ambilVisit();
                            swal('Berhasil', 'Data berhasil di hapus', 'success', {
                                timer: 900,
                                buttons: false
                            });
                        }

                    })
                } else {
                    swal("Data anda aman");
                }
            })
    }

    function edit(id) {
        $('.modalEdit').modal('show');
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
                    data: 'id=' + id,
                    url: '<?= base_url('visitor/ambilAlasan'); ?>',
                    dataType: 'json',
                    success: function(data) {
                        $('input[id="alasanEdit' + data[0].alasan + '"]').prop('checked', true);
                        $('#kategoriOptionEdit').val(data[0].kategori);
                        $('input[id="umurEdit' + data[0].umur + '"]').prop('checked', true);
                        $('input[id="rating' + data[0].prospek + '"]').prop('checked', true);
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
        var nama = $('.namaEdit').val();
        var hp = $('.hpEdit').val();
        var marketing = $('.marketing').val();
        var perusahaan = $('#perusahaan').val();
        var brand = $('.brand').val();
        var alasan = $('input[name="radioEditAlasan"]:checked').val();
        var umur = $('input[name="umur"]:checked').val();
        var kategori = $('#kategoriSelectEdit').val();
        var prospek = $('input[name="ratingEdit"]:checked').val();
        var tanggal = $('.editTanggalForm').val();

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
                                data: 'nama=' + nama + '&hp=' + hp + '&marketing=' + marketing + '&perusahaan=' + perusahaan + '&brand=' + brand + '&alasan=' + alasan + '&id=' + id + '&umur=' + umur + '&kategori=' + kategori + '&prospek=' + prospek + '&tanggal=' + tanggal,
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
                                                            data: 'nama=' + nama + '&hp=' + hp + '&marketing=' + marketing + '&perusahaan=' + perusahaan + '&brand=' + brand + '&alasan=' + alasan + '&id=' + id + '&umur=' + umur + '&kategori=' + kategori + '&prospek=' + prospek + '&tanggal=' + tanggal,
                                                            url: '<?= base_url('visitor/editVisitor2'); ?>',
                                                            dataType: 'text',
                                                            success: function(hasil2) {
                                                                swal('Berhasil', 'Data berhasil diinput ke database', 'success', {
                                                                    timer: 900,
                                                                    buttons: false
                                                                });
                                                                $('#nama').val('');
                                                                $('#hp').val('');
                                                                $('#department').val('');
                                                                $('#marketing').html('');
                                                                $('#brand').html('');
                                                                $('#marketing').attr('readonly', '');
                                                                $('#brand').attr('readonly', '');
                                                                $('input[type="checkbox"]').prop('checked', false);
                                                                $('.modal').modal('hide');
                                                                if (hasil2 != 'tanggal tidak berubah') {
                                                                    $('#rowVisitor' + hasil2).remove();
                                                                }
                                                            }
                                                        })
                                                        break;
                                                    default:
                                                        swal("Silahkan cek kembali");
                                                }
                                            })
                                    } else {
                                        swal('Berhasil', 'Data berhasil diinput ke database', 'success', {
                                            timer: 900,
                                            buttons: false
                                        });
                                        $('#nama').val('');
                                        $('#hp').val('');
                                        $('#department').val('');
                                        $('#marketing').html('');
                                        $('#brand').html('');
                                        $('#marketing').attr('readonly', '');
                                        $('#brand').attr('readonly', '');
                                        $('input[type="checkbox"]').prop('checked', false);
                                        $('.modal').modal('hide');
                                        if (data != 'tanggal tidak berubah') {
                                            $('#rowVisitor' + data).remove();
                                        }
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



    // ------------------------ new revise ------------------------------- //

    function ambilVisit(halaman) {
        $.ajax({
            type: 'GET',
            url: '<?= site_url(); ?>/visitor/getVisitorMasterEdit/' + halaman,
            dataType: 'json',
            beforeSend: function() {
                var x = '<div class="text-center">' +
                    '<span>Loading ....</span> <br>' +
                    '<div class="spinner-grow text-info m-1" role="status">' +
                    '<span class="visually-hidden">Loading...</span>' +
                    '</div>' +
                    '<div class="spinner-grow text-warning m-1" role="status">' +
                    '<span class="visually-hidden">Loading...</span>' +
                    '</div>' +
                    '<div class="spinner-grow text-danger m-1" role="status">' +
                    '<span class="visually-hidden">Loading...</span>' +
                    '</div>' +
                    '<div class="spinner-grow text-success m-1" role="status">' +
                    '<span class="visually-hidden">Loading...</span>' +
                    '</div>' +
                    '</div>';
                $('#targetBody').html(x);
                $('#masterVisitor1').removeAttr('hidden');
            },
            success: function(hasil) {
                console.log(hasil);
                if (hasil.pesan == 'tidak ada data') {
                    var isi = '<tr class="text-center fst-italic">' +
                        '<td colspan="6">Belum ada data</td>' +
                        '</tr>';
                    $('#masterVisitor1').removeAttr('hidden');
                    $('#targetBody').html(isi);

                } else {
                    // $('#masterVisitor').html(hasil);
                    // $('#masterVisitor').removeAttr('hidden');
                    // if (hasil.closing > 0) {
                    //     $('.closing').removeAttr('hidden');
                    // }
                    $('#masterVisitor1').removeAttr('hidden');
                    $('.paginationDefault').html(hasil.pagination);

                    //create table

                    if (halaman == 1) {

                        var newHalaman = 0

                    } else {

                        var newHalaman = halaman;

                    }

                    createTable(hasil, '', '', newHalaman);
                    // table(hasil.hasil, hasil.halaman, hasil.brandArray, hasil.tanggal, hasil.isClose, hasil.join);
                }
            }
        })
    }

    function createTable(hasil, tanggalAwal = '', tanggalAkhir = '', halaman) {

        var tr = '';
        var awal = "'" + tanggalAwal + "'";
        var akhir = "'" + tanggalAkhir + "'";

        if (halaman > 0) {

            x = (halaman - 1) * 10;
            x = x + 1;

        } else {

            x = halaman + 1;

        }

        for (var i = 0; i < hasil.namaBrand.length; i++) {

            tr += '<tr class="rowVisitor rowVisitorHalaman' + halaman + '" data-tanggal-awal="' + tanggalAwal + '" data-tanggal-akhir="' + tanggalAkhir + '" data-halaman="' + halaman + '" id="trVisit' + hasil.idVisit[i] + '">' +
                '<td onclick="detailVisitor(' + hasil.idVisit[i] + ')" style="font-size: 0.8em; text-align: center;">' + x + '</td>' +
                '<td onclick="detailVisitor(' + hasil.idVisit[i] + ')" style="font-size: 0.8em; text-align: center;">' + hasil.tanggal[i] + '</td>' +
                '<td onclick="detailVisitor(' + hasil.idVisit[i] + ')" style="font-size: 0.8em; text-align: center;">' + hasil.nama[i] + '</td>' +
                '<td onclick="detailVisitor(' + hasil.idVisit[i] + ')" style="font-size: 0.8em; text-align: center;">' + hasil.hp[i] + '</td>' +
                '<td onclick="detailVisitor(' + hasil.idVisit[i] + ')" style="font-size: 0.8em; text-align: center;">' + hasil.namaBrand[i] + '</td>' +
                '<td style="text-align: center;">' +
                '<div class="btn-group">' +
                '<button onclick="deleteVisitor(' + hasil.idVisit[i] + ', ' + halaman + ')" class="btn btn-sm"><img src="<?= base_url(); ?>/assets/images/deleteimg.png" width="15" height="15"></button>' +
                '<button onclick="editVisitor(' + hasil.idVisit[i] + ')" class="btn btn-sm"><img src="<?= base_url(); ?>/assets/images/editimg.png" width="15" height="15"></button>' +
                '</div>' +
                '</td>' +
                '</tr>';

            x++;

        }

        $('#targetBody').html(tr);

    }

    function detailVisitor(idVisit) {
        $.ajax({
            type: "post",
            data: {
                idVisit: idVisit
            },
            url: '<?= base_url('Visitor/detailVisitor'); ?>',
            dataType: 'text',
            success: function(hasil) {}
        })
    }

    function deleteVisitor(idVisit, halaman) {

        var pageActive = $('.page-item.active .page-link').html();

        if (pageActive == undefined || pageActive == '') {

            var page = 0;

        } else {

            var page = $('.page-item.active .page-link').html().charAt(0);

        }

        $.ajax({
            type: 'post',
            data: {
                idVisit: idVisit,
                page: page
            },
            url: '<?= base_url('Visitor/deleteVisitor'); ?>',
            dataType: 'json',
            success: function(hasil) {

                if (hasil.pesan == 'success') {

                    swal('Berhasil', 'Data berhasil dihapus', 'success', {
                        buttons: false,
                        timer: 1500
                    })
                    // $('#trVisit' + idVisit).remove();

                    var tanggalAwal = $('#trVisit' + idVisit).data('tanggal-awal');
                    var tanggalAkhir = $('#trVisit' + idVisit).data('tanggal-akhir');
                    var halaman = $('#trVisit' + idVisit).data('halaman');

                    //remove row 
                    $('#trVisit' + idVisit).remove();

                    var row = $('.rowVisitorHalaman' + halaman).length;

                    if (row == 0) {
                        var halamanBaru = (halaman - 1);
                        getDataByTanggal(tanggalAwal, tanggalAkhir, halamanBaru);
                    } else {
                        getDataByTanggal(tanggalAwal, tanggalAkhir, halaman);
                    }

                }

            }
        })

    }

    function editVisitor(idVisitor) {
        var tanggalAwal = $('#trVisit' + idVisitor).data('tanggal-awal');
        var tanggalAkhir = $('#trVisit' + idVisitor).data('tanggal-akhir');
        var halaman = $('#trVisit' + idVisitor).data('halaman');

        var awal = "'" + tanggalAwal + "'";
        var akhir = "'" + tanggalAkhir + "'";

        var pageActive = $('.page-item.active .page-link').html();

        if (pageActive == undefined || pageActive == '') {

            var page = 0;

        } else {

            var page = $('.page-item.active .page-link').html().charAt(0);

        }

        $.ajax({
            type: "post",
            data: {
                idVisitor: idVisitor
            },
            url: '<?= base_url('Visitor/newEditVisitor'); ?>',
            dataType: 'json',
            success: function(hasil) {
                console.log(hasil);
                //show modal

                $('.modalEdit').modal('show');

                //make content
                $('.editTanggalForm1').hide();
                $('.editTanggalForm').show();
                $('.editTanggalForm').val(hasil.tanggalShow);
                $('.editTanggalForm1').val(hasil.tanggalInput);
                $('.editTanggalForm').attr('name', 'dateInput');
                $('.editTanggalForm').attr('readonly', true);
                $('.tanggalButton').attr('onclick', 'editTanggal()');

                $('.tanggalButton').css({
                    "color": "blue"
                });

                $('.searchDiv').css({
                    "background": "#EFEDED"
                });

                $('.editTanggalForm').css({
                    "background": "#EFEDED"
                });

                $('.editTanggalForm1').css({
                    "background": "#EFEDED"
                });



                //marketing
                var optGroup1 = '<option value="' + hasil.marketingId + '">' + hasil.marketingName + '</option>';

                $('.currentMarketing').show();
                $('.currentMarketing').html(optGroup1);

                var markList = '';

                for (var m = 0; m < hasil.marketingList.length; m++) {

                    markList += '<option value="' + hasil.marketingList[m].id + '">' + hasil.marketingList[m].name + '</option>';

                }

                $('.targetMarketingList').html(markList);

                // brand
                var brand1 = '<option value="' + hasil.brandId + '">' + hasil.brand + '</option>';

                $('.currentBrand').show();
                $('.currentBrand').html(brand1);

                var brandList = '';

                for (var b = 0; b < hasil.brandList.length; b++) {

                    brandList += '<option value="' + hasil.brandList[b].id_franchise + '">' + hasil.brandList[b].nama_franchise + '</option>';

                }

                $('.targetBrandList').html(brandList);

                //nama visitor
                $('.namaEdit').val(hasil.nama);
                $('.hpEdit').val(hasil.hp);

                //sumber visitor
                var sumberName;
                if (hasil.sumber == 1) {
                    sumberName = 'Instagram Ads';
                } else if (hasil.sumber == 2) {
                    sumberName = 'Facebook Ads';
                } else if (hasil.sumber == 3) {
                    sumberName = 'Ayo Waralaba';
                } else if (hasil.sumber == 4) {
                    sumberName = 'Waralabaku';
                } else if (hasil.sumber == 5) {
                    sumberName = 'Dunia franchise';
                } else if (hasil.sumber == 6) {
                    sumberName = 'Website';
                } else if (hasil.sumber == 7) {
                    sumberName = 'Direct';
                } else if (hasil.sumber == 8) {
                    sumberName = 'Tiktok Ads';
                } else if (hasil.sumber == '' || hasil.sumber == 0 || hasil.sumber == null) {
                    sumberName = '-';
                }

                if (hasil.sumber == '' || hasil.sumber == 0 || hasil.sumber == null) {
                    var newSumber = '0';
                } else {
                    var newSumber = hasil.sumber;
                }
                var sumber = '<option value="' + newSumber + '">' + sumberName + '</option>';
                $('.sumberSebelumnya').html(sumber);

                var sumberList = '<option value="1">Instagram Ads</option>' +
                    '<option value="2">Facebook Ads</option>' +
                    '<option value="3">Ayo Waralaba</option>' +
                    '<option value="4">Waralabaku</option>' +
                    '<option value="5">Dunia Franchise</option>' +
                    '<option value="6">Website</option>' +
                    '<option value="7">Direct</option>';
                $('.sumberList').html(sumberList);

                //kategori
                var kat1 = '<option value="' + hasil.kategoriId + '">' + hasil.kategori + '</option>';
                var kat2 = '<option value="3">Respon</option>' +
                    '<option value="2">No Respon</option>' +
                    '<option value="1">Anak - anak</option>';

                $('.currentKategori').html(kat1);
                $('.targetKategoriList').html(kat2);

                //condition
                $('.currentKategori').show();
                if (hasil.kategori == 'No respon' || hasil.kategori == 'Anak - anak') {

                    $('#alasanGroupEdit').prop('hidden', true);
                    $('#ratingGroupEdit').prop('hidden', true);

                } else {

                    $('#alasanGroupEdit').removeAttr('hidden');
                    $('#ratingGroupEdit').removeAttr('hidden');

                }

                //umur
                $('#umurEdit' + hasil.umur).prop('checked', true);

                //alasan
                var alasanTemp = '';

                for (var al = 0; al < hasil.alasanList.length; al++) {

                    if (hasil.alasanId == hasil.alasanList[al].id) {
                        var check = 'checked';
                    } else {
                        var check = '';
                    }

                    var sessPt = '<?php echo $_SESSION['pt']; ?>';

                    if (sessPt != 41) {
                        alasanTemp += '<div class="form-check">' +
                            '<input class="form-check-input" ' + check + ' type="radio" id="alasan' + hasil.alasanList[al].id + '" name="radioEditAlasan" value="' + hasil.alasanList[al].id + '">' +
                            '<label class="form-check-label" for="alasan' + hasil.alasanList[al].id + '">' + hasil.alasanList[al].alasan + '</label>' +
                            '</div>';
                    } else {
                        alasanTemp += '<div class="form-check">' +
                            '<input class="form-check-input" ' + check + ' type="radio" id="alasan' + hasil.alasanList[al].id + '" name="radioEditAlasan" value="' + hasil.alasanList[al].id + '">' +
                            '<label class="form-check-label" for="alasan' + hasil.alasanList[al].id + '">' + hasil.alasanList[al].alasan + '</label>' +
                            '</div>';
                    }

                }

                $('.targetAlasanEdit').html(alasanTemp);

                //rating
                if (hasil.prospek != 0) {

                    $('#rating' + hasil.prospek).prop('checked', true);

                }

                // button
                $('#editVisit').attr('onclick', 'postEdit(' + hasil.idVisit + ', ' + halaman + ', ' + awal + ', ' + akhir + ')');

            }

        })
    }

    function postEdit(idVisit, halaman, tanggalAwal, tanggalAkhir) {
        var today = new Date();
        var y = today.getFullYear();
        var m = addZero((today.getMonth() + 1));
        var d = addZero(today.getDate());
        var newYear = y + '-' + m + '-' + d;
        var time = new Date(newYear).getTime();
        var selectedTime = new Date($('.editTanggalForm1').val()).getTime();

        var tanggal = $('.editTanggalForm1').val();
        var nama = $('.namaEdit').val();
        var hp = $('.hpEdit').val();
        var sumber = $('#sumber').val();
        var marketing = $('#marketing').val();
        var brand = $('#brand').val();
        var kategori = $('#kategoriSelectEdit').val();
        var umur = $('input[name="umur"]:checked').val();
        var alasan = $('input[name="radioEditAlasan"]:checked').val();
        var prospek = $('input[name="ratingEdit"]:checked').val();

        //validation
        if (selectedTime > time) {

            swal('Gagal', 'Tanggal tidak boleh lebih dari ' + newYear, 'error', {
                buttons: false,
                timer: 1500
            });

        } else if (tanggal == '') {

            swal('Gagal', 'Tanggal harus diisi', 'error', {
                buttons: false,
                timer: 1500
            });

        } else if (nama == '') {

            swal('Gagal', 'Nama harus diisi', 'error', {
                buttons: false,
                timer: 1500
            });

        } else if (hp == '') {

            swal('Gagal', 'No Hp harus diisi', 'error', {
                buttons: false,
                timer: 1500
            });

        } else if (kategori == 3) {

            if (alasan == undefined || alasan == '') {

                swal('Gagal', 'Alasan harus diisi', 'error', {
                    buttons: false,
                    timer: 1500
                });

            } else if (prospek == undefined || prospek == '') {

                swal('Gagal', 'Rating / Prospek harus diisi', 'error', {
                    buttons: false,
                    timer: 1500
                });

            } else {
                $.ajax({
                    type: 'post',
                    data: {
                        nama: nama,
                        tanggal: tanggal,
                        sumber: sumber,
                        marketing: marketing,
                        brand: brand,
                        hp: hp,
                        kategori: kategori,
                        umur: umur,
                        alasan: alasan,
                        prospek: prospek,
                        idVisit: idVisit
                    },
                    url: '<?= base_url('Visitor/postEdit'); ?>',
                    dataType: 'text',
                    success: function(hasil) {
                        console.log(hasil)

                        //close modal
                        $('.modalEdit').modal('hide');
                        if (tanggalAkhir == '') {
                            ambilVisit(halaman);
                        } else {
                            getDataByTanggal(tanggalAwal, tanggalAkhir, halaman);
                        }

                    }
                })

            }

        } else {

            $.ajax({
                type: 'post',
                data: {
                    nama: nama,
                    tanggal: tanggal,
                    marketing: marketing,
                    sumber: sumber,
                    brand: brand,
                    hp: hp,
                    kategori: kategori,
                    umur: umur,
                    alasan: alasan,
                    prospek: prospek,
                    idVisit: idVisit
                },
                url: '<?= base_url('Visitor/postEdit'); ?>',
                dataType: 'text',
                success: function(hasil) {
                    console.log(hasil)
                    //close modal
                    $('.modalEdit').modal('hide');

                    getDataByTanggal(tanggalAwal, tanggalAkhir, halaman);
                }
            })

        }

    }

    function deleteOptgroup(key) {

        if (key == 'brand') {

            $('.currentBrand').hide();

        } else if (key == 'marketing') {

            $('.currentMarketing').hide();

        }

    }

    function changeGroup(key) {

        $('.currentKategori').hide();

        var kategori = $('#kategoriSelectEdit').val();

        if (kategori > 2) {

            $('#alasanGroupEdit').removeAttr('hidden');
            $('#ratingGroupEdit').removeAttr('hidden');

            $('#rating1').val(1);
            $('#rating2').val(2);
            $('#rating3').val(3);

        } else {

            $('#alasanGroupEdit').prop('hidden', true);
            $('#ratingGroupEdit').prop('hidden', true);

            $('input[name="radioEditAlasan"]').val('');
            $('input[name="radioEditAlasan"]').removeAttr('checked');

            $('input[name="ratingEdit"]').val('');
            $('input[name="ratingEdit"]').prop('checked', false);

        }

    }

    function editTanggal() {
        $('.editTanggalForm1').show();
        $('.editTanggalForm').hide();

        var today = new Date();
        var y = today.getFullYear();
        var m = addZero((today.getMonth() + 1));
        var d = addZero(today.getDate());

        var currentDate = m + '/' + d + '/' + y;

        // $(function() {
        //     $('#editTanggalForm').daterangepicker({
        //         "singleDatePicker": true,
        //         "locale": {
        //             "format": "MM/DD/YYYY",
        //             "separator": " - ",
        //             "applyLabel": "Apply",
        //             "cancelLabel": "Cancel",
        //             "fromLabel": "From",
        //             "toLabel": "To",
        //             "customRangeLabel": "Custom",
        //             "weekLabel": "W",
        //             "firstDay": 1
        //         },
        //         "linkedCalendars": false,
        //         "showCustomRangeLabel": false,
        //         "startDate": currentDate,
        //         "endDate": "03/16/2021",
        //         "opens": "left",
        //     }, function(start, end, label) {
        //         var choiceDate = start.format('YYYY-MM-DD');
        //         ubahTanggal(choiceDate);
        //     });
        // })
        $('.editTanggalForm1').datepicker({
            format: 'yyyy-mm-dd',
            todayBtn: true,
            todayHighlight: true,
            autoclose: true
        })
    }

    function ubahTanggal(tanggal) {
        $('#editTanggalForm').hide();

        var newDate = new Date(tanggal);
        var y = newDate.getFullYear();
        var m = (newDate.getMonth() + 1);
        var d = newDate.getDate();

        var lastDate = y + '-' + m + '-' + d;

        $.ajax({
            type: 'post',
            data: {
                lastDate: lastDate
            },
            url: '<?= base_url('visitor/changeDate'); ?>',
            dataType: 'text',
            success: function(hasil) {

                $('.editTanggalForm1').val(hasil);

                $('.editTanggalForm1').val();

                $('.editTanggalForm1').css({
                    "background-color": "#EFEDED"
                });
                $('.editTanggalForm1').show();

            }
        })

    }

    function getDataByTanggal(tanggalAwal, tanggalAkhir, halaman) {

        $.ajax({
            type: 'post',
            data: {
                tanggalAwal: tanggalAwal,
                tanggalAkhir: tanggalAkhir
            },
            url: '<?= base_url('Visitor/getDataByTanggalMasterEdit'); ?>/' + halaman,
            dataType: 'json',
            beforeSend: function() {
                var x = '<div class="text-center">' +
                    '<span>Loading ....</span> <br>' +
                    '<div class="spinner-grow text-info m-1" role="status">' +
                    '<span class="visually-hidden">Loading...</span>' +
                    '</div>' +
                    '<div class="spinner-grow text-warning m-1" role="status">' +
                    '<span class="visually-hidden">Loading...</span>' +
                    '</div>' +
                    '<div class="spinner-grow text-danger m-1" role="status">' +
                    '<span class="visually-hidden">Loading...</span>' +
                    '</div>' +
                    '<div class="spinner-grow text-success m-1" role="status">' +
                    '<span class="visually-hidden">Loading...</span>' +
                    '</div>' +
                    '</div>';
                $('#targetBody').html(x);
                $('#masterVisitor1').removeAttr('hidden');
            },
            success: function(hasil) {
                console.log(hasil);
                if (hasil.pesan == 'tidak ada data') {
                    var isi = '<tr class="text-center fst-italic">' +
                        '<td colspan="6">Belum ada data</td>' +
                        '</tr>';
                    $('#masterVisitor1').removeAttr('hidden');
                    $('#targetBody').html(isi);

                } else {
                    // $('#masterVisitor').html(hasil);
                    // $('#masterVisitor').removeAttr('hidden');
                    // if (hasil.closing > 0) {
                    //     $('.closing').removeAttr('hidden');
                    // }
                    $('#masterVisitor1').removeAttr('hidden');
                    $('.paginationDefault').html('');
                    $('.paginationTanggal').html(hasil.pagination);
                    $('.paginationTanggal a').attr('tanggalawal', tanggalAwal);
                    $('.paginationTanggal a').attr('tanggalakhir', tanggalAkhir);


                    //create table

                    createTable(hasil, tanggalAwal, tanggalAkhir, halaman);
                }

            }
        })

    }
</script>