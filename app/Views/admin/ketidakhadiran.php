<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>


<table class="table table-striped" id="datatatables">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Deskripsi</th>
            <th>File</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <?php if($ketidakhadiran) : ?>
    <tbody>
    <?php $no = 1;
    foreach ($ketidakhadiran as $ketidakhadiran) :?>
      
      <tr>
    <td><?= $no++ ?></td>
    <td><?= $ketidakhadiran['tanggal'] ?></td>
    <td><?= $ketidakhadiran['keterangan'] ?></td>
    <td><?= $ketidakhadiran['deskripsi'] ?></td>
    <td>
        <a class="badge bg-primary" href="<?= base_url('file_ketidakhadiran/'. $ketidakhadiran['file']) ?>">Download</a>
    </td>
    <td>
    <?php if ($ketidakhadiran['status'] == 'Menunggu') : ?>
        <span class="text-danger"><?= $ketidakhadiran['status'] ?></span>
    <?php else : ?>
        <span class="text-success"><?= $ketidakhadiran['status'] ?></span>
    <?php endif; ?>
</td>
    <td>
    <a class="badge bg-success" href="<?= base_url('admin/setuju_ketidakhadiran/'. $ketidakhadiran['id']) ?>">Setuju</a>
    </td>
</tr>
        <?php endforeach ;?>
        </tbody>
        <?php else : ?>
                <tbody>
                   <tr>
                      <td colspan="7">Data masih kosong</td>
                  </tr>
                </tbody>
<?php endif; ?>
</table>
<?= $this->endSection() ?>