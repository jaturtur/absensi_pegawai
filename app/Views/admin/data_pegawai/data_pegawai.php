<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<a href="<?=base_url('admin/data_pegawai/create')?>" class="btn btn-primary">Tambah Data</a>
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
                             class="badge bg-success" 
                             style="display: inline-block; min-width: 90px; padding: 10px 0; text-align: center;">
                                    Detail
                            </a>

                            <a href="<?= base_url('admin/data_pegawai/edit/'). $peg['id'] ?>" 
                                     class="badge bg-warning" 
                                     style="display: inline-block; min-width: 90px; padding: 10px 0; text-align: center;">
                                      Edit
                                </a>

                            <a href="<?= base_url('admin/data_pegawai/delete/'). $peg['id'] ?>" 
                                     class="badge bg-danger tombol-hapus" 
                                    style="display: inline-block; min-width: 90px; padding: 10px 0; text-align: center;">
                                     Hapus
                            </a>
                </div>
                </td>
            </tr>
        <?php endforeach ;?>
        </tbody>
</table>

<?= $this->endSection() ?>