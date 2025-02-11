<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<a href="<?=base_url('admin/lokasi_presensi/create')?>" class="btn btn-primary">Tambah Data</a>
<table class="table table-striped" id="datatables">
    <thead>
        <tr>
        <th>No</th>
        <th>Nama Lokasi</th>
        <th>Alamat Lokasi</th>
        <th>Tipe Lokasi</th>
        <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php $no = 1;
    foreach ($lokasi_presensi as $lok) :?>
      
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $lok ['nama_lokasi'] ?></td>
                <td><?= $lok ['alamat_lokasi'] ?></td>
                <td><?= $lok ['tipe_lokasi'] ?></td>
                <td>
                <div>
                <a href="<?= base_url('admin/lokasi_presensi/detail/'). $lok['id'] ?>" 
                 class="badge bg-success" 
                style="display: block; min-width: 120px; padding: 12px 0; text-align: center; margin-bottom: 8px; border-radius: 8px;">
                    Detail
                    </a>        

                <a href="<?= base_url('admin/lokasi_presensi/edit/'). $lok['id'] ?>" 
                    class="badge bg-warning" 
                    style="display: block; min-width: 120px; padding: 12px 0; text-align: center; margin-bottom: 8px; border-radius: 8px;">
                 Edit
                    </a>

            <a href="<?= base_url('admin/lokasi_presensi/delete/'). $lok['id'] ?>" 
                    class="badge bg-danger tombol-hapus" 
             style="display: block; min-width: 120px; padding: 12px 0; text-align: center; border-radius: 8px;">
             Hapus
            </a>
                </div>
                </td>
            </tr>
        <?php endforeach ;?>
        </tbody>
</table>

<?= $this->endSection() ?>