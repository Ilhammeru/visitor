<div class="row mb-3">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="">Nama</label>
            <input type="text" id="namaEdit" class="form-control" value="<?= $nama; ?>">
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="">Aksesbilitas</label>
            <select name="" class="form-control" id="aksesEdit">
                <optgroup label="Pilihan Sebelumnya">
                    <option value="<?= $role; ?>"><?= $status; ?></option>
                </optgroup>
                <optgroup label="Data">
                    <option value="1">Admin</option>
                    <option value="2">User</option>
                    <?php if ($_SESSION['role'] == 0) { ?>
                        <option value="5">Pemasaran</option>
                    <?php } ?>
                </optgroup>
            </select>
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="">Database Name</label>
            <input type="text" class="form-control" id="database" name="database" value="<?= $db; ?>">
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="">Perusahaan</label>
            <select name="" class="form-control" id="ptEdit">
                <optgroup label="Pilihan sebelumnya">
                    <option value="<?= $pt; ?>"><?= $ptName; ?></option>
                </optgroup>
                <optgroup label="Data">
                    <?php foreach ($daftarPt as $dp) { ?>
                        <option value="<?= $dp->id; ?>"><?= $dp->name; ?></option>
                    <?php } ?>
                </optgroup>
            </select>
        </div>
    </div>
</div>