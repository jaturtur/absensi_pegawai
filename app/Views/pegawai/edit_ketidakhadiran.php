<?= $this->extend('pegawai/layout.php') ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error'); ?>
    </div>
<?php endif; ?>

<div class="card col-md-6">
    <div class="card-body">
        <form method="POST" action="<?= base_url('pegawai/ketidakhadiran/update/'. $ketidakhadiran['id']) ?>" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="input-style-1">
                <label>Keterangan</label>
                <select name="keterangan" class="form-control <?= ($validation->hasError('keterangan')) ? 'is-invalid' : '' ?>">
                    <option value="">Pilih Keterangan</option>
                    <option value="Izin" <?= ($ketidakhadiran['keterangan'] == 'Izin') ? 'selected' : '' ?>>Izin</option>
                    <option value="Sakit" <?= ($ketidakhadiran['keterangan'] == 'Sakit') ? 'selected' : '' ?>>Sakit</option>
                    <option value="Perjalanan Tugas" <?= ($ketidakhadiran['keterangan'] == 'Perjalanan Tugas') ? 'selected' : '' ?>>Perjalanan Tugas</option>
                </select>
                <div class="invalid-feedback"><?= $validation->getError('keterangan') ?></div>
            </div>

            <div class="input-style-1">
                <label>Tanggal Ketidakhadiran</label>
                <input type="date" class="form-control <?= ($validation->hasError('tanggal')) ? 'is-invalid' : '' ?>" name="tanggal" value="<?= esc($ketidakhadiran['tanggal']) ?>">
                <div class="invalid-feedback"><?= $validation->getError('tanggal') ?></div>
            </div>

            <div class="input-style-1">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : '' ?>" cols="30" rows="5" placeholder="Deskripsi"><?= esc($ketidakhadiran['deskripsi']) ?></textarea>
                <div class="invalid-feedback"><?= $validation->getError('deskripsi') ?></div>
            </div>

            <div class="input-style-1">
                <label>File</label>
                <input type="hidden" name="file_lama" value="<?= esc($ketidakhadiran['file']) ?>">
                <input type="file" class="form-control <?= ($validation->hasError('file')) ? 'is-invalid' : '' ?>" name="file">

                <?php if ($validation->hasError('file')) : ?>
                    <div class="alert alert-danger mt-2"><?= $validation->getError('file') ?></div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
