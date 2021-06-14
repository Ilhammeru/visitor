<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Alasan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($hasil as $row) : ?>
            <tr>
                <td><?= ++$halaman; ?></td>
                <td><?= $row->alasan; ?></td>
                <td> <a class="btn btn-outline-danger btn-sm" onclick="hapusAlasan(<?= $row->id; ?>)"><i class="fas fa-trash-alt"></i></a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if ($jumlahData > 10) { ?>
    <nav aria-label="Page navigation example" id="pagination">
        <ul class="pagination">
            <?php for ($i = 1; $i <= $per_page; $i++) { ?>
                <li class="page-item"><a data-page="<?= $i; ?>" class="page-link" href="#"><?= $i; ?></a></li>
            <?php } ?>
        </ul>
    </nav>
<?php } ?>