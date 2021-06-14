<!-- <div class="card shadow">
    <div class="card-header text-center">
        <h5 class="card-title">Visitor</h5>
    </div>
    <div class="card-body">
        <div class="row mb-5">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div id="kolomTanggal" class="text-center">
                    <?php if ($tanggalAw != 0) { ?>
                        <span class="fw-bold fst-italic"><?= tanggal($tanggalAw) . ' - ' . tanggal($tanggalAk); ?></span>
                    <?php } else { ?>
                        <span class="fw-bold fst-italic" style="font-size: 0.9em;"><?= hari(date('Y-m-D')) . ', ' . tanggal(date('Y-m-d')); ?></span>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="targetBrand"></div>
        <div id="targetVisit">
            <?php if ($_SESSION['role'] < 3) { ?>
                <div class="row">
                    <div class="col-md-7 col-sm-12 col-xs-12"></div>
                    <div class="col-md-5 col-sm-12 col-xs-12">
                        <div class="text-end">
                            <form class="d-flex">
                                <input class="form-control form-control-sm" id="cari" type="search" placeholder="Search" aria-label="Search" oninput="triggerPencarian()">
                                <button class="btn rounded-circle text-primary" type="submit" id="sorting"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="table-responsive">
                <table class="table" style="font-size: 0.8em;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>No. Telfon</th>
                            <th>Brand</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="targetSorting"></tbody>
                    <tbody class="tableBody">
                        <?php if ($jBrand == 0) { ?>
                            <tr class="text-center">
                                <td colspan="6">Tidak ada data ditemukan</td>
                            </tr>
                        <?php } ?>
                        <?php $no = 1;
                        foreach ($hasil as $a) :  ?>
                            <tr>
                                <td><?= ++$halaman; ?></td>
                                <td><?= tanggal(date('Y-m-d', strtotime($a->tanggal_input))); ?></td>
                                <td id="tableNama"><?= $a->nama; ?> <?= ($a->kategori == 2) ? ' <span style="font-size: 0.8em;" class="fst-italic">(No respon)</span>' : ''; ?></td>
                                <td><?= $a->hp; ?></td>
                                <?php if (isset($brand['b' . $a->brand])) { ?>
                                    <?php if ($a->tanggal_join == null) { ?>
                                        <td><?= $brand['b' . $a->brand] . ' (<span class="text-danger"><i class="fas fa-times"></i></span>)'; ?></td>
                                    <?php } else { ?>
                                        <td><?= $brand['b' . $a->brand] . ' (<span class="text-success"><i class="fas fa-check"></i></span>)'; ?></td>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($a->tanggal_join == null) { ?>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <?php if ($a->is_close == null) { ?>
                                                <a onclick="edit(<?= $a->id_visit; ?>)" class="btn btn-sm"><i class="fas fa-edit"></i></a>
                                                <a class="btn text-danger btn-sm" onclick="hapusVisitor(<?= $a->id_visit; ?>)"><i class="fas fa-trash-alt"></i></a>
                                            <?php } else { ?>
                                                <span style="font-size: 0.8em;" class="fst-italic">Sudah closing</span>
                                            <?php } ?>
                                        </div>
                                    </td>
                                <?php } else { ?>
                                    <td>
                                        <span style="font-size: 0.8em;" class="fst-italic">Sudah join</span>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="tfoot tfootDetail">
                        <tr>
                            <td colspan="6"><?= $jBrand; ?> data ditemukan</td>
                        </tr>
                    </tfoot>
                </table>
                <?php if ($per_page > 1) { ?>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination paginationDetail">
                            <?php for ($i = 1; $i <= $per_page; $i++) { ?>
                                <?php $aktif = ($cek == $i) ? 'active' : ''; ?>
                                <?php if ($i == 5) {
                                    $key = $i - 2;
                                    echo $key;
                                }
                                ?>
                                <li class="page-item <?= $aktif; ?>"><a class="page-link" data-page="<?= $i; ?>" href="#"><?= $i; ?></a></li> <br>
                            <?php } ?>

                        </ul>
                    </nav>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php if ($_SESSION['role'] < 3) { ?>
    <?php if ($per_page > 0) { ?>
        <?php if ($closing > 0) { ?>
            <div class="closing text-end mt-3 mb-3">
                <button class="btn btn-sm" style="border-radius: 10px; background-color: #71C1D8" id="closing">Closing </button>
            </div>
        <?php } ?>
    <?php } ?>
<?php } ?>

<!-- modal -->
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
        $('#cari').autocomplete({
            source: '<?= base_url('visitor/auto'); ?>'
        })
    })

    $('#sorting').click(function(e) {
        e.preventDefault();
        var data = $('#cari').val();
        $.ajax({
            type: 'POST',
            data: {
                data: data
            },
            url: '<?= base_url('visitor/sortingData'); ?>',
            dataType: 'text',
            success: function(hasil) {
                $('.tableBody').prop('hidden', true);
                $('.targetSorting').html(hasil);
                $('.targetSorting').removeAttr('hidden');
                $('.tfootDetail').prop('hidden', true);
                $('.paginationDetail').prop('hidden', true);
            }
        })

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

    function btnClosing(tanggal) {
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
                            url: '<?= base_url('visitor/prosesClosing'); ?>',
                            success: function(hasil) {
                                swal('Berhasil', 'Closing berhasil dilakukan', 'success', {
                                    buttons: false,
                                    timer: 900
                                })
                                $('.modalClosing').modal('hide');
                                ambilVisit(0);
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

    function triggerPencarian() {
        var data = $('#cari').val();
        if (data == '') {
            $('.tableBody').removeAttr('hidden');
            $('.targetSorting').html('');
            $('.targetSorting').prop('hidden', true);
            $('.tfoot').removeAttr('hidden');
            $('#closing').removeAttr('hidden');
            $('.paginationDetail').removeAttr('hidden');
            $('.tfootDetail').removeAttr('hidden');
        } else {
            $.ajax({
                type: 'POST',
                data: {
                    data: data
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
                    $('.tableBody').prop('hidden', true);
                    $('.targetSorting').html(hasil);
                    $('.targetSorting').removeAttr('hidden');
                    $('.tfoot').prop('hidden', true);
                    $('#closing').prop('hidden', true);
                }
            })
        }
    }
</script> -->