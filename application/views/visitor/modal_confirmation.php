<div class="row mb-3">
    <label for="" class="col-form-label col-sm-4 col-form-label-sm">Tanggal</label>
    <div class="col-sm-8">
        <div class="input-group mb-3">
            <input type="text" class="form-control form-control-sm" id="tanggalShow" value="<?= $tanggalShow; ?>">
            <input type="text" class="form-control form-control-sm" id="tanggalVisitConfirmation" style="display: none;" value="<?= $tanggalInput; ?>">
            <input type="text" class="form-control form-control-sm" id="idVisitConfirmation" style="display: none;" value="<?= $idVisit; ?>">
            <span class="input-group-text" onclick="edit_tanggal()"><i class="fas fa-pen"></i></span>
        </div>
    </div>
</div>
<div class="row mb-3">
    <label for="" class="col-form-label col-sm-4 col-form-label-sm">Marketing</label>
    <div class="col-sm-8">
        <select id="marketing-edit" class="form-control form-control-sm" readonly>
            <optgroup label="Pilihan sebelumnya">
                <option value="<?= $marketingId; ?>"><?= $marketingName; ?></option>
            </optgroup>
            <optgroup label="Daftar marketing">
                <?php foreach ($marketingList as $mm) { ?>

                    <option value="<?= $mm->id; ?>"><?= $mm->name; ?></option>

                <?php } ?>
            </optgroup>
        </select>
    </div>
</div>
<div class="row mb-3">
    <label for="" class="col-form-label col-sm-4 col-form-label-sm">Brand</label>
    <div class="col-sm-8">
        <select id="brand-edit" class="form-control form-control-sm" readonly>
            <optgroup label="Pilihan sebelumnya">
                <option value="<?= $brandId; ?>"><?= $brandName; ?></option>
            </optgroup>
            <optgroup label="Daftar brand">
                <?php foreach ($brandList as $bl) { ?>

                    <option value="<?= $bl->id_franchise; ?>"><?= $bl->nama_franchise; ?></option>

                <?php } ?>
            </optgroup>
        </select>
    </div>
</div>
<div class="row mb-3">
    <label for="" class="col-form-label col-sm-4 col-form-label-sm">Nomor Telfon</label>
    <div class="col-sm-8">
        <input type="text" class="form-control form-control-sm" id="hp" value="<?= $hp; ?>" onchange="ubahJKdanUmur()">
    </div>
</div>
<div class="row mb-3">
    <label for="" class="col-form-label col-sm-4 col-form-label-sm">Nama Visitor</label>
    <div class="col-sm-8">
        <input type="text" class="form-control form-control-sm" id="nama" value="<?= $nama; ?>">
    </div>
</div>
<div class="row mb-3">
    <label for="" class="col-form-label col-sm-4 col-form-label-sm">Sumber Visitor</label>
    <div class="col-sm-8">
        <select name="sumber" id="sumber-id" class="form-control form-control-sm">
            <optgroup label="Pilihan sebelumnya">
                <option value="<?= $sumberId; ?>"><?= $sumberName; ?></option>
            </optgroup>
            <optgroup label="Daftar sumber">
                <option value="">-- Pilih --</option>
                <option value="1">Instagram Ads</option>
                <option value="2">Facebook Ads</option>
                <option value="3">Ayo Waralaba</option>
                <option value="4">Waralabaku</option>
                <option value="5">Dunia Franchise</option>
                <option value="6">Website</option>
                <option value="7">Direct</option>
            </optgroup>
        </select>
    </div>
</div>
<div class="row mb-3">
    <label for="" class="col-form-label col-sm-4 col-form-label-sm">Jenis Kelamin</label>
    <div class="col-sm-8">
        <div class="form-check">
            <input class="form-check-input" <?= ($jkel == 'l') ? 'checked' : ''; ?> type="radio" name="jenisKelamin" id="laki-edit" value="l">
            <label class="form-check-label" for="laki">
                Laki - laki
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" <?= ($jkel == 'p') ? 'checked' : ''; ?> type="radio" name="jenisKelamin" id="perempuan-edit" value="p">
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
            <input class="form-check-input" <?= ($umur == '1') ? 'checked' : ''; ?> type="radio" name="umur" id="30" value="1">
            <label class="form-check-label" for="30">
                < 20 tahun</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" <?= ($umur == '2') ? 'checked' : ''; ?> type="radio" name="umur" id="31" value="2">
            <label class="form-check-label" for="31">20 - 30 tahun</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" <?= ($umur == '3') ? 'checked' : ''; ?> type="radio" name="umur" id="32" value="3">
            <label class="form-check-label" for="32">30 - 40 tahun</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" <?= ($umur == '4') ? 'checked' : ''; ?> type="radio" name="umur" id="atas" value="4">
            <label class="form-check-label" for="atas">> 40 tahun</label>
        </div>
    </div>
</div>
<div class="row mb-3">
    <label for="" class="col-form-label col-form-label-sm col-sm-4">Kategori</label>
    <div class="col-sm-8">
        <select name="" class="form-control form-control-sm" id="kategori-edit" onchange="ubahProspek()">
            <optgroup label="Piliham sebelumnya">
                <option value="<?= $kategoriId; ?>"><?= $kategoriName; ?></option>
            </optgroup>
            <optgroup label="Daftar kategori">
                <option value="3">Respon</option>
                <option value="2">No Respon</option>
                <option value="1">Anak - anak</option>
            </optgroup>
        </select>
    </div>
</div>
<div class="row mb-3" id="quoteGroup">
    <label for="" class="col-form-label col-form-label-sm col-sm-4">Prospek</label>
    <div class="col-sm-8">
        <div class="table-responsive">
            <div class="form-check form-check-inline">
                <input class="form-check-input ratingcek" <?= ($prospek == '1') ? 'checked' : ''; ?> name="rating-edit" type="radio" id="inlineCheckbox1" value="1">
                <label class="form-check-label" for="inlineCheckbox1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="30" fill="gold" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                    </svg>
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="rating-edit" <?= ($prospek == '2') ? 'checked' : ''; ?> type="radio" id="inlineCheckbox2" value="2">
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
                <input class="form-check-input" name="rating-edit" <?= ($prospek == '3') ? 'checked' : ''; ?> type="radio" id="inlineCheckbox3" value="3">
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
    <label for="" class="col-form-label col-sm-4 col-form-label-sm">Alasan</label>
    <div class="col-sm-8">
        <?php foreach ($alasanList as $a) { ?>
            <?php if ($_SESSION['pt'] == 41) { ?>
                 <div class="form-check">
                    <input class="form-check-input" <?= ($alasanId == $a['id']) ? 'checked' : ''; ?> type="radio" name="radioAlasan-edit" value="<?= $a['id']; ?>" id="alasan<?= $a['id']; ?>">
                    <label class="form-check-label" for="alasan<?= $a['id']; ?>">
                        <?= $a['alasan']; ?>
                    </label>
                </div>
            <?php } else { ?>
                <div class="form-check">
                    <input class="form-check-input" <?= ($alasanId == $a->id) ? 'checked' : ''; ?> type="radio" name="radioAlasan-edit" value="<?= $a->id; ?>" id="alasan<?= $a->id; ?>">
                    <label class="form-check-label" for="alasan<?= $a->id; ?>">
                        <?= $a->alasan; ?>
                    </label>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</div>
<div class="row">
    <button class="btn btn-primary btn-confirmation" onclick="edit_confirmation()">Edit</button>
</div>


<script>
    function edit_tanggal() {
        $('#tanggalShow').hide();
        $('#tanggalVisitConfirmation').show();

        $('#tanggalVisitConfirmation').datepicker({
            format: 'yyyy-mm-dd',
            todayBtn: true,
            todayHighlight: true,
            autoclose: true
        })
    }

    function ubahProspek() {
        var kategori = $('#kategori-edit').val();
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

    function edit_confirmation() {
        var today = new Date();
        var y = today.getFullYear();
        var m = addZero((today.getMonth() + 1));
        var d = addZero(today.getDate());
        var newYear = y + '-' + m + '-' + d;
        var time = new Date(newYear).getTime();
        var selectedTime = new Date($('#tanggalVisitConfirmation').val()).getTime();

        var tanggal = $('#tanggalVisitConfirmation').val();
        var nama = $('#nama').val();
        var hp = $('#hp').val();
        var sumber = $('#sumber-edit').val();
        var marketing = $('#marketing-edit').val();
        var brand = $('#brand-edit').val();
        var kategori = $('#kategori-edit').val();
        var umur = $('input[name="umur"]:checked').val();
        var alasan = $('input[name="radioAlasan-edit"]:checked').val();
        var prospek = $('input[name="rating-edit"]:checked').val();
        var idVisit = $('#idVisitConfirmation').val();

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

            }
            
            $.ajax({
                type: 'post',
                data: {
                    nama: nama,
                    hp: hp,
                    sumber: sumber,
                    marketing: marketing,
                    brand: brand,
                    kategori: kategori,
                    umur: umur,
                    alasan: alasan,
                    prospek: prospek,
                    tanggal: tanggal,
                    idVisit: idVisit
                },
                url: '<?= base_url('Visitor/postEdit'); ?>',
                dataType: 'text',
                success: function(hasil) {
                    console.log(hasil);
                    if (hasil == 'success') {
                        //close modal 
                        $('.modal-data-confirmation').modal('hide');

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

        } else if (kategori < 3) {

            $.ajax({
                type: 'post',
                data: {
                    nama: nama,
                    hp: hp,
                    sumber: sumber,
                    marketing: marketing,
                    brand: brand,
                    kategori: kategori,
                    umur: umur,
                    alasan: alasan,
                    prospek: prospek,
                    tanggal: tanggal,
                    idVisit: idVisit
                },
                url: '<?= base_url('Visitor/postEdit'); ?>',
                dataType: 'text',
                success: function(hasil) {
                    console.log(hasil);
                    if (hasil == 'success') {
                        //close modal 
                        $('.modal-data-confirmation').modal('hide');

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

        } else {

            $.ajax({
                type: 'post',
                data: {
                    nama: nama,
                    hp: hp,
                    sumber: sumber,
                    marketing: marketing,
                    brand: brand,
                    kategori: kategori,
                    umur: umur,
                    alasan: alasan,
                    prospek: prospek,
                    tanggal: tanggal,
                    idVisit: idVisit
                },
                url: '<?= base_url('Visitor/postEdit'); ?>',
                dataType: 'text',
                success: function(hasil) {
                    console.log(hasil);
                    if (hasil == 'success') {
                        //close modal 
                        $('.modal-data-confirmation').modal('hide');

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

        }

    }
</script>