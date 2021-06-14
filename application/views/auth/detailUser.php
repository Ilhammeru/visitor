<?php $no = 1;
foreach ($hasil as $row) : ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $row->nama_user; ?></td>
        <?php if (isset($pt['p' . $row->pt])) { ?>
            <td><?= $pt['p' . $row->pt]; ?></td>
        <?php } ?>
        <td><?= $row->status; ?></td>
        <td><a class="btn btn-outline-warning btn-sm" onclick="editUser(<?= $row->id; ?>)"> <i class="fas fa-edit"></i></a> <a class="btn btn-outline-danger btn-sm" onclick="hapusUser(<?= $row->id; ?>)"><i class="fas fa-trash-alt"></i></a></td>
    </tr>

<?php endforeach; ?>