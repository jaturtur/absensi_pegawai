<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<a href="<?=base_url('admin/lokasi_presensi/create')?>" class="btn btn-primary">Tambah Data</a>
<table class="table table-striped" id="datatables">
    <thead>
        <tr>
        <th class="text-center">No</th>
        <th class="text-center">Nama Lokasi</th>
        <th class="text-center">Alamat Lokasi</th>
        <th class="text-center">Tipe Lokasi</th>
        <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php $no = 1;
    foreach ($lokasi_presensi as $lok) :?>
      
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td class="text-center"><?= $lok ['nama_lokasi'] ?></td>
                <td class="text-center"><?= $lok ['alamat_lokasi'] ?></td>
                <td class="text-center"><?= $lok ['tipe_lokasi'] ?></td>
                <td class="text-center">
    <div class="d-flex justify-content-center gap-2">
        <a href="<?= base_url('admin/lokasi_presensi/detail/'). $lok['id'] ?>" 
            class="btn btn-success btn-sm" 
            style="padding: 6px 10px; border-radius: 6px;">
            <i class="fas fa-eye"></i>
        </a>        
        <a href="<?= base_url('admin/lokasi_presensi/edit/'). $lok['id'] ?>" 
            class="btn btn-warning btn-sm" 
            style="padding: 6px 10px; border-radius: 6px;">
            <i class="fas fa-edit"></i>
        </a>
        <a href="<?= base_url('admin/lokasi_presensi/delete/'). $lok['id'] ?>" 
            class="btn btn-danger btn-sm tombol-hapus" 
            style="padding: 6px 10px; border-radius: 6px;">
            <i class="fas fa-trash"></i>
        </a>
    </div>
</td>
            </tr>
        <?php endforeach ;?>
        </tbody>
</table>

<?= $this->endSection() ?>