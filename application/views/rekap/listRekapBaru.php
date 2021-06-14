<?php
if ($jumlah == 0) { ?>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 col-sm-12">
            <div class="alert alert-danger" role="alert">
                <div class="row">
                    <div class="col-md-1 col-sm-1 justify-content-center">
                        <i class="fas fa-exclamation fa-3x"></i>
                    </div>
                    <div class="col-md-11 col-sm-11">
                        <p class="fw-bold">Data tidak ditemukan</p>
                        <p>Data yang anda cari tidak ada pada database, mohon ulangi seleksi untuk mendapatkan hasil yang anda cari</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
    <?php } else {
    if ($kategori == 4 || $kategori == 3) {
        $idPt = $_SESSION['pt'];
    ?>
        <!------------------------- table respon -------------------------->
        <div class="row mt-5">
            <div class="col-md-12 col-sm-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title text-center">Respon</h5>
                        <div class="table-responsive">
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
                                        <?php
                                        foreach ($brand as $row) {
                                            if ($prospek == 4) {
                                                $hasil1 = $this->db->query("SELECT brand, kategori, prospek, alasan, tanggal_input
                                                    FROM visit 
                                                    WHERE tanggal_join IS null
                                                    AND is_close IS null
                                                    AND pt = $idPt
                                                    AND brand = $row->id_franchise
                                                    AND tanggal_input >= '$tanggalAwal'
                                                    AND tanggal_input <= '$tanggalAkhir'
                                                    AND kategori = 3
                                                    AND alasan = 1")->num_rows();
                                            } elseif ($prospek < 4) {
                                                $hasil1 = $this->db->query("SELECT brand, kategori, prospek, alasan, tanggal_input
                                                    FROM visit 
                                                    WHERE tanggal_join IS null
                                                    AND is_close IS null
                                                    AND pt = $idPt
                                                    AND brand = $row->id_franchise
                                                    AND tanggal_input >= '$tanggalAwal'
                                                    AND tanggal_input <= '$tanggalAkhir'
                                                    AND kategori = 3
                                                    AND prospek = $prospek
                                                    AND alasan = 1")->num_rows();
                                            }
                                        ?>
                                            <td class="text-center" <?= ($hasil1 == 0) ? 'style="color: #EEEEEE;"' : ''; ?> onclick="showDetail('<?= $tanggalAwal; ?>', '<?= $tanggalAkhir; ?>', 1, 3, '<?= $row->id_franchise; ?>')"><?= ($hasil1 == 0) ? '-' : $hasil1; ?></td>
                                        <?php } ?>
                                    </tr>

                                    <tr>
                                        <td>Modal</td>
                                        <?php
                                        foreach ($brand as $row) {
                                            if ($prospek == 4) {
                                                $hasil2 = $this->db->query("SELECT brand, kategori, prospek, alasan, tanggal_input
                                                    FROM visit 
                                                    WHERE tanggal_join IS null
                                                    AND is_close IS null
                                                    AND pt = $idPt
                                                    AND brand = $row->id_franchise
                                                    AND tanggal_input >= '$tanggalAwal'
                                                    AND tanggal_input <= '$tanggalAkhir'
                                                    AND kategori = 3
                                                    AND alasan = 2")->num_rows();
                                            } elseif ($prospek < 4) {
                                                $hasil2 = $this->db->query("SELECT brand, kategori, prospek, alasan, tanggal_input
                                                    FROM visit 
                                                    WHERE tanggal_join IS null
                                                    AND is_close IS null
                                                    AND pt = $idPt
                                                    AND brand = $row->id_franchise
                                                    AND tanggal_input >= '$tanggalAwal'
                                                    AND tanggal_input <= '$tanggalAkhir'
                                                    AND kategori = 3
                                                    AND prospek = $prospek
                                                    AND alasan = 2")->num_rows();
                                            }
                                        ?>
                                            <td class="text-center" <?= ($hasil2 == 0) ? 'style="color: #EEEEEE;"' : ''; ?> onclick="showDetail('<?= $tanggalAwal; ?>', '<?= $tanggalAkhir; ?>', 2, 3, '<?= $row->id_franchise; ?>')"><?= ($hasil2 == 0) ? '-' : $hasil2; ?></td>
                                        <?php } ?>
                                    </tr>

                                    <tr>
                                        <td>Lokasi</td>
                                        <?php
                                        foreach ($brand as $row) {
                                            if ($prospek == 4) {
                                                $hasil3 = $this->db->query("SELECT brand, kategori, prospek, alasan, tanggal_input
                                                    FROM visit 
                                                    WHERE tanggal_join IS null
                                                    AND is_close IS null
                                                    AND pt = $idPt
                                                    AND brand = $row->id_franchise
                                                    AND tanggal_input >= '$tanggalAwal'
                                                    AND tanggal_input <= '$tanggalAkhir'
                                                    AND kategori = 3
                                                    AND alasan = 3")->num_rows();
                                            } elseif ($prospek < 4) {
                                                $hasil3 = $this->db->query("SELECT brand, kategori, prospek, alasan, tanggal_input
                                                    FROM visit 
                                                    WHERE tanggal_join IS null
                                                    AND is_close IS null
                                                    AND pt = $idPt
                                                    AND brand = $row->id_franchise
                                                    AND tanggal_input >= '$tanggalAwal'
                                                    AND tanggal_input <= '$tanggalAkhir'
                                                    AND kategori = 3
                                                    AND prospek = $prospek
                                                    AND alasan = 3")->num_rows();
                                            }
                                        ?>
                                            <td class="text-center" <?= ($hasil3 == 0) ? 'style="color: #EEEEEE;"' : ''; ?> onclick="showDetail('<?= $tanggalAwal; ?>', '<?= $tanggalAkhir; ?>', 3, 3, '<?= $row->id_franchise; ?>')"><?= ($hasil3 == 0) ? '-' : $hasil3; ?></td>
                                        <?php } ?>
                                    </tr>

                                    <tr>
                                        <td>Ongkir</td>
                                        <?php
                                        foreach ($brand as $row) {
                                            if ($prospek == 4) {
                                                $hasil4 = $this->db->query("SELECT brand, kategori, prospek, alasan, tanggal_input
                                                    FROM visit 
                                                    WHERE tanggal_join IS null
                                                    AND is_close IS null
                                                    AND pt = $idPt
                                                    AND brand = $row->id_franchise
                                                    AND tanggal_input >= '$tanggalAwal'
                                                    AND tanggal_input <= '$tanggalAkhir'
                                                    AND kategori = 3
                                                    AND alasan = 4")->num_rows();
                                            } elseif ($prospek < 4) {
                                                $hasil4 = $this->db->query("SELECT brand, kategori, prospek, alasan, tanggal_input
                                                    FROM visit 
                                                    WHERE tanggal_join IS null
                                                    AND is_close IS null
                                                    AND pt = $idPt
                                                    AND brand = $row->id_franchise
                                                    AND tanggal_input >= '$tanggalAwal'
                                                    AND tanggal_input <= '$tanggalAkhir'
                                                    AND kategori = 3
                                                    AND prospek = $prospek
                                                    AND alasan = 4")->num_rows();
                                            }
                                        ?>
                                            <td class="text-center" <?= ($hasil4 == 0) ? 'style="color: #EEEEEE;"' : ''; ?> onclick="showDetail('<?= $tanggalAwal; ?>', '<?= $tanggalAkhir; ?>', 4, 3, '<?= $row->id_franchise; ?>')"><?= ($hasil4 == 0) ? '-' : $hasil4; ?></td>
                                        <?php } ?>
                                    </tr>

                                    <tr>
                                        <td>Tester</td>
                                        <?php
                                        foreach ($brand as $row) {
                                            if ($prospek == 4) {
                                                $hasil5 = $this->db->query("SELECT brand, kategori, prospek, alasan, tanggal_input
                                                    FROM visit 
                                                    WHERE tanggal_join IS null
                                                    AND is_close IS null
                                                    AND pt = $idPt
                                                    AND brand = $row->id_franchise
                                                    AND tanggal_input >= '$tanggalAwal'
                                                    AND tanggal_input <= '$tanggalAkhir'
                                                    AND kategori = 3
                                                    AND alasan = 5")->num_rows();
                                            } elseif ($prospek < 4) {
                                                $hasil5 = $this->db->query("SELECT brand, kategori, prospek, alasan, tanggal_input
                                                    FROM visit 
                                                    WHERE tanggal_join IS null
                                                    AND is_close IS null
                                                    AND pt = $idPt
                                                    AND brand = $row->id_franchise
                                                    AND tanggal_input >= '$tanggalAwal'
                                                    AND tanggal_input <= '$tanggalAkhir'
                                                    AND kategori = 3
                                                    AND prospek = $prospek
                                                    AND alasan = 5")->num_rows();
                                            }
                                        ?>
                                            <td class="text-center" <?= ($hasil5 == 0) ? 'style="color: #EEEEEE;"' : ''; ?> onclick="showDetail('<?= $tanggalAwal; ?>', '<?= $tanggalAkhir; ?>', 5, 3, '<?= $row->id_franchise; ?>')"><?= ($hasil5 == 0) ? '-' : $hasil5; ?></td>
                                        <?php } ?>
                                    </tr>

                                    <tr>
                                        <td>Comparing</td>
                                        <?php
                                        foreach ($brand as $row) {
                                            if ($prospek == 4) {
                                                $hasil6 = $this->db->query("SELECT brand, kategori, prospek, alasan, tanggal_input
                                                    FROM visit 
                                                    WHERE tanggal_join IS null
                                                    AND is_close IS null
                                                    AND pt = $idPt
                                                    AND brand = $row->id_franchise
                                                    AND tanggal_input >= '$tanggalAwal'
                                                    AND tanggal_input <= '$tanggalAkhir'
                                                    AND kategori = 3
                                                    AND alasan = 6")->num_rows();
                                            } elseif ($prospek < 4) {
                                                $hasil6 = $this->db->query("SELECT brand, kategori, prospek, alasan, tanggal_input
                                                    FROM visit 
                                                    WHERE tanggal_join IS null
                                                    AND is_close IS null
                                                    AND pt = $idPt
                                                    AND brand = $row->id_franchise
                                                    AND tanggal_input >= '$tanggalAwal'
                                                    AND tanggal_input <= '$tanggalAkhir'
                                                    AND kategori = 3
                                                    AND prospek = $prospek
                                                    AND alasan = 6")->num_rows();
                                            }
                                        ?>
                                            <td class="text-center" <?= ($hasil6 == 0) ? 'style="color: #EEEEEE;"' : ''; ?> onclick="showDetail('<?= $tanggalAwal; ?>', '<?= $tanggalAkhir; ?>', 6, 3, '<?= $row->id_franchise; ?>')"><?= ($hasil6 == 0) ? '-' : $hasil6; ?></td>
                                        <?php } ?>
                                    </tr>

                                    <tr>
                                        <td>Booth</td>
                                        <?php
                                        foreach ($brand as $row) {
                                            if ($prospek == 4) {
                                                $hasil7 = $this->db->query("SELECT brand, kategori, prospek, alasan, tanggal_input
                                                    FROM visit 
                                                    WHERE tanggal_join IS null
                                                    AND is_close IS null
                                                    AND pt = $idPt
                                                    AND brand = $row->id_franchise
                                                    AND tanggal_input >= '$tanggalAwal'
                                                    AND tanggal_input <= '$tanggalAkhir'
                                                    AND kategori = 3
                                                    AND alasan = 7")->num_rows();
                                            } elseif ($prospek < 4) {
                                                $hasil7 = $this->db->query("SELECT brand, kategori, prospek, alasan, tanggal_input
                                                    FROM visit 
                                                    WHERE tanggal_join IS null
                                                    AND is_close IS null
                                                    AND pt = $idPt
                                                    AND brand = $row->id_franchise
                                                    AND tanggal_input >= '$tanggalAwal'
                                                    AND tanggal_input <= '$tanggalAkhir'
                                                    AND kategori = 3
                                                    AND prospek = $prospek
                                                    AND alasan = 7")->num_rows();
                                            }
                                        ?>
                                            <td class="text-center" <?= ($hasil7 == 0) ? 'style="color: #EEEEEE;"' : ''; ?> onclick="showDetail('<?= $tanggalAwal; ?>', '<?= $tanggalAkhir; ?>', 7, 3, '<?= $row->id_franchise; ?>')"><?= ($hasil7 == 0) ? '-' : $hasil7; ?></td>
                                        <?php } ?>
                                    </tr>

                                    <tr style="border-top: 3px solid black !important;">
                                        <td class="fw-bold">TOTAL</td>
                                        <?php
                                        foreach ($brand as $row) {
                                            if ($prospek == 4) {
                                                $total1 = $this->db->query("SELECT brand, kategori, prospek, alasan, tanggal_input
                                                    FROM visit 
                                                    WHERE tanggal_join IS null
                                                    AND is_close IS null
                                                    AND pt = $idPt
                                                    AND brand = $row->id_franchise
                                                    AND tanggal_input >= '$tanggalAwal'
                                                    AND tanggal_input <= '$tanggalAkhir'
                                                    AND kategori = 3")->num_rows();
                                            } elseif ($prospek < 4) {
                                                $total1 = $this->db->query("SELECT brand, kategori, prospek, alasan, tanggal_input
                                                    FROM visit 
                                                    WHERE tanggal_join IS null
                                                    AND is_close IS null
                                                    AND pt = $idPt
                                                    AND brand = $row->id_franchise
                                                    AND tanggal_input >= '$tanggalAwal'
                                                    AND tanggal_input <= '$tanggalAkhir'
                                                    AND kategori = 3
                                                    AND prospek = $prospek")->num_rows();
                                            }
                                        ?>
                                            <td class="text-center fw-bold" <?= ($total1 == 0) ? 'style="color: #EEEEEE;"' : ''; ?> onclick="showDetail('<?= $tanggalAwal; ?>', '<?= $tanggalAkhir; ?>', '', 3, '<?= $row->id_franchise; ?>')"><?= ($total1 == 0) ? '-' : $total1; ?></td>
                                        <?php } ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!------------------------- table respon -------------------------->

        <!------------------------- table no respon dan anak anak -------------------------->

        <div class="row mt-2">
            <div class="col-md-6 col-sm-12">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title text-center">No Respon</h5>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td></td>
                                        <?php foreach ($brand as $r) { ?>
                                            <td class="text-center fw-bold"><?= $r->slug_franchise; ?></td>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                    </tr>
                                    <tr style="border-top: 2px solid black !important;">
                                        <td class="fw-bold">TOTAL</td>
                                        <?php
                                        foreach ($brand as $rr) {
                                            $hasilNo = $this->db->query("SELECT brand, kategori
                                                    FROM visit
                                                    WHERE tanggal_join IS null
                                                    AND is_close IS null
                                                    AND pt = $idPt
                                                    AND tanggal_input >= '$tanggalAwal'
                                                    AND tanggal_input <= '$tanggalAkhir'
                                                    AND kategori = 2
                                                    AND brand = $rr->id_franchise")->num_rows();
                                        ?>
                                            <td class="text-center fw-bold"><?= ($hasilNo == 0) ? '-' : $hasilNo; ?></td>
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
                        <h5 class="card-title text-center">Anak anak</h5>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td></td>
                                        <?php foreach ($brand as $r) { ?>
                                            <td class="text-center fw-bold"><?= $r->slug_franchise; ?></td>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                    </tr>
                                    <tr style="border-top: 2px solid black !important;">
                                        <td class="fw-bold">TOTAL</td>
                                        <?php
                                        foreach ($brand as $rr) {
                                            $hasilAnak = $this->db->query("SELECT brand, kategori
                                                    FROM visit
                                                    WHERE tanggal_join IS null
                                                    AND is_close IS null
                                                    AND pt = $idPt
                                                    AND tanggal_input >= '$tanggalAwal'
                                                    AND tanggal_input <= '$tanggalAkhir'
                                                    AND kategori = 1
                                                    AND brand = $rr->id_franchise")->num_rows();
                                        ?>
                                            <td class="text-center fw-bold"><?= ($hasilAnak == 0) ? '-' : $hasilAnak; ?></td>
                                        <?php } ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!------------------------- table no respon dan anak anak -------------------------->
    <?php } ?>
<?php } ?>