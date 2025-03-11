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
                    <td class="text-center align-middle"> <?= $no++ ?> </td>
                    <td class="text-center align-middle"> <?= $ketidakhadiran['tanggal'] ?> </td>
                    <td class="text-center align-middle"> <?= $ketidakhadiran['keterangan'] ?> </td>
                    <td class="text-center align-middle"> <?= $ketidakhadiran['deskripsi'] ?> </td>
                    <td class="text-center align-middle">
                        <?php 
                        $file_ext = pathinfo($ketidakhadiran['file'], PATHINFO_EXTENSION);
                        $file_url = base_url('file_ketidakhadiran/' . $ketidakhadiran['file']);
                        ?>
                        
                        <?php if (in_array($file_ext, ['pdf', 'doc', 'docx'])) : ?>
                            <a class="btn btn-light border p-2 rounded shadow-sm" 
                               href="<?= ($file_ext == 'pdf') 
                                        ? $file_url 
                                        : 'https://docs.google.com/gview?url=' . urlencode($file_url) . '&embedded=true'; ?>" 
                               target="_blank" 
                               style="text-decoration: none; transition: 0.3s;">
                               <i class="fa-solid fa-eye"></i> 
                            </a>
                            
                            <a class="btn btn-light border p-2 rounded shadow-sm" 
                               href="<?= $file_url ?>" download 
                               style="text-decoration: none; transition: 0.3s;">
                               <i class="fa-solid fa-download"></i>
                            </a>
                        <?php else : ?>
                            <a class="badge bg-warning text-dark border p-2 rounded shadow-sm" 
                               href="<?= $file_url ?>" download 
                               style="text-decoration: none; transition: 0.3s;">
                               <i class="fa-solid fa-file"></i> Unduh
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
                    <td class="text-center align-middle">
                        <?php if ($ketidakhadiran['status'] == 'Menunggu') : ?>
                            <a class="btn btn-success btn-sm shadow-sm rounded" 
                               href="<?= base_url('admin/setuju_ketidakhadiran/' . $ketidakhadiran['id']) ?>">
                               <i class="fa-solid fa-check"></i> Setuju
                            </a>
                            <a class="btn btn-danger btn-sm shadow-sm rounded" 
                               href="<?= base_url('admin/tolak_ketidakhadiran/' . $ketidakhadiran['id']) ?>">
                               <i class="fa-solid fa-xmark"></i> Tolak
                            </a>
                        <?php else : ?>
                            <i class="text-secondary">Selesai</i>
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
