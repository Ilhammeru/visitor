<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Brand</th>
            <th>Prospek</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($hasil as $row) : ?>
            <tr>
                <td><?= ++$halaman; ?></td>
                <td><?= tanggal($row->tanggal_input); ?></td>
                <td><?= $row->nama; ?></td>
                <?php if (isset($brand['b' . $row->brand])) { ?>
                    <td><?= $brand['b' . $row->brand]; ?></td>
                <?php } ?>
                <td>
                    <?php for ($i = 0; $i < $row->prospek; $i++) { ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="30" fill="gold" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                        </svg>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if ($per_page > 1) { ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php for ($i = 1; $i <= $per_page; $i++) { ?>
                <?php $aktif = ($cek == $i) ? 'active' : ''; ?>
                <li class="page-item <?= $aktif; ?>"><a class="page-link" data-page="<?= $i; ?>" href="#"><?= $i; ?></a></li>
            <?php } ?>
        </ul>
    </nav>
<?php } ?>