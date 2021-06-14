<div class="row">
    <div class="col-md-6 col-sm-6">
        <div class="row mb-3">
            <label for="colFormLabelSm2" class="col-sm-2 col-form-label col-form-label-sm">Perusahaan</label>
            <div class="col-sm-2">
                <input type="text" class="form-control form-control-sm bg-white border-0" readonly value=":">
            </div>
            <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm bg-white border-0 fw-bold" readonly id="colFormLabelSm2" value="<?= $_SESSION['perusahaan']; ?>">
            </div>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-borderless">
        <thead>
            <td></td>
            <?php foreach ($brandA as $b) { ?>
                <?php if (isset($brand['b' . $b])) { ?>
                    <td class="text-center"><?= $brand['b' . $b]; ?></td>
                <?php } ?>
            <?php } ?>
            <td class="fw-bold">Total</td>
        </thead>
        <tbody>
            <tr>
                <td>Respon</td>
                <?php foreach ($brandA as $b) { ?>
                    <?php
                    $idPt = $_SESSION['pt'];
                    $kate   = $this->db->query("SELECT kategori FROM visit WHERE brand = $b AND kategori = 3 AND pt = $idPt AND tanggal_input = '$tanggal' AND tanggal_join IS null AND is_close IS null")->num_rows();
                    $tot = $this->db->query("SELECT kategori FROM visit WHERE kategori = 3 AND pt = $idPt AND tanggal_input = '$tanggal' AND tanggal_join IS null AND is_close IS null")->num_rows()
                    ?>
                    <?php if ($kate > 0) { ?>
                        <td class="text-center" style="border: 1px #E0DDDD solid;"><?= $kate; ?></td>
                    <?php } else { ?>
                        <td class="text-center" style="border: 1px #E0DDDD solid;">-</td>
                    <?php } ?>
                <?php } ?>
                <td><?= $tot; ?></td>
            </tr>
            <tr>
                <td>No respon</td>
                <?php foreach ($brandA as $b) { ?>
                    <?php
                    $idPt = $_SESSION['pt'];
                    $kate1 = $this->db->query("SELECT kategori FROM visit WHERE brand = $b AND kategori = 2 AND pt = $idPt AND tanggal_input = '$tanggal' AND tanggal_join IS null AND is_close IS null")->num_rows();
                    $tot1 = $this->db->query("SELECT kategori FROM visit WHERE kategori = 2 AND pt = $idPt AND tanggal_input = '$tanggal' AND tanggal_join IS null AND is_close IS null")->num_rows();
                    ?>
                    <?php if ($kate1 > 0) { ?>
                        <td class="text-center" style="border: 1px #E0DDDD solid;"><?= $kate1; ?></td>
                    <?php } else { ?>
                        <td class="text-center" style="border: 1px #E0DDDD solid;">-</td>
                    <?php } ?>
                <?php } ?>
                <td><?= $tot1; ?></td>
            </tr>
            <tr>
                <td>Anak - anak</td>
                <?php foreach ($brandA as $b) { ?>
                    <?php
                    $idPt = $_SESSION['pt'];
                    $kate2 = $this->db->query("SELECT kategori FROM visit WHERE brand = $b AND kategori = 1 AND pt = $idPt AND tanggal_input = '$tanggal' AND tanggal_join IS null AND is_close IS null")->num_rows();
                    $tot2 = $this->db->query("SELECT kategori FROM visit WHERE kategori = 1 AND pt = $idPt AND tanggal_input = '$tanggal' AND tanggal_join IS null AND is_close IS null")->num_rows();
                    ?>
                    <?php if ($kate2 > 0) { ?>
                        <td class="text-center" style="border: 1px #E0DDDD solid;"><?= $kate2; ?></td>
                    <?php } else { ?>
                        <td class="text-center" style="border: 1px #E0DDDD solid;">-</td>
                    <?php } ?>
                <?php } ?>
                <td><?= $tot2; ?></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-primary btn-sm" onclick="simpan('<?= $tanggal; ?>')">Simpan</button>
</div>