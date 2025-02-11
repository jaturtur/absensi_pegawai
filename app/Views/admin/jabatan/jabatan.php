<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<a href="<?=base_url('admin/jabatan/create')?>" class="btn btn-primary">Tambah Data</a>
<table class="table table-striped" id="datatables">
    <thead>
        <tr>
            <td>No</td>
            <td>Nama Jabatan</td>
            <td>Aksi</td>
        </tr>
    </thead>
    <tbody>
    <?php $no = 1;
    foreach ($jabatan as $jab) :?>
      
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $jab ['jabatan'] ?></td>
                <td>
                <div>
                <a href="<?= base_url('admin/jabatan/edit/'). $jab['id'] ?>" 
                 class="badge bg-warning" 
                 style="display: inline-block; min-width: 90px; padding: 10px 0; text-align: center;">
                     Edit</a>
                <a href="<?= base_url('admin/jabatan/delete/'). $jab['id'] ?>" 
                  class="badge bg-danger tombol-hapus" 
                 style="display: inline-block; min-width: 90px; padding: 10px 0; text-align: center;"> Hapus</a>
                </div>
                </td>
            </tr>
        <?php endforeach ;?>
        </tbody>
</table>

<?= $this->endSection() ?>