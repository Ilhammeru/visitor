<div class="row mt-3 mb-2" id="targetJumlah" hidden>
    <div class=" col">
        <span class=" fst-italic" style="font-size: 0.8em"><?= $cek; ?> data ditemukan</span>
    </div>
</div>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>No. Telfon</th>
                <th>Brand</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($cek == 0) { ?>
                <tr class="text-center">
                    <td colspan="6">Data tidak ditemukan</td>
                </tr>
            <?php } else { ?>
                <?php $no = 1;
                foreach ($visit as $r) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= tanggal(date('Y-m-d', strtotime($r->tanggal_input))); ?></td>
                        <td><?= $r->nama; ?></td>
                        <td><?= $r->hp; ?></td>
                        <?php if (isset($brandArr['b' . $r->brand])) { ?>
                            <td><?= $brandArr['b' . $r->brand]; ?></td>
                        <?php } ?>
                        <td><a onclick="edit(<?= $r->id_visit; ?>)" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i></a> <a class="btn btn-outline-danger btn-sm" onclick="hapusVisitor(<?= $r->id_visit; ?>)"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            <?php } ?>
        </tbody>
    </table>
</div>