<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<a href="<?= base_url('admin/jabatan/create') ?>" class="btn btn-primary">
    <i class="fas fa-plus"></i>
    Tambah
</a>
<table class="table table-striped" id="datatables">
    <thead>
        <tr>
            <td class="text-center">No</td>
            <td class="text-center">Nama Jabatan</td>
            <td class="text-center">Aksi</td>
        </tr>
    </thead>
    <tbody>
    <?php $no = 1;
    foreach ($jabatan as $jab) :?>
      
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td class="text-center"><?= $jab['jabatan']?></td>
                <td class="text-center">
             <div>
             <a href="<?= base_url('admin/jabatan/edit/'). $jab['id'] ?>" 
                class="btn btn-warning btn-sm" 
                style="padding: 6px 10px;">
                <i class="fas fa-edit"></i>
            </a>
        <a href="<?= base_url('admin/jabatan/delete/'). $jab['id'] ?>" 
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