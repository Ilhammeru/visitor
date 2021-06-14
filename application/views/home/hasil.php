<?php if ($baris > 0) {  ?>
    <?php if ($id > 0) { ?>
        <div class="text-center mb-4">
            <span class="fw-bold fst-italic"><?= tanggal($bulan) . ' - ' . tanggal($hariIni); ?></span>
        </div>
    <?php } ?>
    <div class="table-responsive">
        <span style="font-size: 0.7em;" class="fst-italic"><?= $baris; ?> data ditemukan</span>
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>No Telf</th>
                    <th>Tanggal</th>
                    <th>Brand</th>
                    <th>Alasan</th>
                    <th>Prospek</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody style="font-size: 0.9em;">
                <?php

                foreach ($hasil as $h) {
                    //ambil Alasan
                    $alasanid       = json_decode($h->alasan);
                    $brandId        = $h->brand;
                    $perusahaanId   = $h->pt;
                    $id             = $h->id_visit;
                    $marketingId    = $h->marketing;
                    $tanggal_join   = $h->tanggal_join;
                ?>

                    <?php if ($baris == 0) { ?>
                        <tr class="text-center">
                            <td colspan="5">Tidak ada data</td>
                        </tr>
                    <?php } else { ?>
                        <tr id="tr<?= $h->id_visit; ?>">
                            <td><?= $h->nama; ?></td>
                            <td><?= $h->hp; ?></td>
                            <td><?= ($h->tanggal_join == null) ? tanggal($h->tanggal_input) : tanggal($h->tanggal_join); ?> </td>
                            <?php if (isset($brand['b' . $h->brand])) { ?>
                                <td><?= ($h->tanggal_join == null) ? $brand['b' . $h->brand] . ' (<span class="text-danger"><i class="fas fa-times"></i></span>)' : $brand['b' . $h->brand] . ' (<span class="text-success"><i class="fas fa-check"></i></span>)'; ?></td>
                            <?php } ?>
                            <?php if ($h->alasan > 0) { ?>
                                <?php if (isset($alasan['id' . $h->alasan])) { ?>
                                    <td><?= $alasan['id' . $h->alasan]; ?></td>
                                <?php } ?>
                            <?php } else { ?>
                                <td>No respon</td>
                            <?php } ?>
                            <?php if ($h->prospek > 0) { ?>
                                <td class="text-start targetRatingSl">
                                    <?php for ($p = 0; $p < $h->prospek; $p++) { ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="30" fill="gold" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>
                                    <?php } ?>
                                </td>
                            <?php } else { ?>
                                <td class="fw-bolder text-center">-</td>
                            <?php }  ?>
                            <td><button type="button" class="btn btn-sm text-primary" onclick="editDd(<?= $h->id_visit; ?>)" data-edit="<?= $h->id_visit; ?>"><i class="fas fa-pen"></i></button></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } else { ?>
    <div class="card shadow">
        <div class="card-body text-center">
            <span class="fw-bold">Tidak ada data</span>
        </div>
    </div>
<?php } ?>

<!-- modal -->
<div class="modal modalDashboard fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Prospek</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="table-responsive">
                    <p>Prospek</p>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="rating" type="radio" id="inlineCheckbox1" value="1">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="simpann">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- modal -->

<script>
    function editDd(id) {
        $('.modalDashboard').modal('show');

        $.ajax({
            type: 'POST',
            data: {
                id: id
            },
            url: '<?= base_url('dashboard/editData'); ?>',
            dataType: 'text',
            success: function(hasil) {
                $('input[value="' + hasil + '"]').prop('checked', true);
            }
        })
        $('#simpann').attr('onclick', 'simpanD(' + id + ')');
    }

    function simpanD(id) {
        var hasil = $('input[name="rating"]:checked').val();
        swal("Anda yakin ingin mengedit data ini?", {
            buttons: {
                catch: {
                    text: 'Yakin',
                    value: 'yakin',
                },
                cancel: 'Belum',
            },
        }).then((value) => {
            switch (value) {

                case "yakin":
                    $.ajax({
                        type: 'POST',
                        data: 'rating=' + hasil + '&id=' + id,
                        url: '<?= base_url('dashboard/prosesEdit'); ?>',
                        dataType: 'text',
                        success: function(data) {
                            swal('Berhasil', 'Data berhasil diinput ke database', {
                                timer: 400
                            });
                            $('.modal').modal('hide');
                            $('#tr' + id).fadeOut(100);
                        }
                    })
                    break;

                default:
                    swal("Silahkan cek kembali");
            }
        })
    }
</script>