<?php if ($baris > 0) { ?>
    <?php if ($id > 0) { ?>
        <div class="text-center mb-4">
            <span class="fw-bold fst-italic"><?= tanggal($bulan) . ' - ' . tanggal($hariIni); ?></span>
        </div>
    <?php } ?>
    <div class="card shadow mb-4">
        <div class="card-header text-center">
            <h5 class="card-title">Detail</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?php foreach ($limit as $row) { ?>
                    <div class="row">
                        <label for="" class="col-form-label col-sm-4">Nama :</label>
                        <div class="col-sm-8">
                            <input type="text" readonly class="form-control form-control-sm readonly bg-white border-0 fw-bold" value="<?= $row->nama; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <label for="" class="col-form-label col-sm-4">No handphone :</label>
                        <div class="col-sm-8">
                            <input type="text" readonly class="form-control form-control-sm readonly bg-white border-0 fw-bold" value="<?= $row->hp; ?>">
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>


    <?php foreach ($hasil as $h) : ?>
        <?php
        $alasanid = $h->alasan;
        $brandId = $h->brand;
        $perusahaanId = $h->pt;
        $id = $h->id_visit;
        $marketingId = $h->marketing;
        $tanggal_join = $h->tanggal_join;
        ?>
        <button class="btn btn-light w-100 mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample<?= $h->id_visit; ?>" aria-expanded="false" aria-controls="collapseExample">
            <?php if (isset($perusahaan['p' . $perusahaanId])) { ?>
                <?= $perusahaan['p' . $perusahaanId]; ?>
                <?= ($h->tanggal_join != null) ? '<span class="text-success"><i class="fas fa-check"></i></span>' : ''; ?>
            <?php } ?>
        </button>

        <div class="collapse mb-2" id="collapseExample<?= $h->id_visit; ?>">
            <div class="card card-body">
                <div class="table-responsive">
                    <div class="row">
                        <?php if ($tanggal_join == null) { ?>
                            <label for="" class="col-form-label col-xs-4 col-sm-4 col-md-2 col-lg-2">Tanggal Input</label>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <input type="text" readonly class="form-control border-0 readonly bg-white" value=":">
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-8 col-lg-8">
                                <input type="text" readonly class="form-control border-0 readonly bg-white fw-bold text-start" value="<?= tanggal($h->tanggal_input); ?>">
                            </div>
                        <?php } else { ?>
                            <label for="" class="col-form-label col-xs-4 col-sm-4 col-md-2 col-lg-2">Tanggal Join</label>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <input type="text" readonly class="form-control border-0 readonly bg-white" value=":">
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-8 col-lg-8">
                                <input type="text" readonly class="form-control border-0 readonly bg-white fw-bold text-start" value="<?= tanggal(date('Y-m-d', strtotime($h->tanggal_join))); ?>">
                            </div>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <label for="" class="col-form-label col-xs-4 col-sm-4 col-md-2 col-lg-2">Brand</label>
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <input type="text" readonly class="form-control border-0 readonly bg-white" value=":">
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-8 col-lg-8">
                            <?php if (isset($brand['i' . $perusahaanId]['b' . $brandId])) { ?>
                                <u><input type="text" readonly class="form-control border-0 readonly bg-white fw-bold fst-italic text-start" value="<?= $brand['i' . $perusahaanId]['b' . $brandId]; ?>"></u>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <label for="" class="col-form-label col-xs-4 col-sm-4 col-md-2 col-lg-2">Marketing :</label>
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <input type="text" readonly class="form-control border-0 readonly bg-white" value=":">
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-8 col-lg-8">
                            <?php if (isset($marketing['m' . $marketingId])) { ?>
                                <input type="text" readonly class="form-control border-0 readonly bg-white fw-bold" value="<?= $marketing['m' . $marketingId]; ?>">
                            <?php } ?>
                        </div>
                    </div>
                    <?php if ($tanggal_join == null) { ?>
                        <div class="row">
                            <label for="" class="col-form-label col-xs-4 col-sm-4 col-md-2 col-lg-2">Alasan :</label>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                <input type="text" readonly class="form-control border-0 readonly bg-white" value=":">
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-8 col-lg-8">
                                <?php if ($alasanid == 0) { ?>
                                    <input type="text" readonly class="form-control border-0 readonly bg-white" value="No Respon">
                                <?php } else { ?>
                                    <?php if (isset($alasan['id' . $alasanid])) { ?>
                                        <input type="text" readonly class="form-control border-0 readonly bg-white" value="<?= $alasan['id' . $alasanid]; ?>">
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>


<?php } else { ?>
    <div class="card shadow">
        <div class="card-body text-center">
            <span class="fw-bold">Tidak ada data</span>
        </div>
    </div>
<?php } ?>