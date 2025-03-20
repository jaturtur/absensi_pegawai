<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<div class="card col-md-6">
    <div class="card-body">
    <form method="POST" action="<?= base_url('admin/data_pegawai/update/'.$pegawai['id']) ?>" enctype="multipart/form-data">
    <?= csrf_field() ?>

     <div class="input-style-1">
       <label>Nama</label>
       <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>" name="nama" placeholder="Nama" value="<?= $pegawai['nama'] ?>" />
       <div class="invalid-feedback"><?= $validation->getError('nama') ?></div>
      </div>

      <div class="input-style-1">
    <label>Jenis Kelamin</label>
    <select name="jenis_kelamin" class="form-control <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : '' ?>">
        <option value="">--Pilih Jenis Kelamin--</option>
        <option <?php if ($pegawai['jenis_kelamin'] == 'Laki-laki') {
            echo 'selected';
        } ?> value="Laki-laki">Laki-laki</option>
        <option <?php if ($pegawai['jenis_kelamin'] == 'Perempuan') {
            echo 'selected';
        } ?> value="Perempuan">Perempuan</option>
    </select>
    <div class="invalid-feedback"><?= $validation->getError('jenis_kelamin') ?></div>
</div>

          <div class="input-style-1">
         <label>Alamat</label>
           <textarea name="alamat" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : '' ?>" cols="30" rows="5" placeholder="Alamat" ><?= $pegawai['alamat'] ?></textarea>
           <div class="invalid-feedback"><?= $validation->getError('alamat') ?></div>
          </div>

          <div class="input-style-1">
         <label>No. Handphone</label>
           <input type="number" class="form-control <?= ($validation->hasError('no_handphone')) ? 'is-invalid' : '' ?>" name="no_handphone" placeholder="No Handphone" value="<?= $pegawai['no_handphone'] ?>" />
           <div class="invalid-feedback"><?= $validation->getError('no_handphone') ?></div>
          </div>

          <div class="input-style-1">
            <label>Jabatan</label>
            <select name="jabatan" class="form-control <?= ($validation->hasError('jabatan')) ? 'is-invalid' : '' ?>">
                <option value="">--Pilih Jabatan--</option>
                <?php foreach ($jabatan as $jab) : ?>
                    <option value="<?=$jab['jabatan']?>" <?= ($pegawai['jabatan'] == $jab['jabatan']) ? 'selected' : '' ?>><?=$jab['jabatan']?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback"><?= $validation->getError('jabatan') ?></div>
          </div>

          <div class="input-style-1">
          <label>Lokasi Presensi</label>
           <select name="lokasi_presensi" class="form-control <?=($validation->hasError('lokasi_presensi')) ? 'is-invalid' : ''?>">
            <option value="">--Pilih Lokasi Presensi--</option>
            <?php foreach ($lokasi_presensi as $lok) : ?>
                <option value="<?=$lok['id']?>" <?= ($pegawai['lokasi_presensi'] == $lok['id']) ? 'selected' : '' ?>><?=$lok['nama_lokasi']?></option>
            <?php endforeach; ?>
           </select>
           <div class="invalid-feedback"><?=$validation->getError('lokasi_presensi')?></div>
          </div>

       <div class="input-style-1">
          <label>Foto</label>
          <input type="hidden" value="<?= $pegawai['foto'] ?>" name="foto_lama">
          <?php if ($pegawai['foto']) : ?>
            <img src="<?= base_url('profile/'.$pegawai['foto']) ?>" alt="Foto Pegawai" class="img-thumbnail mb-2" width="150">
          <?php endif; ?>
          <input type="file" class="form-control <?=($validation->hasError('foto')) ? 'is-invalid' : ''?>" name="foto" />
        <div class="invalid-feedback"><?=$validation->getError('foto')?></div>
      </div>

      <div class="input-style-1">
         <label>Username</label>
         <input type="text" class="form-control <?=($validation->hasError('username')) ? 'is-invalid' : ''?>" name="username" placeholder="username" value="<?= $pegawai['username'] ?>"  />
        <div class="invalid-feedback"><?=$validation->getError('username')?></div>
    </div>

    <div class="input-style-1">
         <label>Password</label>
         <input type="hidden" value="<?= $pegawai['password'] ?>" name="password_lama">
         <input type="password" class="form-control <?=($validation->hasError('password')) ? 'is-invalid' : ''?>" name="password" placeholder="Password" />
        <div class="invalid-feedback"><?=$validation->getError('password')?></div>
    </div>

    <div class="input-style-1">
         <label>Konfirmasi Password</label>
         <input type="password" class="form-control <?=($validation->hasError('konfirmasi_password')) ? 'is-invalid' : ''?>" name="konfirmasi_password" placeholder="Konfirmasi password" />
        <div class="invalid-feedback"><?=$validation->getError('konfirmasi_password')?></div>
    </div>

        <div class="input-style-1">
            <label>Role</label>
            <select name="role" class="form-control <?= ($validation->hasError('role')) ? 'is-invalid' : '' ?>">
              <option value="">--Pilih Jenis Kelamin--</option>
             <option <?php if ($pegawai['role'] == 'Admin') {
            echo 'selected';
            } ?> value="Admin">Admin</option>
          <option <?php if ($pegawai['role'] == 'Pegawai') {
            echo 'selected';
          } ?> value="Pegawai">Pegawai</option>
           </select>
            <div class="invalid-feedback"><?= $validation->getError('role') ?></div>
          </div>
        

          <button type="submit" class="btn btn-primary btn-sm">Update</button>
          <a href="<?= base_url('admin/data_pegawai') ?>"class="btn btn-secondary btn-sm">Kembali</a>
         </div>
      </form>
     </div>
    </div>


<?= $this->endSection() ?>
