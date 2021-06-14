<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col"></div>
        <div class="col-md-8 col-sm-12 col-xs-12 text-center">
            <span class="spanDashboard">VISITORR</span>
        </div>
        <div class="col"></div>
    </div>
    <input type="password" style="display:none">
    <div class="row mb-5">
        <div class="col"></div>
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            <div class="input-group mb-3 search-dashboard">
                <div class="dropdown">
                    <button class="input-group-text dropdown-toggle" id="dashboard-search" data-bs-toggle="dropdown" aria-expanded="false">HP</button>
                    <ul class="dropdown-menu" aria-labelledby="dashboard-search">
                        <li><a class="dropdown-item" onclick="change_search_filter('2')" href="#">Hp</a></li>
                        <li><a class="dropdown-item" onclick="change_search_filter('1')" href="#">Nama</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="prospek11" id="1.1" onclick="change_search_filter('1.1', 'prospek-1')"><a data-key="1" class="dropdown-item prospek-1" href="#">Prospek 1.1</a></li>
                        <li class="prospek12" id="1.2" onclick="change_search_filter('1.1', 'prospek-2')"><a data-key="2" class="dropdown-item prospek-2" href="#">Prospek 1.2</a></li>
                        <li class="prospek13" id="1.3" onclick="change_search_filter('1.1', 'prospek-3')"><a data-key="3" class="dropdown-item prospek-3" href="#">Prospek 1.3</a></li>
                        <li class="prospek14" id="1.4" onclick="change_search_filter('1.1', 'prospek-4')"><a data-key="4" class="dropdown-item prospek-4" href="#">Prospek All</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="prospek21" id="2.1" onclick="change_search_filter('1.1', 'prospek-5')"><a data-key="5" data-border="5" class="dropdown-item prospek-5" href="#">Prospek 2.1</a></li>
                        <li class="prospek22" id="2.2" onclick="change_search_filter('1.1', 'prospek-6')"><a data-key="6" data-border="6" class="dropdown-item prospek-6" href="#">Prospek 2.2</a></li>
                        <li class="prospek23" id="2.3" onclick="change_search_filter('1.1', 'prospek-7')"><a data-key="7" data-border="7" class="dropdown-item prospek-7" href="#">Prospek 2.3</a></li>
                        <li class="prospek24" id="2.4" onclick="change_search_filter('1.1', 'prospek-8')"><a data-key="8" data-border="8" class="dropdown-item prospek-8" href="#">Prospek All</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="prospek31" id="3.1" onclick="change_search_filter('1.1', 'prospek-9')"><a data-key="9" data-border="9" class="dropdown-item prospek-9" href="#">Prospek 3.1</a></li>
                        <li class="prospek32" id="3.2" onclick="change_search_filter('1.1', 'prospek-10')"><a data-key="10" data-border="10" class="dropdown-item prospek-10" href="#">Prospek 3.2</a></li>
                        <li class="prospek33" id="3.3" onclick="change_search_filter('1.1', 'prospek-11')"><a data-key="11" data-border="11" class="dropdown-item prospek-11" href="#">Prospek 3.3</a></li>
                        <li class="prospek34" id="3.4" onclick="change_search_filter('1.1', 'prospek-12')"><a data-key="12" data-border="12" class="dropdown-item prospek-12" href="#">Prospek All</a></li>
                    </ul>
                </div>
                <input type="text" class="form-control search-field" data-type="hp" placeholder="Ketik nomor HP" aria-label="Username" aria-describedby="basic-addon1">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
            </div>
        </div>
        <div class="col"></div>
    </div>
    <div class="row">
        <div class="col"></div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="text-center">
                <p class="targetJumlah"></p>
                <p class="targetTanggal"></p>

            </div>
            <table class="target w-100 m-1">

            </table>
            <div class="d-flex justify-content-center">
                <div class="pagination"></div>
            </div>
        </div>
        <div class="col"></div>
    </div>

    <script>
        $(document).ready(function() {
            var type = $('.search-field').data('type');

            if (type == 'hp') {
                var page = 0;
                // $(".search-field").on('keyup', function(event) {
                //     if (event.keyCode === 13) {

                //         var kunci = $('.search-field').val();
                //         sortingData(kunci, type, page);

                //     }
                // });

                $('.search-field').autocomplete({
                    source: '<?= base_url('dashboard/autocomplete'); ?>',
                    close: function(event, ui) {
                        var kunci = $('.search-field').val();
                        sortingData(kunci, type, page);
                    },
                    minLength: 5
                })
            }

            $('.pagination').on('click', 'a', function(e) {
                e.preventDefault();
                var pageno = $(this).attr('data-ci-pagination-page');
                var border = $('.pagination').attr('data-border');
                var value = $('.search-field').val();
                var type = $('.search-field').attr('data-type');
                sortingData(value, type, pageno);
            });
        })

        function change_search_filter(key, border) {
            if (key == '1.1') {
                $('.search-field').val('');
                //change button text 
                $('#dashboard-search').text('Prospek');

                //change placeholder 
                $('.search-field').attr('placeholder', 'Ketik nama brand');

                //change data type 
                $('.search-field').attr('data-type', 'brand');
                var type = 'brand';

                var auto = '<?= base_url('dashboard/autocompleteBrand'); ?>';
                var minLength = 3;

                $('.search-field').focus();

                var border = $('.' + border).attr('data-key');
                $('.pagination').attr('data-border', border);

            } else if (key == '1') {
                $('.search-field').val('');
                //change button text 
                $('#dashboard-search').text('Nama');

                //change placeholde 
                $('.search-field').attr('placeholder', 'Ketik nama visitor');

                //change data type 
                $('.search-field').attr('data-type', 'name');
                var type = 'name'

                var auto = '<?= base_url('dashboard/autocompleteName'); ?>';
                var minLength = 3;

                $('.search-field').focus();

            } else if (key == 2) {
                $('.search-field').val('');
                //change button text 
                $('#dashboard-search').text('Hp');

                //change placeholder 
                $('.search-field').attr('placeholder', 'Ketik nomor HP');

                //change data type 
                $('.search-field').attr('data-type', 'hp');
                var type = 'hp';

                var auto = '<?= base_url('dashboard/autocomplete'); ?>';
                var minLength = 5;

                $('.search-field').focus();
            }

            //autocomplete
            var page = 0;
            $('.search-field').autocomplete({
                source: auto,
                close: function(event, ui) {
                    var kunci = $('.search-field').val();
                    sortingData(kunci, type, page, border);
                },
                minLength: minLength
            })
        }

        function sortingData(kunci, type, page) {
            var border = $('.pagination').attr('data-border');
            if (border == '' || border == undefined) {
                var newBorder = 0;
            } else {
                var newBorder = border;
            }
            if (kunci != '') {
                $.ajax({
                    type: 'GET',
                    url: '<?= site_url(); ?>/dashboard/find_data/' + newBorder + '/' + kunci + '/' + type + '/' + page,
                    dataType: 'json',
                    beforeSend: function() {
                        var x = '<div class="text-center">' +
                            '<span>Loading ....</span>' +
                            '<div class="spinner-grow text-info" role="status">' +
                            '<span class="visually-hidden">Loading...</span>' +
                            '</div>' +
                            '</div>';
                        $('.target').html(x);
                    },
                    success: function(hasil) {
                        console.log(hasil);

                        if (hasil.nama == '0') {
                            var error = '<tr><th class="text-center">User belum ada di database</th></tr>';
                            $('.target').html(error);
                            $('.targetJumlah').text('');
                            $('.targetTanggal').text('');
                        } else {
                            $('.pagination').html(hasil.pagination);

                            var collapse = '';
                            var kategori = '';
                            for (var i = 0; i < hasil.brandName.length; i++) {

                                // condition join
                                if (hasil.join[i] == 1) {
                                    var join = '<img src="<?= base_url(); ?>assets/images/check-mark.png" width="12" height="12">';
                                    // var tanggalJoin = '<div class="row mb-3">' +
                                    //     '<label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal Join</label>' +
                                    //     '<div class="col-sm-1"><span class="form-control" style="border: none;">:</span></div>' +
                                    //     '<div class="col-sm-9">' +
                                    //     '<span class="form-control" style="border: none;">' + hasil.tanggalJoin[i] + '</span>' +
                                    //     '</div>' +
                                    //     '</div>';
                                    var tanggalJoin = '';
                                } else {
                                    var join = '';
                                    var tanggalJoin = '';
                                }

                                //condition input tanggal di temukan 

                                // condition button text
                                if (type == 'brand') {
                                    var buttonText = '<span>' + hasil.nama[i] + ' - <span style="font-size: 0.7em;">' + hasil.tanggal[i] + '</span> </span>' +
                                        '<span><img src="<?= base_url(); ?>assets/images/chevron-down.png" width="10" height="10" class="chevron-down chev' + i + '"></span>';
                                } else if (type == 'hp' || type == 'name') {
                                    var buttonText = '<span>' + hasil.brandName[i] + ' - <span style="font-size: 0.7em;">' + hasil.ptName[i] + '</span> </span>' +
                                        '<span> <span style="margin-right: 0.5em;">' + join + '</span> <img src="<?= base_url(); ?>assets/images/chevron-down.png" width="10" height="10" class="chevron-down chev' + i + '"></span>';
                                }

                                if (hasil.prospek[i] == "1") {
                                    var prospek = '<img width="15" height="15" src="<?php base_url(); ?>assets/images/star.png">';
                                } else if (hasil.prospek[i] == "2") {
                                    var prospek = '<img width="15" height="15" src="<?php base_url(); ?>assets/images/star.png">' +
                                        '<img width="15" height="15" src="<?php base_url(); ?>assets/images/star.png">';
                                } else {
                                    var prospek = '<img width="15" height="15" src="<?php base_url(); ?>assets/images/star.png">' +
                                        '<img width="15" height="15" src="<?php base_url(); ?>assets/images/star.png">' +
                                        '<img width="15" height="15" src="<?php base_url(); ?>assets/images/star.png">';
                                }

                                //kategori
                                if (hasil.kategori[i] == 1) {
                                    var kategori = 'Anak - anak';
                                } else if (hasil.kategori[i] == 2) {
                                    var kategori = 'No respon';
                                } else {
                                    var kategori = 'Respon - ' + prospek;
                                }

                                collapse += '<button class="btn btn-light w-100 m-2 targetName d-flex justify-content-between" onclick="show_collapse('+ hasil.idVisit[i] +')">' +
                                    buttonText +
                                    '</button>' +
                                    // '<button class="btn btn-light w-100 m-2 targetName d-flex justify-content-between" data-bs-toggle="collapse" href="#collapseDashboard' + hasil.idVisit[i] + '" role="button" aria-expanded="false" aria-controls="collapseExample">' +
                                    // buttonText +
                                    // '</button>' +
                                    '<div class="collapse" id="collapseDashboard' + hasil.idVisit[i] + '">' +
                                    '<div class="card card-body">' +
                                    '<div class="row mb-3">' +
                                    '<span for="inputEmail3" class="col-sm-2 col-form-label">Tanggal Input</span>' +
                                    '<div class="col-sm-1"><span class="form-control" style="border: none;">:</span></div>' +
                                    '<div class="col-sm-9">' +
                                    '<span class="form-control" style="border: none;">' + hasil.tanggal[i] + '</span>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="row mb-3">' +
                                    '<label for="inputEmail3" class="col-sm-2 col-form-label">Marketing</label>' +
                                    '<div class="col-sm-1"><span class="form-control" style="border: none;">:</span></div>' +
                                    '<div class="col-sm-9">' +
                                    '<span class="form-control" style="border: none;">' + hasil.marketingName[i] + '</span>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="row mb-3">' +
                                    '<label for="inputEmail3" class="col-sm-2 col-form-label">Nama Customer</label>' +
                                    '<div class="col-sm-1"><span class="form-control" style="border: none;">:</span></div>' +
                                    '<div class="col-sm-9">' +
                                    '<span class="form-control" style="border: none;">' + hasil.nama[i] + '</span>' +
                                    '</div>' +
                                    '</div>' +
                                    tanggalJoin +
                                    '<div class="row mb-3">' +
                                    '<label for="inputEmail3" class="col-sm-2 col-form-label">No Handphone</label>' +
                                    '<div class="col-sm-1"><span class="form-control" style="border: none;">:</span></div>' +
                                    '<div class="col-sm-9">' +
                                    '<span class="form-control" style="border: none;">' + hasil.hp[i] + '</span>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="row mb-3">' +
                                    '<span for="inputEmail3" class="col-sm-2 col-form-label">Kategori</span>' +
                                    '<div class="col-sm-1"><span class="form-control" style="border: none;">:</span></div>' +
                                    '<div class="col-sm-9">' +
                                    '<span class="form-control" style="border: none;">' + kategori + '</span>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>';
                            }
                            $('.target').html(collapse);

                            //condition tanggal 
                            var tanggalAwal = hasil.allDate[0];
                            var tanggalAkhir = hasil.allDate[(hasil.allDate.length - 1)];

                            $('.targetJumlah').html(hasil.rows + ' data ditemukan');

                            if (hasil.targetTanggal == 0) {
                                $('.targetTanggal').text(tanggalAwal + ' - ' + tanggalAkhir);
                            } else {
                                $('.targetTanggal').html(hasil.targetTanggal);
                            }

                            // $('.targetTanggal').text(tanggalAwal + ' - ' + tanggalAkhir);
                            for (var x = 0; x < hasil.brandName.length; x++) {
                                var myCollapsible = document.getElementById('collapseDashboard' + hasil.idVisit[x])
                                myCollapsible.addEventListener('show.bs.collapse', function() {
                                    $('.chev' + x).addClass('rtr');
                                })

                                $(document).on('click', '#collapseDashboard' + hasil.idVisit[x], function(e) {
                                    if ($(e.target).is('a:not(".dropdown-bs-toggle")')) {
                                        $(this).collapse('hide');
                                    }
                                });

                                myCollapsible.addEventListener('hide.bs.collapse', function() {
                                    $('.chev' + x).removeClass('rtr');
                                })
                            }
                        }

                        return false;
                    }
                })
            }
        }


        $('.search-field').keypress(function(e) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {
                var id = $('#cari').attr('data-cari');
                var kunci = $('#cari').val();
                if (kunci == '') {
                    swal('Kosong', 'Mohon untuk menuliskan nomor pada kolom yang tersedia', 'error');
                } else {
                    $.ajax({
                        type: 'POST',
                        data: 'no=' + kunci + '&id=' + id,
                        url: '<?= base_url('dashboard/find_data/'); ?>',
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
                            $('#target').html(x);
                        },
                        success: function(hasil) {
                            if (hasil == '') {
                                swal('Harap masukan Nomor dengan benar');
                            } else {
                                $('#target').html(hasil);
                            }
                        }
                    })
                }
            }
            e.stopPropagation();
        })

        function show_collapse(idVisit) {
            // collapseDashboard
            $('#collapseDashboard' + idVisit).collapse('toggle');
        }
    </script>