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

<a href="<?= base_url('pegawai/ketidakhadiran/create') ?>" class="btn btn-primary"><i class="lni lni-circle-plus"></i> Ajukan</a>

<table class="table table-striped" id="datatables">
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Tanggal</th>
            <th class="text-center">Keterangan</th>
            <th class="text-center">Deskripsi</th>
            <th class="text-center">File</th>
            <th class="text-center">Status</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <?php if ($ketidakhadiran) : ?>
    <tbody>
        <?php $no = 1;
        foreach ($ketidakhadiran as $ketidakhadiran) : ?>
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td class="text-center"><?= $ketidakhadiran['tanggal'] ?></td>
                <td class="text-center"><?= $ketidakhadiran['keterangan'] ?></td>
                <td class="text-center"><?= $ketidakhadiran['deskripsi'] ?></td>
                <td class="text-center">
                    <?php 
                        $ext = pathinfo($ketidakhadiran['file'], PATHINFO_EXTENSION);
                        if (in_array($ext, ['pdf', 'doc', 'docx'])) :
                    ?>
                        <a class="badge bg-light text-dark border border-primary p-2" 
                            href="<?= base_url('file_ketidakhadiran/' . $ketidakhadiran['file']) ?>" download> 📄 .<?= $ext ?></a>
                    <?php endif; ?>
                </td>
                <td class="text-center"><?= $ketidakhadiran['status'] ?></td>
                <td class="text-center">
                    <?php if ($ketidakhadiran['status'] === 'Setuju') : ?>
                        <i class="fas fa-check text-success"></i>
                    <?php elseif ($ketidakhadiran['status'] === 'Ditolak') : ?>
                        <a href="<?= base_url('pegawai/ketidakhadiran/delete/' . $ketidakhadiran['id']) ?>" class="btn btn-danger tombol-hapus">Hapus</a>
                    <?php else : ?>
                        <a href="<?= base_url('pegawai/ketidakhadiran/edit/' . $ketidakhadiran['id']) ?>" class="btn btn-warning text-dark">Edit</a>
                        <a href="<?= base_url('pegawai/ketidakhadiran/delete/' . $ketidakhadiran['id']) ?>" class="btn btn-danger tombol-hapus">Hapus</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <?php else : ?>
    <tbody>
        <tr>
            <td colspan="7" class="text-center">Data masih kosong</td>
        </tr>
    </tbody>
    <?php endif; ?>
</table>

<?= $this->endSection() ?>
