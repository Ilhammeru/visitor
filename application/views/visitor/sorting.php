<!-- <tr>
    <th>No</th>
    <th>Tanggal</th>
    <th>Nama</th>
    <th>No. Telfon</th>
    <th>Brand</th>
    <th>Aksi</th>
</tr> -->
<!-- <tbody>

</tbody> -->
<?php if ($jumData > 0) { ?>
    <?php $no = 1;
    foreach ($hasil as $row) { ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= tanggal($row->tanggal_input); ?></td>
            <td><?= $row->nama; ?></td>
            <td><?= $row->hp; ?></td>
            <?php if ($row->tanggal_join == null) { ?>
                <?php if (isset($brand['b' . $row->brand])) { ?>
                    <td><?= $brand['b' . $row->brand] . ' (<span class="text-danger"><i class="fas fa-times"></i></span>)'; ?></td>
                <?php } ?>
            <?php } else { ?>
                <td><?= $brand['b' . $row->brand] . ' (<span class="text-success"><i class="fas fa-check"></i></span>)'; ?></td>
            <?php } ?>
            <?php if ($row->tanggal_join == null) { ?>
                <td>
                    <div class="btn-group" role="group">
                        <?php if ($row->is_close == null) { ?>
                            <a onclick="edit(<?= $row->id_visit; ?>)" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-outline-danger btn-sm" onclick="hapusVisitor(<?= $row->id_visit; ?>)"><i class="fas fa-trash-alt"></i></a>
                        <?php } else { ?>
                            <span class="fst-italic" style="font-size: 0.8em;">Sudah closing</span>
                        <?php } ?>
                    </div>
                </td>
            <?php } else { ?>
                <td colspan="2" class="fst-italic text-success" style="font-size: 0.8em;">Sudah Join</td>
            <?php } ?>
        </tr>
    <?php } ?>
    <tr class="text-start">
        <td colspan="6"><?= $jumData; ?> ditemukan</td>
    </tr>
<?php } else { ?>
    <tr class="text-center">
        <td colspan="6">Data tidak ditemukan</td>
    </tr>
<?php } ?>