<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<table class="table table-striped table-bordered">
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
                        $file_ext = pathinfo($ketidakhadiran['file'], PATHINFO_EXTENSION);
                        if (in_array($file_ext, ['pdf', 'doc', 'docx'])) : ?>
                            <a class="badge bg-light text-dark border border-primary p-2" 
                               href="<?= base_url('file_ketidakhadiran/' . $ketidakhadiran['file']) ?>" download>
                               📄 .<?= $file_ext ?></a>
                        <?php else : ?>
                            <a class="badge bg-warning text-dark border border-secondary p-2" 
                               href="<?= base_url('file_ketidakhadiran/' . $ketidakhadiran['file']) ?>" download>
                               📁 Unduh</a>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <?php if ($ketidakhadiran['status'] == 'Menunggu') : ?>
                            <span class="badge bg-warning text-dark">⏳ Menunggu</span>
                        <?php elseif ($ketidakhadiran['status'] == 'Setuju') : ?>
                            <span class="badge bg-success text-white">✅ Setuju</span>
                        <?php else : ?>
                            <span class="badge bg-danger text-white">❌ Ditolak</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <?php if ($ketidakhadiran['status'] == 'Menunggu') : ?>
                            <a class="btn btn-success btn-sm" href="<?= base_url('admin/setuju_ketidakhadiran/' . $ketidakhadiran['id']) ?>">Setuju</a>
                            <a class="btn btn-danger btn-sm" href="<?= base_url('admin/tolak_ketidakhadiran/' . $ketidakhadiran['id']) ?>">Tolak</a>
                        <?php else : ?>
                            <i class="text-secondary">Tidak ada aksi</i>
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
