<?php if ($trigger == 'respon') { ?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Hp</th>
                    <th>Umur</th>
                    <th>Prospek</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($hasil as $row) {
                    if ($row->umur == '1') {
                        $umur = '< 20 tahun';
                    } elseif ($row->umur == '2') {
                        $umur = '20 - 30 tahun';
                    } elseif ($row->umur == '3') {
                        $umur = '30 - 40 tahun';
                    } else {
                        $umur = '> 40 tahun';
                    }
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row->nama; ?></td>
                        <td><?= $row->hp; ?></td>
                        <td><?= $umur; ?></td>
                        <td>
                            <?php for ($i = 0; $i < $row->prospek; $i++) { ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="30" fill="gold" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                </svg>
                            <?php } ?>
                        </td>
                        <td><a href="tel:<?= $row->hp; ?>"><i class="fas fa-phone"></i></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } else { ?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Hp</th>
                    <th>Umur</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($hasil as $row) {
                    if ($row->umur == '1') {
                        $umur = '< 20 tahun';
                    } elseif ($row->umur == '2') {
                        $umur = '20 - 30 tahun';
                    } elseif ($row->umur == '3') {
                        $umur = '30 - 40 tahun';
                    } else {
                        $umur = '> 40 tahun';
                    }
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row->nama; ?></td>
                        <td><?= $row->hp; ?></td>
                        <td><?= $umur; ?></td>
                        <td><a href="tel:<?= $row->hp; ?>"><i class="fas fa-phone"></i></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } ?>