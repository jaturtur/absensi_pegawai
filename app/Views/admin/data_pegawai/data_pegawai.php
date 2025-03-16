<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<a href="<?= base_url('admin/data_pegawai/create') ?>" class="btn btn-primary">
    <i class="fas fa-plus"></i>
    Tambah
</a>
<table class="table table-striped" id="datatables">
    <thead>
        <tr>
        <th class="text-center">No</th>
        <th class="text-center">NIP</th>
        <th class="text-center">Nama</th>
        <th class="text-center">Jabatan</th>
        <th class="text-center">Lokasi Presensi</th>
        <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php $no = 1;
    foreach ($pegawai as $peg) :?>
      
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td class="text-center"><?= $peg['nip'] ?></td>
                <td class="text-center"><?= $peg['nama'] ?></td>
                <td class="text-center"><?= $peg['jabatan'] ?></td>
                <td class="text-center"><?= $peg['nama_lokasi'] ?></td>
                <td class="text-center">
    <div>
        <a href="<?= base_url('admin/data_pegawai/detail/'). $peg['id'] ?>" 
            class="btn btn-success btn-sm" 
            style="padding: 6px 10px;">
            <i class="fas fa-eye"></i>
        </a>

        <a href="<?= base_url('admin/data_pegawai/edit/'). $peg['id'] ?>" 
            class="btn btn-warning btn-sm" 
            style="padding: 6px 10px;">
            <i class="fas fa-edit"></i>
        </a>

        <a href="<?= base_url('admin/data_pegawai/delete/'). $peg['id'] ?>" 
            class="btn btn-danger btn-sm tombol-hapus" 
            style="padding: 6px 10px;">
            <i class="fas fa-trash"></i>
        </a>
    </div>
</td>

            </tr>
        <?php endforeach ;?>
        </tbody>
</table>

<?= $this->endSection() ?>