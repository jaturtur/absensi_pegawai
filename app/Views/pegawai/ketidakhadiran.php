<?= $this->extend('pegawai/layout.php') ?>

<?= $this->section('content') ?>




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
                        $file_url = base_url('file_ketidakhadiran/' . $ketidakhadiran['file']);
                        $ext = pathinfo($ketidakhadiran['file'], PATHINFO_EXTENSION);
                        if (in_array($ext, ['pdf', 'doc', 'docx'])) :
                    ?>
                        <a class="btn btn-light border shadow-sm" 
                           href="<?= ($ext == 'pdf') 
                                    ? $file_url 
                                    : 'https://docs.google.com/gview?url=' . urlencode($file_url) . '&embedded=true'; ?>" 
                           target="_blank">
                           <i class="fas fa-eye"></i>
                        </a>

                        <a class="btn btn-light border shadow-sm" 
                           href="<?= $file_url ?>" download>
                           <i class="fas fa-download"></i> 
                        </a>
                    <?php endif; ?>
                </td>
                <td class="text-center align-middle">
                        <?php if ($ketidakhadiran['status'] == 'Menunggu') : ?>
                            <span class="badge bg-warning text-dark p-2 rounded shadow-sm"><i class="fa-solid fa-hourglass-half"></i> Menunggu</span>
                        <?php elseif ($ketidakhadiran['status'] == 'Setuju') : ?>
                            <span class="badge bg-success text-white p-2 rounded shadow-sm"><i class="fa-solid fa-circle-check"></i> Setuju</span>
                        <?php else : ?>
                            <span class="badge bg-danger text-white p-2 rounded shadow-sm"><i class="fa-solid fa-circle-xmark"></i> Ditolak</span>
                        <?php endif; ?>
                    </td>

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
