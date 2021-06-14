<?php if ($cek > 0) { ?>
    <div class="container mt-5 pt-5">
        <div class="row mt-5">
            <div class="col"></div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-12">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h5 class="card-title">
                            Daftar Visitor Belum di closing
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="text-end mb-3">
                            <button class="btn btn-primary btn-sm" onclick="listClosing()">Closing</button>
                        </div>
                        <div class="table-responsive" id="target">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nama</th>
                                        <th>Brand</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="targetClosingBody"></tbody>
                            </table>
                            <div class="paginationClosing"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>

    <!-- modal -->
    <div class="modal modalOption fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Tanggal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Pilih Tanggal</label>
                        <select name="" class="form-control" id="tanggal">
                            <?php foreach ($tanggal as $a) { ?>
                                <option value="<?= $a; ?>"><?= $a; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" onclick="lihatClosing()">Lanjut</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modalDetail fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="targetDetail">
                </div>

            </div>
        </div>
    </div>


    <!-- modal edit -->

    <div class="modal modalEditClosing fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <button type="button" class="btn btn-primary" id="editClosing">Edit</button>
                    <button type="button" class="btn btn-success" onclick="tutup()">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- end modal edit -->
    <!-- modal -->
<?php } ?>

<script>
    $(document).ready(function() {
        ambilClosing(0);

        $('.paginationClosing').on('click', 'a', function(e) {
            e.preventDefault();
            var pageno = $(this).attr('data-ci-pagination-page');
            ambilClosing(pageno);
        });
    })

    function tutup() {
        $('.modalEditClosing').modal('hide');
        $('#nama').val('');
        $('#hp').val('');
        $('#targetMarketing').val('');
        $('#targetPerusahaan').val('');
        $('#targetBrand').val('');
        $('input[type="checkbox"]').prop('checked', false);
    }

    function ambilClosing(halaman) {
        // $.ajax({
        //     type: 'get',
        //     data: 'limit=10&halaman=' + halaman,
        //     url: '<?= base_url('closing/paginationClosing'); ?>',
        //     dataType: 'text',
        //     success: function(hasil) {
        //         $('#target').html(hasil);
        //     }
        // })

        $.ajax({
            type: 'GET',
            url: 'closing/paginationClosing/' + halaman,
            dataType: 'json',
            success: function(hasil) {
                console.log(hasil);
                $('.paginationClosing').html(hasil.pagination);
                table(hasil.hasil, hasil.brandArr, hasil.halaman, hasil.tanggal);
            }
        })
    }

    function table(hasil, brandArr, halaman, tanggal) {
        var isi = '';
        for ($i = 0; $i < hasil.length; $i++) {
            var brand = 'b' + hasil[$i].brand;
            if (brand in brandArr) {
                var brandList = brandArr[brand];
            }
            isi += '<tr class="trClosing" id="trClosing' + hasil[$i].id_visit + '" date-halaman="' + halaman + '">' +
                '<td>' + ++halaman + '</td>' +
                '<td>' + tanggal[$i] + '</td>' +
                '<td>' + hasil[$i].nama + '</td>' +
                '<td>' + brandList + '</td>' +
                '<td>' +
                '<div class="btn-group">' +
                '<button onclick="editClosing(' + hasil[$i].id_visit + ')" class="btn btn-sm"><img src="<?= base_url(); ?>/assets/images/editimg.png" width="15" height="15"></button>' +
                '</div>' +
                '</td>' +
                '</tr>';
        }
        $('#targetClosingBody').html(isi);
    }

    function deleteClosing(idVisit, halaman) {

    }

    function editClosing(idVisit) {
        $.ajax({
            type: 'POST',
            data: {
                id: idVisit
            },
            url: '<?= site_url('closing/editClosing'); ?>',
            dataType: 'json',
            success: function(hasil) {
                console.log(hasil);

                var halaman = $('#trClosing' + idVisit).data('halaman');

                $('.modalEditClosing').modal('show');

                //make content
                $('.editTanggalForm').val(hasil.tanggalInput);
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
                var sumberValue;
                if (hasil.sumber == 1) {
                    sumberName = 'Instagram Ads';
                    sumberValue = hasil.sumber;
                } else if (hasil.sumber == 2) {
                    sumberName = 'Facebook Ads';
                    sumberValue = hasil.sumber;
                } else if (hasil.sumber == 3) {
                    sumberName = 'Ayo Waralaba';
                    sumberValue = hasil.sumber;
                } else if (hasil.sumber == 4) {
                    sumberName = 'Waralabaku';
                    sumberValue = hasil.sumber;
                } else if (hasil.sumber == 5) {
                    sumberName = 'Dunia franchise';
                    sumberValue = hasil.sumber;
                } else if (hasil.sumber == 6) {
                    sumberName = 'Website';
                    sumberValue = hasil.sumber;
                } else if (hasil.sumber == 7) {
                    sumberName = 'Direct';
                    sumberValue = hasil.sumber;
                } else if (hasil.sumber == null) {
                    sumberName = '-';
                    sumberValue = '';
                }
                var sumber = '<option value="' + sumberValue + '">' + sumberName + '</option>';
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

                    alasanTemp += '<div class="form-check">' +
                        '<input class="form-check-input" type="radio" id="alasan' + hasil.alasanList[al].id + '" name="radioEditAlasan" value="' + hasil.alasanList[al].id + '">' +
                        '<label class="form-check-label" for="alasan' + hasil.alasanList[al].id + '">' + hasil.alasanList[al].alasan + '</label>' +
                        '</div>';

                }

                $('.targetAlasanEdit').html(alasanTemp);
                $('#alasan' + hasil.alasanId).prop('checked', true);

                //rating
                if (hasil.prospek != 0) {

                    $('#rating' + hasil.prospek).prop('checked', true);

                }

                // button
                $('#editClosing').attr('onclick', 'postEditClosing(' + hasil.idVisit + ', ' + halaman + ')');
            }
        })
    }

    function postEditClosing(idVisit, halaman) {
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

                        swal('Success', 'Edit data berhasil', 'success', {
                            buttons: false,
                            timer: 1500
                        });
                        //close modal
                        $('.modalEditClosing').modal('hide');
                        ambilClosing(halaman);

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
                    swal('Success', 'Edit data berhasil', 'success', {
                        buttons: false,
                        timer: 1500
                    });
                    //close modal
                    $('.modalEdit').modal('hide');

                    ambilClosing(halaman);
                }
            })

        }
    }

    function listClosing() {
        $('.modalOption').modal('show');
    }

    function lihatClosing() {
        var tanggal = $('#tanggal').val();
        $('.modalOption').modal('hide');
        $('.modalDetail').modal('show');

        $.ajax({
            type: 'POST',
            data: {
                tanggal: tanggal
            },
            url: '<?= base_url('closing/tampilkanClosing'); ?>',
            dataType: 'text',
            success: function(hasil) {
                $('#targetDetail').html(hasil);
                $('.modalDetail');
                ambilClosing(0);
            }
        })
    }

    function simpan(tanggal) {
        swal("Anda yakin closing data tersebut?", {
                buttons: {
                    cancel: "Tidak",
                    catch: {
                        text: "Yakin",
                        value: "yakin",
                    },
                },
            })
            .then((value) => {
                switch (value) {

                    case "yakin":
                        $.ajax({
                            type: 'POST',
                            data: 'tanggal=' + tanggal,
                            url: '<?= base_url('closing/prosesClosing'); ?>',
                            success: function(hasil) {
                                swal('Berhasil', 'Closing berhasil dilakukan', 'success', {
                                    buttons: false,
                                    timer: 900
                                })
                                $('.modalDetail').modal('hide');
                                setTimeout(function() {
                                    var url = '<?= base_url('closing'); ?>';
                                    window.location = url;
                                }, 900);
                            }
                        })
                        break;

                    default:
                        swal('Silahkan cek kembali', {
                            buttons: false,
                            timer: 700
                        });
                }
            });
    }
</script>