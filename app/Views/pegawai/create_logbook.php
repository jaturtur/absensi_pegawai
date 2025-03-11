<?= $this->extend('pegawai/layout') ?>

<?= $this->section('content') ?>

<form action="/pegawai/logbook/store" method="post">
    <?= csrf_field() ?>
    <div class="form-group">
        <label for="hari_tanggal">Hari/Tanggal</label>
        <input type="date" name="hari_tanggal" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="rencana_target">Rencana Target</label>
        <input type="text" name="rencana_target" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="output">Output</label>
        <input type="text" name="output" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="catatan">Catatan</label>
        <textarea name="catatan" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary mt-3 me-2">Simpan</button>
    <a href="/pegawai/logbook" class="btn btn-secondary mt-3">Kembali</a>
</form>

<?= $this->endSection() ?>
