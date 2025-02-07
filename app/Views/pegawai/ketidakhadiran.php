<?= $this->extend('pegawai/layout.php') ?>

<?= $this->section('content') ?>
<a href="<?= base_url('pegawai/ketidakhadiran/create') ?>" class="btn btn-success"><i class="lni lni-circle-plus"></i> Ajukan</a>

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
                <td><?= $ketidakhadiran ['tanggal'] ?></td>
                <td><?= $ketidakhadiran ['keterangan'] ?></td>
                <td><?= $ketidakhadiran ['deskripsi'] ?></td>
                <td>
                    <a class="badge bg-light text-dark border border-primary p-2" 
                     href="<?= base_url('file_ketidakhadiran/' . $ketidakhadiran['file']) ?>" download> 📄 <?= $ketidakhadiran['file'] ?></a></td>
                <td><?= $ketidakhadiran ['status'] ?></td>
                <td>
                <div>
                <a href="<?= base_url('pegawai/ketidakhadiran/edit/' . $ketidakhadiran['id']) ?>" class="badge bg-primary">Edit</a>
                <a href="<?= base_url('pegawai/ketidakhadiran/delete/'). $ketidakhadiran['id'] ?>" class="badge bg-danger tombol-hapus">Hapus</a>
                </div>
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