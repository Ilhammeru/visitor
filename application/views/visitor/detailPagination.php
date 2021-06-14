<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nomor Hp</th>
                <th>Nama</th>
                <th>Brand</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hasil as $row) : ?>

                <tr>
                    <td><?= tanggal($row->tanggal_input); ?></td>
                    <td><?= $row->hp; ?></td>
                    <td><?= $row->nama; ?></td>
                    <?php if (isset($brandArray['b' . $row->brand])) { ?>
                        <td><?= $brandArray['b' . $row->brand]; ?></td>
                    <?php } ?>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $pagination; ?>
</div>