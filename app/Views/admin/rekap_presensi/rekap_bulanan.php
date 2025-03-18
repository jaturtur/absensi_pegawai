<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<form class="row g-3">
<div class="col-auto">
    <select name="filter_bulan" id="filter_bulan" class="form-control">
        <option value="">—Pilih Bulan</option>
        <option value="01">Januari</option>
        <option value="02">Februari</option>
        <option value="03">Maret</option>
        <option value="04">April</option>
        <option value="05">Mei</option>
        <option value="06">Juni</option>
        <option value="07">Juli</option>
        <option value="08">Agustus</option>
        <option value="09">September</option>
        <option value="10">Oktober</option>
        <option value="11">November</option>
        <option value="12">Desember</option>
    </select>
</div>

<div class="col-auto">

    <select name="filter_tahun" id="filter_tahun" class="form-control">
        <option value="">—Pilih Tahun</option>
        <option value="2024">2024</option>
        <option value="2025">2025</option>
        <option value="2026">2026</option>
        <option value="2027">2027</option>
        <option value="2028">2028</option>
        <option value="2029">2029</option>
        <option value="2030">2030</option>
        <option value="2031">2031</option>
        <option value="2032">2032</option>
        <option value="2033">2033</option>
        <option value="2034">2034</option>
        <option value="2035">2035</option>
    </select>
</div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Tampilan</button>
    </div>
    <div class="col-auto">
        <button type="submit" name="excel" class="btn btn-success mb-3">Export Excel</button>
    </div>
</form>
<span style="font-weight: bold; font-size: 16px; color: #007bff;">
    📅 Menampilkan Data:  
    <?php if ($bulan) : ?>
        <?= date('F Y', strtotime("$tahun-$bulan")) ?>
    <?php else : ?>
        <?= date('F Y') ?>
    <?php endif; ?>
</span>
<table class="table table-striped table-bordered">
    <tr>
        <th class="text-center">No</th>
        <th class="text-center">NIP</th>
        <th class="text-center">Nama Pegawai</th>
        <th class="text-center">Tanggal</th>
        <th class="text-center">Jam masuk</th>
        <th class="text-center">Jam Keluar</th>
        <th class="text-center">Durasi Jam Kerja</th>
        <th class="text-center">Total Keterlambatan</th>
    </tr>


    <?php if($rekap_bulanan) : ?>
    <?php $no = 1;
        foreach ($rekap_bulanan as $rekap): ?>
        <?php

        // menghitung durasi jam kerja
            $timestampmasuk_jam_masuk = strtotime($rekap['tanggal_masuk'].$rekap['jam_masuk']);
            $timestampmasuk_jam_keluar = strtotime($rekap['tanggal_keluar'].$rekap['jam_keluar']);
            $selisih = $timestampmasuk_jam_keluar - $timestampmasuk_jam_masuk;
            $jam = floor($selisih / 3600); 
            $selisih -= $jam * 3600;
            $menit = floor($selisih / 60);

       // menghitung total jam keterlambatan
            $jam_masuk_real = strtotime($rekap['jam_masuk']);
            $jam_masuk_kantor = strtotime($rekap['jam_masuk_kantor']);
            $selisih_terlambat = $jam_masuk_real - $jam_masuk_kantor;
            $jam_terlambat = floor($selisih_terlambat / 3600);
            $selisih_terlambat -= $jam_terlambat * 3600;
            $menit_terlambat = floor($selisih_terlambat / 60);

        ?>
     <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td class="text-center"><?= $rekap['nip'] ?></td>
            <td class="text-center"><?= $rekap['nama'] ?></td>
            <td class="text-center"><?= date('d F Y', strtotime($rekap['tanggal_masuk'])) ?></td>
            <td class="text-center"><?= $rekap['jam_masuk'] ?></td>
            <td class="text-center"><?= $rekap['jam_keluar'] ?></td>
            <td class="text-center">
            <?php if ($rekap['jam_keluar'] == '00:00:00') : ?>
                         0 Jam 0 Menit
            <?php else : ?>
            <?= $jam . ' Jam ' . $menit . ' Menit ' ?>
        <?php endif; ?>
        </td>   
        <td class="text-center">
            <?php if ($jam_terlambat < 0 || $menit_terlambat < 0) : ?>
              <span class="btn btn-success">On Time</span>
            <?php else : ?>
            <?= $jam_terlambat . ' Jam ' . $menit_terlambat . ' Menit ' ?>
        <?php endif; ?>
        </td>
        </tr>
    <?php endforeach; ?>
    <?php else : ?>
        <tr>
        <td colspan="7" style="text-align: center; font-style: italic;">Data Ini Memang Kosong</td>
        </tr>
        <?php endif; ?>

</table>

<?= $this->endSection() ?>