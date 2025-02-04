<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<table class="table table-striped table-bordered">
    <tr>
        <th>No</th>
        <th>Nama Pegawai</th>
        <th>Tanggal</th>
        <th>Jam masuk</th>
        <th>Jam Keluar</th>
        <th>Durasi Jam Kerja</th>
        <th>Total Keterlambatan</th>
    </tr>

    <?php $no = 1;
        foreach ($rekap_harian as $rekap): ?>
        <?php
            $timestampmasuk_jam_masuk = strtotime($rekap['tanggal_masuk'].$rekap['jam_masuk']);
            $timestampmasuk_jam_keluar = strtotime($rekap['tanggal_keluar'].$rekap['jam_keluar']);
            $selisih = $timestampmasuk_jam_keluar - $timestampmasuk_jam_masuk;
            $jam = floor($selisih / 3600); 
            $selisih -= $jam * 3600;
            $menit = floor($selisih / 60);
        ?>
     <tr>
            <td><?= $no++ ?></td>
            <td><?= $rekap['nama'] ?></td>
            <td><?= date('d F Y', strtotime($rekap['tanggal_masuk'])) ?></td>
            <td><?= $rekap['jam_masuk'] ?></td>
            <td><?= $rekap['jam_keluar'] ?></td>
            <td><?= $jam . ' Jam ' . $menit . 'Menit' ?></td>
        </tr>
    <?php endforeach; ?>

</table>

<?= $this->endSection() ?>