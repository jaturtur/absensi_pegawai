<?= $this->extend('pegawai/layout.php') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
    .btn-custom {
        display: inline-block;
        padding: 10px 16px;
        font-size: 16px;
        font-weight: bold;
        border-radius: 8px;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-edit {
        background-color: #ffc107; /* Warna kuning */
        color: #000; /* Warna teks hitam agar kontras */
        border: 2px solid #e0a800;
    }

    .btn-edit:hover {
        background-color: #e0a800; /* Warna kuning lebih gelap saat hover */
    }

    .btn-hapus {
        background-color: #dc3545; /* Warna merah */
        color: #fff; /* Warna teks putih */
        border: 2px solid #c82333;
    }

    .btn-hapus:hover {
        background-color: #c82333; /* Warna merah lebih gelap saat hover */
    }

    .badge-approved {
        background-color: #28a745; /* Warna hijau untuk status disetujui */
        color: #fff;
        padding: 10px 16px;
        font-size: 16px;
        font-weight: bold;
        border-radius: 8px;
        display: inline-block;
    }
</style>

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
                <?php if ($ketidakhadiran['status'] === 'Setuju') : ?>
                    <span class="badge bg-success"><i class="fas fa-check"></i></span>
            <?php else : ?>
                  <a href="<?= base_url('pegawai/ketidakhadiran/edit/' . $ketidakhadiran['id']) ?>" class="badge bg-primary">Edit</a>
                    <a href="<?= base_url('pegawai/ketidakhadiran/delete/' . $ketidakhadiran['id']) ?>" class="badge bg-danger tombol-hapus">Hapus</a>
<?php endif; ?>

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