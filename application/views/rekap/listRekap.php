    <?php if ($kategori == 4 || $kategori == 3) { ?>
        <div class="row mt-5">
            <div class="col-md-12 col-sm-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title text-center">Respon</h5>
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <td></td>
                                    <?php foreach ($brand as $row) { ?>
                                        <td class="fw-bold text-center"><?= $row->slug_franchise; ?></td>
                                    <?php } ?>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Rundingan</td>
                                        <?php foreach ($brand as $row) {
                                            $idPt = $_SESSION['pt'];
                                            if ($prospek == 4) {
                                                $hasilA = $this->db->query("SELECT id_visit FROM visit WHERE brand = $row->id_franchise AND tanggal_input >= '$tanggalAwal' AND tanggal_input <= '$tanggalAkhir' AND kategori = 3 AND pt = $idPt AND alasan = 1 AND tanggal_join IS null")->num_rows();
                                                $prospekTrigger = '';
                                            } elseif ($prospek < 4) {
                                                $hasilA = $this->db->query("SELECT id_visit FROM visit WHERE brand = $row->id_franchise AND tanggal_input >= '$tanggalAwal' AND tanggal_input <= '$tanggalAkhir' AND kategori = 3 AND prospek = $prospek AND pt = $idPt AND alasan = 1 AND tanggal_join IS null")->num_rows();
                                                $prospekTrigger = $prospek;
                                            }
                                        ?>
                                            <td <?= ($hasilA == 0) ? 'style="color: #d5d5d6;"' : ''; ?> onclick="detailVisitor('<?= $tanggal; ?>', <?= $row->id_franchise; ?>, 1, 3, <?= $prospekTrigger; ?>)"><?= ($hasilA == 0) ? '-' : $hasilA; ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <td>Modal</td>
                                        <?php foreach ($brand as $row) {
                                            $idPt = $_SESSION['pt'];
                                            if ($prospek == 4) {
                                                $hasilB = $this->db->query("SELECT id_visit FROM visit WHERE brand = $row->id_franchise AND tanggal_input >= '$tanggalAwal' AND tanggal_input <= '$tanggalAkhir' AND kategori = 3 AND tanggal_join IS null AND pt = $idPt AND alasan = 2")->num_rows();
                                                $prospekTrigger = '';
                                            } elseif ($prospek < 4) {
                                                $hasilB = $this->db->query("SELECT id_visit FROM visit WHERE brand = $row->id_franchise AND tanggal_input >= '$tanggalAwal' AND tanggal_input <= '$tanggalAkhir' AND kategori = 3 AND tanggal_join IS null AND prospek = $prospek AND pt = $idPt AND alasan = 2")->num_rows();
                                                $prospekTrigger = $prospek;
                                            }
                                        ?>
                                            <td <?= ($hasilB == 0) ? 'style="color: #d5d5d6;"' : ''; ?> onclick="detailVisitor('<?= $tanggal; ?>', <?= $row->id_franchise; ?>, 2, 3, <?= $prospekTrigger; ?>)"><?= ($hasilB == 0) ? '-' : $hasilB; ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <td>Lokasi</td>
                                        <?php foreach ($brand as $row) {
                                            $idPt = $_SESSION['pt'];
                                            if ($prospek == 4) {
                                                $hasilC = $this->db->query("SELECT id_visit FROM visit WHERE brand = $row->id_franchise AND tanggal_input >= '$tanggalAwal' AND tanggal_input <= '$tanggalAkhir' AND kategori = 3 AND tanggal_join IS null AND pt = $idPt AND alasan = 3")->num_rows();
                                                $prospekTrigger = '';
                                            } elseif ($prospek < 4) {
                                                $hasilC = $this->db->query("SELECT id_visit FROM visit WHERE brand = $row->id_franchise AND tanggal_input >= '$tanggalAwal' AND tanggal_input <= '$tanggalAkhir' AND kategori = 3 AND tanggal_join IS null AND prospek = $prospek AND pt = $idPt AND alasan = 3")->num_rows();
                                                $prospekTrigger = $prospek;
                                            }
                                        ?>
                                            <td <?= ($hasilC == 0) ? 'style="color: #d5d5d6;"' : ''; ?> onclick="detailVisitor('<?= $tanggal; ?>', <?= $row->id_franchise; ?>, 3, 3, <?= $prospekTrigger; ?>)"><?= ($hasilC == 0) ? '-' : $hasilC; ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <td>Ongkir</td>
                                        <?php foreach ($brand as $row) {
                                            $idPt = $_SESSION['pt'];
                                            if ($prospek == 4) {
                                                $hasilD = $this->db->query("SELECT id_visit FROM visit WHERE brand = $row->id_franchise AND tanggal_input >= '$tanggalAwal' AND tanggal_input <= '$tanggalAkhir' AND kategori = 3 AND tanggal_join IS null AND pt = $idPt AND alasan = 4")->num_rows();
                                                $prospekTrigger = '';
                                            } elseif ($prospek < 4) {
                                                $hasilD = $this->db->query("SELECT id_visit FROM visit WHERE brand = $row->id_franchise AND tanggal_input >= '$tanggalAwal' AND tanggal_input <= '$tanggalAkhir' AND kategori = 3 AND tanggal_join IS null AND prospek = $prospek AND pt = $idPt AND alasan = 4")->num_rows();
                                                $prospekTrigger = $prospek;
                                            }
                                        ?>
                                            <td <?= ($hasilD == 0) ? 'style="color: #d5d5d6;"' : ''; ?> onclick="detailVisitor('<?= $tanggal; ?>', <?= $row->id_franchise; ?>, 4, 3, <?= $prospekTrigger; ?>)"><?= ($hasilD == 0) ? '-' : $hasilD; ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <td>Tester</td>
                                        <?php foreach ($brand as $row) {
                                            $idPt = $_SESSION['pt'];
                                            if ($prospek == 4) {
                                                $hasilE = $this->db->query("SELECT id_visit FROM visit WHERE brand = $row->id_franchise AND tanggal_input >= '$tanggalAwal' AND tanggal_input <= '$tanggalAkhir' AND kategori = 3 AND tanggal_join IS null AND pt = $idPt AND alasan = 5")->num_rows();
                                                $prospekTrigger = '';
                                            } elseif ($prospek < 4) {
                                                $hasilE = $this->db->query("SELECT id_visit FROM visit WHERE brand = $row->id_franchise AND tanggal_input >= '$tanggalAwal' AND tanggal_input <= '$tanggalAkhir' AND kategori = 3 AND tanggal_join IS null AND prospek = $prospek AND pt = $idPt AND alasan = 5")->num_rows();
                                                $prospekTrigger = $prospek;
                                            }
                                        ?>
                                            <td <?= ($hasilE == 0) ? 'style="color: #d5d5d6;"' : ''; ?> onclick="detailVisitor('<?= $tanggal; ?>', <?= $row->id_franchise; ?>, 5, 3, <?= $prospekTrigger; ?>)"><?= ($hasilE == 0) ? '-' : $hasilE; ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <td>Comparing</td>
                                        <?php foreach ($brand as $row) {
                                            $idPt = $_SESSION['pt'];
                                            if ($prospek == 4) {
                                                $hasilF = $this->db->query("SELECT id_visit FROM visit WHERE brand = $row->id_franchise AND tanggal_input >= '$tanggalAwal' AND tanggal_input <= '$tanggalAkhir' AND kategori = 3 AND tanggal_join IS null AND pt = $idPt AND alasan = 6")->num_rows();
                                                $prospekTrigger = '';
                                            } elseif ($prospek < 4) {
                                                $hasilF = $this->db->query("SELECT id_visit FROM visit WHERE brand = $row->id_franchise AND tanggal_input >= '$tanggalAwal' AND tanggal_input <= '$tanggalAkhir' AND kategori = 3 AND tanggal_join IS null AND prospek = $prospek AND pt = $idPt AND alasan = 6")->num_rows();
                                                $prospekTrigger = $prospek;
                                            }
                                        ?>
                                            <td <?= ($hasilF == 0) ? 'style="color: #d5d5d6;"' : ''; ?> onclick="detailVisitor('<?= $tanggal; ?>', <?= $row->id_franchise; ?>, 6, 3, <?= $prospekTrigger; ?>)"><?= ($hasilF == 0) ? '-' : $hasilF; ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <td>Booth</td>
                                        <?php foreach ($brand as $row) {
                                            $idPt = $_SESSION['pt'];
                                            if ($prospek == 4) {
                                                $hasilG = $this->db->query("SELECT id_visit FROM visit WHERE brand = $row->id_franchise AND tanggal_input >= '$tanggalAwal' AND tanggal_input <= '$tanggalAkhir' AND kategori = 3 AND tanggal_join IS null AND pt = $idPt AND alasan = 7")->num_rows();
                                                $prospekTrigger = '';
                                            } elseif ($prospek < 4) {
                                                $hasilG = $this->db->query("SELECT id_visit FROM visit WHERE brand = $row->id_franchise AND tanggal_input >= '$tanggalAwal' AND tanggal_input <= '$tanggalAkhir' AND kategori = 3 AND tanggal_join IS null AND prospek = $prospek AND pt = $idPt AND alasan = 7")->num_rows();
                                                $prospekTrigger = $prospek;
                                            }
                                        ?>
                                            <td <?= ($hasilG == 0) ? 'style="color: #d5d5d6;"' : ''; ?> onclick="detailVisitor('<?= $tanggal; ?>', <?= $row->id_franchise; ?>, 7, 3, <?= $prospekTrigger; ?>)"><?= ($hasilG == 0) ? '-' : $hasilG; ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr style="border-top: 3px solid black;">
                                        <td class="fw-bold">TOTAL</td>
                                        <?php foreach ($brand as $row) {
                                            $idPt = $_SESSION['pt'];
                                            if ($prospek == 4) {
                                                $totalA = $this->db->query("SELECT id_visit FROM visit WHERE brand = $row->id_franchise AND tanggal_input >= '$tanggalAwal' AND tanggal_input <= '$tanggalAkhir' AND kategori = 3 AND tanggal_join IS null AND pt = $idPt")->num_rows();
                                            } elseif ($prospek < 4) {
                                                $totalA = $this->db->query("SELECT id_visit FROM visit WHERE brand = $row->id_franchise AND tanggal_input >= '$tanggalAwal' AND tanggal_input <= '$tanggalAkhir' AND kategori = 3 AND tanggal_join IS null AND prospek = $prospek AND pt = $idPt")->num_rows();
                                            }
                                        ?>
                                            <td class="fw-bold" <?= ($totalA == 0) ? 'style="color: #d5d5d6;"' : ''; ?> onclick="detailVisitor('<?= $tanggal; ?>', <?= $row->id_franchise; ?>,'' , 3, <?= $prospekTrigger; ?>)"><?= ($totalA == 0) ? '-' : $totalA; ?></td>
                                        <?php } ?>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($kategori > 3) { ?>
            <div class="row mt-3">
                <div class="col-md-6 col-sm-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title text-center">No Respon</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <td></td>
                                        <?php foreach ($brand as $row) { ?>
                                            <td><?= $row->slug_franchise; ?></td>
                                        <?php } ?>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="<?= count($brand); ?>"></td>
                                        </tr>
                                        <tr style="border-top: 3px solid black;">
                                            <td class="fw-bold">TOTAL</td>
                                            <?php foreach ($brand as $row) {
                                                $idPt = $_SESSION['pt'];
                                                $totalB = $this->db->query("SELECT id_visit FROM visit WHERE brand = $row->id_franchise AND tanggal_input = '$tanggal' AND kategori = 2 AND pt = $idPt")->num_rows();
                                            ?>
                                                <td class="fw-bold" <?= ($totalB == 0) ? 'style="color: #d5d5d6;"' : ''; ?> onclick="detailVisitor2('<?= $tanggal; ?>', <?= $row->id_franchise; ?>, 2)"><?= ($totalB == 0) ? '-' : $totalB; ?></td>
                                            <?php } ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title text-center">Anak - anak</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <td></td>
                                        <?php foreach ($brand as $row) { ?>
                                            <td><?= $row->slug_franchise; ?></td>
                                        <?php } ?>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="<?= count($brand); ?>"></td>
                                        </tr>
                                        <tr style="border-top: 3px solid black;">
                                            <td class="fw-bold">TOTAL</td>
                                            <?php foreach ($brand as $row) {
                                                $idPt = $_SESSION['pt'];
                                                $totalC = $this->db->query("SELECT id_visit FROM visit WHERE brand = $row->id_franchise AND tanggal_input = '$tanggal' AND kategori = 1 AND pt = $idPt")->num_rows();
                                            ?>
                                                <td class="fw-bold" <?= ($totalC == 0) ? 'style="color: #d5d5d6;"' : ''; ?> onclick="detailVisitor2('<?= $tanggal; ?>', <?= $row->id_franchise; ?>, 1)"><?= ($totalC == 0) ? '-' : $totalC; ?></td>
                                            <?php } ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } elseif ($kategori == 2) { ?>
        <div class="row mt-3">
            <div class="col-md-12 col-sm-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <td></td>
                                    <?php foreach ($brand as $row) { ?>
                                        <td><?= $row->slug_franchise; ?></td>
                                    <?php } ?>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="<?= count($brand); ?>"></td>
                                    </tr>
                                    <tr style="border-top: 3px solid black;">
                                        <td class="fw-bold">TOTAL</td>
                                        <?php foreach ($brand as $row) {
                                            $idPt = $_SESSION['pt'];
                                            $totalB = $this->db->query("SELECT id_visit FROM visit WHERE brand = $row->id_franchise AND tanggal_input = '$tanggal' AND kategori = 2 AND pt = $idPt")->num_rows();
                                        ?>
                                            <td class="fw-bold" <?= ($totalB == 0) ? 'style="color: #d5d5d6;"' : ''; ?> onclick="detailVisitor2('<?= $tanggal; ?>', <?= $row->id_franchise; ?>, 2)"><?= ($totalB == 0) ? '-' : $totalB; ?></td>
                                        <?php } ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php } elseif ($kategori == 1) { ?>
            <div class="col-md-12 col-sm-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <td></td>
                                    <?php foreach ($brand as $row) { ?>
                                        <td><?= $row->slug_franchise; ?></td>
                                    <?php } ?>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="<?= count($brand); ?>"></td>
                                    </tr>
                                    <tr style="border-top: 3px solid black;">
                                        <td class="fw-bold">TOTAL</td>
                                        <?php foreach ($brand as $row) {
                                            $idPt = $_SESSION['pt'];
                                            $totalC = $this->db->query("SELECT id_visit FROM visit WHERE brand = $row->id_franchise AND tanggal_input = '$tanggal' AND kategori = 1 AND pt = $idPt")->num_rows();
                                        ?>
                                            <td class="fw-bold" <?= ($totalC == 0) ? 'style="color: #d5d5d6;"' : ''; ?> onclick="detailVisitor2('<?= $tanggal; ?>', <?= $row->id_franchise; ?>, 1)"><?= ($totalC == 0) ? '-' : $totalC; ?></td>
                                        <?php } ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>