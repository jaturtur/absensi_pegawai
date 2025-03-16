<?= $this->extend('pegawai/layout') ?>

<?= $this->section('content') ?>

<a href="/pegawai/logbook/create" class="btn btn-primary mt-3">Tambah Logbook</a>

<?php if (isset($_GET['tambah'])): ?>
    <h2>Tambah Logbook</h2>
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
            <select name="output" class="form-control">
                <option value="proses">Proses</option>
                <option value="selesai">Selesai</option>
            </select>
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/pegawai/logbook" class="btn btn-secondary">Kembali</a>
    </form>

<?php else: ?>
<table class="table table-striped mt-3">
    <thead>
        <tr>
            <th>Hari/Tanggal</th>
            <th>Rencana Target</th>
            <th>Output</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($logbooks as $logbook) : ?>
            <tr>
                <td><?= esc($logbook['hari_tanggal']) ?></td>
                <td><?= esc($logbook['rencana_target']) ?></td>
                <td><?= esc($logbook['output']) ?></td>
                <td><?= esc($logbook['keterangan']) ?></td>
                <td>
                    <a href="/pegawai/logbook/detail/<?= $logbook['id'] ?>" class="btn btn-info btn-sm">Detail</a>
                    <a href="/pegawai/logbook/edit/<?= $logbook['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="/pegawai/logbook/delete/<?= $logbook['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>

<?= $this->endSection() ?>
