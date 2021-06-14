<div class="card shadow" style="max-height: 80%">
    <div class="card-header text-center">
        <h5 class="card-title">Tambah data</h5>
    </div>
    <div class="table-responsive">
        <div class="card-body">
            <div class="row mb-3">
                <label for="" class="col-form-label col-sm-4 col-form-label-sm">Tanggal</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control form-control-sm" id="tanggalVisit" autocomplete="off" placeholder="Pilih tanggal Visit">
                </div>
            </div>
            <div class="row mb-3" hidden>
                <label for="" class="col-form-label col-sm-4 col-form-label-sm">Department</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control form-control-sm border-0 bg-white" readonly id="pt">
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-form-label col-sm-4 col-form-label-sm">Marketing</label>
                <div class="col-sm-8">
                    <select id="marketing" class="form-control form-control-sm" readonly>

                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-form-label col-sm-4 col-form-label-sm">Brand</label>
                <div class="col-sm-8">
                    <select id="brand" class="form-control form-control-sm" readonly>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-form-label col-sm-4 col-form-label-sm">Nomor Telfon</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control form-control-sm" id="hp" placeholder="Diawali dengan angka 0, Ex: 08976076029">
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-form-label col-sm-4 col-form-label-sm">Nama Visitor</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control form-control-sm" id="nama">
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-form-label col-sm-4 col-form-label-sm">Sumber Visitor</label>
                <div class="col-sm-8">
                    <select name="sumber" id="sumber" class="form-control form-control-sm">
                        <option value="">-- Pilih --</option>
                        <option value="1">Instagram Ads</option>
                        <option value="2">Facebook Ads</option>
                        <option value="3">Ayo Waralaba</option>
                        <option value="4">Waralabaku</option>
                        <option value="5">Dunia Franchise</option>
                        <option value="6">Website</option>
                        <option value="7">Direct</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-form-label col-sm-4 col-form-label-sm">Jenis Kelamin</label>
                <div class="col-sm-8">
                    <div class="form-check">
                        <input class="form-check-input " type="radio" name="jenisKelamin" id="laki" value="l">
                        <label class="form-check-label" for="laki">
                            Laki - laki
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenisKelamin" id="perempuan" value="p">
                        <label class="form-check-label" for="perempuan">
                            Perempuan
                        </label>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-form-label col-form-label-sm col-sm-4">Umur</label>
                <div class="col-sm-8">

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="umur" id="30" value="1">
                        <label class="form-check-label" for="30">
                            < 20 tahun</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="umur" id="31" value="2">
                        <label class="form-check-label" for="31">20 - 30 tahun</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="umur" id="32" value="3">
                        <label class="form-check-label" for="32">30 - 40 tahun</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="umur" id="atas" value="4">
                        <label class="form-check-label" for="atas">> 40 tahun</label>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-form-label col-form-label-sm col-sm-4">Kota / Provinsi</label>
                <div class="col-sm-4">
                    <select name="cariKota" class="form-control form-control-sm" id="cariKota" onchange="ubahKota()">
                        <option value="">-- Pilih --</option>
                        <?php foreach ($kota as $row) { ?>
                            <option value="<?= $row->id_city; ?>"><?= $row->city_name; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    <select name="" class="form-control form-control-sm" id="prov" readonly>
                        <option value="" id="targetProv"></option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-form-label col-form-label-sm col-sm-4">Kategori</label>
                <div class="col-sm-8">
                    <select name="" class="form-control form-control-sm" id="kategori" onchange="ubahProspek()">
                        <option value="3">Respon</option>
                        <option value="2">No Respon</option>
                        <option value="1">Anak - anak</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3" id="quoteGroup">
                <label for="" class="col-form-label col-form-label-sm col-sm-4">Prospek</label>
                <div class="col-sm-8">
                    <div class="table-responsive">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input ratingcek" name="rating" type="radio" id="inlineCheckbox1" value="1">
                            <label class="form-check-label" for="inlineCheckbox1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="30" fill="gold" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                </svg>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="rating" type="radio" id="inlineCheckbox2" value="2">
                            <label class="form-check-label" for="inlineCheckbox2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="30" fill="gold" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="30" fill="gold" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                </svg>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="rating" type="radio" id="inlineCheckbox3" value="3">
                            <label class="form-check-label" for="inlineCheckbox3">
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
            <div class="row" id="alasanGroup">
                <?php if ($_SESSION['pt'] != 41) { ?>
                    <?php if ($jAlasan != 0) { ?>
                        <label for="" class="col-form-label col-sm-4 col-form-label-sm">Alasan</label>
                        <div class="col-sm-8">
                            <?php foreach ($alasan as $a) { ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radioAlasan" value="<?= $a->id; ?>" id="alasan<?= $a->id; ?>">
                                    <label class="form-check-label" for="alasan<?= $a->id; ?>">
                                        <?= $a->alasan; ?>
                                    </label>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-danger" role="alert">
                            <p>Database alasan belum ada, Silahkan tambah alasan terlebih dahulu</p>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <label for="" class="col-form-label col-sm-4 col-form-label-sm">Alasan</label>
                    <div class="col-sm-8">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radioAlasan" value="11" id="alasan11">
                            <label class="form-check-label" for="alasan11">
                                Modal
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radioAlasan" value="12" id="alasan12">
                            <label class="form-check-label" for="alasan12">
                                Diskusi
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radioAlasan" value="13" id="alasan13">
                            <label class="form-check-label" for="alasan13">
                                Design sendiri
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radioAlasan" value="14" id="alasan14">
                            <label class="form-check-label" for="alasan14">
                                Tidak tertarik katalog
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radioAlasan" value="15" id="alasan15">
                            <label class="form-check-label" for="alasan15">
                                Ongkir
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radioAlasan" value="16" id="alasan16">
                            <label class="form-check-label" for="alasan16">
                                Beli satuan
                            </label>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row mb-3">
            <div class="col"></div>
            <div class="col col-md-6 col-sm-12">
                <button class="btn btn-primary btn-sm w-100" onclick="cek_data()" <?= ($jAlasan == 0) ? 'disabled' : ''; ?>>Simpan Data</button>
            </div>
            <div class="col"></div>
        </div>
    </div>
</div>

<!-- modal confirmation -->

<div class="modal fade modal-data-confirmation" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data ditemukan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger text-center" role="alert">
                    Data visitor ini sudah pernah di input
                </div>
                <button class="btn btn-light button-collapse-confirmation w-100" type="button">Tampilkan data</button>
                <div class="row">
                    <div class="col">
                        <div class="collapse multi-collapse" id="collapse-data-confirmation">
                            <div class="card card-body targetConfirmation">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- end modal confirmation -->

<script>
    $(document).ready(function() {

        $('.button-collapse-confirmation').click((e) => {
            e.preventDefault();

            $('#collapse-data-confirmation').collapse('toggle');
        })

        var myCollapsible = document.getElementById('collapse-data-confirmation')
        myCollapsible.addEventListener('shown.bs.collapse', function() {
            $('.btn-confirmation').show();
        })
        myCollapsible.addEventListener('hide.bs.collapse', function() {
            $('.btn-confirmation').hide();
        })

        getMarketing();
        getBrand();


        $('#tanggalVisit').datepicker({
            format: 'yyyy-mm-dd',
            todayBtn: true,
            todayHighlight: true,
            autoclose: true
        })

        $('#hp').autocomplete({
            source: '<?= base_url('dashboard/autocomplete'); ?>'
        })

        $('#cariKota').select2();
    })

    function getMarketing() {
        $.ajax({
            type: 'POST',
            url: '<?= base_url('visitor/getMarketing'); ?>',
            dataType: 'json',
            success: function(hasil) {
                var pilih = '<option value="">-- Pilih --</option>';
                $('#marketing').html(pilih);

                var mark = '';
                for (var i = 0; i < hasil.id.length; i++) {

                    mark += '<option value="' + hasil.id[i] + '">' + hasil.name[i] + '</option>';

                }

                $('#marketing').append(mark);
                $('#marketing').removeAttr('readonly');

            }
        })
    }

    function getBrand() {
        $.ajax({
            type: "POST",
            url: '<?= base_url('visitor/getBrand'); ?>',
            dataType: 'json',
            success: function(hasil) {

                var pilih = '<option value="">-- Pilih --</option>';
                $('#brand').html(pilih);

                var baris = '';
                for (var u = 0; u < hasil.brand.length; u++) {
                    baris += '<option value="' + hasil.id[u] + '">' + hasil.brand[u] + '</option>';
                }
                $('#brand').append(baris);
                $('#brand').removeAttr('readonly');

            }
        })
    }

    function ubahJKdanUmur() {
        var hp = $('#hp').val();

        //change format 
        var format = hp.substring(0, 2);
        if (format == '62') {
            var split = hp.split('62');
            var newFormat = '0' + split[1];
        } else {
            var newFormat = hp;
        }

        $('#hp').val(newFormat);

        $.ajax({
            type: 'POST',
            data: {
                hp: hp
            },
            url: '<?= base_url('visitor/cekDataDenganHp'); ?>',
            dataType: 'json',
            success: function(hasil) {
                if (hasil != 'tidak ada') {
                    $('input[value="' + hasil[0].j_kelamin + '"]').prop('checked', true);
                    $('input[value="' + hasil[0].umur + '"]').prop('checked', true);
                    $('input[name="rating"]').prop('checked', false);
                }
            }
        })
    }

    function ubahProspek() {
        var kategori = $('#kategori').val();
        if (kategori != 3) {
            $('#quoteGroup').fadeOut(100);
            $('#alasanGroup').fadeOut(100);
            $('input[name="rating"]').prop('checked', true);
            // $('input[name="rating"]:checked').val('0');
            $('input[name="radioAlasan"]').prop('checked', true);
            // $('input[name="radioAlasan"]:checked').val('0');
        } else {
            $('#quoteGroup').fadeIn(300);
            $('#alasanGroup').fadeIn(100);
            $('input[name="rating"]').prop('checked', false);
            $('input[name="radioAlasan"]').prop('checked', false);
        }
    }

    function ubahKota() {
        var idKota = $('#cariKota').val();
        $.ajax({
            type: 'POST',
            data: {
                id: idKota
            },
            url: '<?= base_url('visitor/ambilProv'); ?>',
            dataType: 'text',
            success: function(hasil) {
                $('#targetProv').text(hasil);
            }
        })
    }

    function cek_data() {
        var hp = $('#hp').val();
        var brand = $('#brand').val();

        $.ajax({
            type: 'post',
            data: {
                hp: hp,
                brand: brand
            },
            url: "<?= site_url('visitor/cekData'); ?>",
            dataType: 'text',
            success: function(response) {
                if (response != 'continue') {
                    //show modal 
                    $('.modal-data-confirmation').modal('show');
                    $('.targetConfirmation').html(response);
                } else {
                    simpan()
                }
            }
        })
    }

    function simpan() {
        var nama = $('#nama').val();
        var hp = $('#hp').val();
        var marketing = $('#marketing').val();
        var perusahaan = <?= $_SESSION['pt']; ?>;
        var brand = $('#brand').val();
        var kategori = $('select[id="kategori"]').val();
        var sumber = $('#sumber').val();

        if (kategori < 3) {
            var alasan = ["0"];
        } else {
            var alasan = $('input[name="radioAlasan"]:checked').map(function() {
                return $(this).val();
            }).toArray();
        }

        var kelamin = $('input[name="jenisKelamin"]:checked').val();
        var umur = $('input[name="umur"]:checked').val();
        var kota = $('#cariKota').val();

        if (kategori < 3) {
            var prospek = ["0"];
        } else {
            var prospek = $('input[name="rating"]:checked').map(function() {
                return $(this).val();
            }).toArray();
        }

        var tanggal = $('#tanggalVisit').val();
        var today = new Date();
        var y = today.getFullYear();
        var m = addZero((today.getMonth() + 1));
        var d = addZero(today.getDate());
        var newDate = y + '-' + m + '-' + d;
        var newTime = new Date(tanggal).getTime();
        var defTime = new Date(newDate).getTime()

        if (newTime > defTime) {
            swal('Error', 'tidak bisa memilih tanggal lebih dari ' + newDate, 'error', {
                buttons: false,
                timer: 1500
            })
        } else if (nama == '') {
            swal('Error', 'Nama harus diisi', 'error', {
                timer: 900,
                buttons: false
            });
        } else if (hp == '') {
            swal('Error', 'No Telfon harus diisi', 'error', {
                timer: 900,
                buttons: false
            });
        } else if (sumber == '') {
            swal('Error', 'Sumber visitor harus diisi', 'error', {
                timer: 900,
                buttons: false
            });
        } else if (alasan == '') {
            swal('Error', 'Setidaknya pilih salah satu alasan', 'error', {
                timer: 900,
                buttons: false
            });
        } else if (marketing == '') {
            swal('Error', 'Nama marketing harus diisi', 'error', {
                timer: 900,
                buttons: false
            });
        } else if (perusahaan == '') {
            swal('Error', 'Perusahaan harus diisi', 'error', {
                timer: 900,
                buttons: false
            });
        } else if (brand == '') {
            swal('Error', 'Brand harus diisi', 'error', {
                timer: 900,
                buttons: false
            });
        } else if (kelamin == '') {
            swal('Error', 'Kolom jenis kelamin masih kosong', 'error', {
                timer: 900,
                buttons: false
            });
        } else if (umur == '') {
            swal('Error', 'Umur belum diisi', 'error', {
                timer: 900,
                buttons: false
            });
        } else if (kota == '') {
            swal('Error', 'Kota belum diisi', 'error', {
                timer: 900,
                buttons: false
            });
        } else if (kategori == '') {
            swal('Error', 'Kategori belum diisi', 'error', {
                timer: 900,
                buttons: false
            });
        } else if (prospek == '') {
            swal('Error', 'Prospek belum diisi', 'error', {
                timer: 900,
                buttons: false
            });
        } else if (tanggal == '') {
            swal('Error', 'Tanggal belum diisi', 'error', {
                timer: 900,
                buttons: false
            });
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
                                data: 'nama=' + nama + '&hp=' + hp + '&marketing=' + marketing + '&perusahaan=' + perusahaan + '&brand=' + brand + '&alasan=' + alasan + '&kelamin=' + kelamin + '&umur=' + umur + '&kota=' + kota + '&kategori=' + kategori + '&prospek=' + prospek + '&tanggal=' + tanggal + '&sumber=' + sumber,
                                url: '<?= base_url('visitor/tambahVisitor'); ?>',
                                dataType: 'text',
                                success: function(data) {
                                    console.log(data);
                                    if (data == 'Data sama') {
                                        swal('Gagal', 'Brand dan nomor hp sudah ada di database', 'error');
                                    } else {
                                        swal('Berhasil', 'Data berhasil diinput ke database', 'success', {
                                            timer: 900,
                                            buttons: false
                                        });
                                        $('#nama').val('');
                                        $('#hp').val('');
                                        $('input[type="checkbox"]').prop('checked', false);
                                        $('input[type="radio"]').prop('checked', false);
                                        $('#targetProv').text('');
                                        $('#quoteGroup').fadeIn(100);
                                        $('#alasanGroup').fadeIn(100);
                                        $('select[id="kategori"]:checked').val('3');
                                        $('select[name="cariKota"]').val('');
                                        $('#brand').html('');
                                        $('#marketing').html('');

                                        getBrand();
                                        getMarketing();
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

    function addZero(data) {
        if (data < 10) {
            var newDate = '0' + data;
        } else if (data >= 10) {
            var newDate = data;
        }

        return newDate;
    }
</script>