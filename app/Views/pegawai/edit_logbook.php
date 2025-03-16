<?= $this->extend('pegawai/layout') ?>

<?= $this->section('content') ?>

<form action="/pegawai/logbook/update/<?= $logbook['id'] ?>" method="post">
    <?= csrf_field() ?>
    <div class="form-group">
        <label for="hari_tanggal">Hari/Tanggal</label>
        <input type="date" name="hari_tanggal" class="form-control" value="<?= esc($logbook['tanggal']) ?>" required>
    </div>
    <div class="form-group">
        <label for="rencana_target">Rencana Target</label>
        <input type="text" name="rencana_target" class="form-control" value="<?= esc($logbook['rencana_target']) ?>" required>
    </div>
    <div class="form-group">
        <label for="hasil">Hasil</label>
        <input type="text" name="hasil" class="form-control" value="<?= esc($logbook['hasil']) ?>" required>
    </div>
    <div class="form-group">
        <label for="keterangan">Keterangan</label>
        <textarea name="keterangan" class="form-control"><?= esc($logbook['keterangan']) ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary mt-3 me-2">Simpan</button>
    <a href="/pegawai/logbook" class="btn btn-secondary mt-3">Kembali</a>
</form>

<?= $this->endSection() ?>

<head>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<div class="p-4">
    <h2 class="mb-3">Edit Logbook</h2>
    <div class="full-width shadow-sm">
        <form action="/pegawai/logbook/update/<?= $logbook['id'] ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="hari_tanggal" class="form-label">Hari/Tanggal</label>
                <input type="date" name="hari_tanggal" class="form-control" value="<?= esc($logbook['tanggal']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="rencana_target" class="form-label">Rencana Target</label>
                <input type="text" name="rencana_target" class="form-control" value="<?= esc($logbook['rencana_target']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="hasil" class="form-label">Hasil</label>
                <input type="text" name="hasil" class="form-control" value="<?= esc($logbook['hasil']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control"><?= esc($logbook['keterangan']) ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/pegawai/logbook" class="btn btn-secondary ms-2">Batal</a>
        </form>
    </div>
</div>
