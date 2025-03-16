<?= $this->extend('pegawai/layout') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="card p-4 shadow">
        <table class="table table-striped">
            <tr>
                <th class="w-25">Hari/Tanggal</th>
                <td><?= esc($logbook['hari_tanggal']) ?></td>
            </tr>
            <tr>
                <th>Rencana Target</th>
                <td><?= esc($logbook['rencana_target']) ?></td>
            </tr>
            <tr>
                <th>Output</th>
                <td><?= esc($logbook['output']) ?></td>
            </tr>
            <tr>
                <th>Catatan</th>
                <td><?= esc($logbook['catatan']) ?></td>
            </tr>
        </table>
        <a href="/pegawai/logbook" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>
<link rel="stylesheet" href="<?= base_url('css/custom.css') ?>">

<?= $this->endSection() ?>
