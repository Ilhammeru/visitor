<?php foreach ($hasil as $h) { ?>
    <div class="table-responsive mb-3" hidden>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <label for="">Perusahaan</label>
                <?php if (isset($perusahaan['p' . $h->pt])) { ?>
                    <select id="perusahaan" onchange="brand()" class="form-control">
                        <optgroup label="Pilihan Sebelumnya">
                            <option value="<?= $h->pt; ?>"><?= $perusahaan['p' . $h->pt]; ?></option>
                        </optgroup>
                        <optgroup label="Data">
                            <?php foreach ($pt as $a) { ?>
                                <option value="<?= $a->id; ?>"><?= $a->name; ?></option>
                            <?php } ?>
                        </optgroup>
                    </select>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="table-responsive mb-3">
        <div class="row mb-2">
            <div class="col-md-12 col-sm-12">
                <label for="">Tanggal</label>
                <input type="text" class="form-control editTanggalForm" value="<?= $h->tanggal_input; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="">Marketing</label>
                    <select id="marketing" class="form-control marketing">
                        <optgroup label="Pillihan Sebelumnya">
                            <?php if (isset($marketing['m' . $h->marketing])) { ?>
                                <option value="<?= $h->marketing; ?>"><?= $marketing['m' . $h->marketing]; ?></option>
                            <?php } ?>
                        </optgroup>
                        <optgroup label="Data">
                            <?php foreach ($daftarMar as $dm) { ?>
                                <option value="<?= $dm->id; ?>"><?= $dm->name; ?></option>
                            <?php } ?>
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="">Brand</label>
                    <select id="brand" class="form-control brand">
                        <optgroup label="Pillihan Sebelumnya">
                            <?php if (isset($brand['b' . $h->brand])) { ?>
                                <option value="<?= $h->brand; ?>"><?= $brand['b' . $h->brand]; ?></option>
                            <?php } ?>
                        </optgroup>
                        <optgroup label="Data">
                            <?php foreach ($daftarBrand as $db) { ?>
                                <option value="<?= $db->id_franchise; ?>"><?= $db->nama_franchise; ?></option>
                            <?php } ?>
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
                    <input type="text" class="form-control namaEdit" id="nama" value="<?= $h->nama; ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive mb-3">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="">No Telfon Customer</label>
                    <input type="text" class="form-control hpEdit" id="hp" value="<?= $h->hp; ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive mb-3">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="">Kategori</label>
                    <select name="" class="form-control" id="kategoriSelectEdit" onchange="ubahAlRat()">
                        <optgroup label="Pilihan Sebelumnya">
                            <?php
                            if ($h->kategori == 3) {
                                $kategori = 'Respon';
                            } elseif ($h->kategori == 2) {
                                $kategori = 'No respon';
                            } else {
                                $kategori = 'Anak - anak';
                            }
                            ?>
                            <option value="" id="kategoriOptionEdit"><?= $kategori; ?></option>
                        </optgroup>
                        <optgroup label="Data">
                            <option value="3">Respon</option>
                            <option value="2">No Respon</option>
                            <option value="1">Anak - anak</option>
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
                    <?php foreach ($alasanList as $alList) { ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radioEditAlasan" value="<?= $alList->id; ?>" id="alasanEdit<?= $alList->id; ?>">
                            <label class="form-check-label" for="alasan">
                                <?= $alList->alasan; ?>
                            </label>
                        </div>
                    <?php } ?>
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
<?php } ?>

<script>
    $(document).ready(function() {
        $('.editTanggalForm').datepicker({
            autoclose: true,
            todayHiglight: true,
            format: 'yyyy-mm-dd'
        });
    })

    function ubahAlRat() {
        var kategori = $('select[id="kategoriSelectEdit"]').val();
        if (kategori < 3) {
            $('#alasanGroupEdit').prop('hidden', true);
            $('#ratingGroupEdit').prop('hidden', true);
            $('input[name="radioEditAlasan"]').val('0');
            $('input[name="ratingEdit"]').val('0');
        } else {
            $('#alasanGroupEdit').removeAttr('hidden');
            $('#ratingGroupEdit').removeAttr('hidden');
        }
    }
</script>