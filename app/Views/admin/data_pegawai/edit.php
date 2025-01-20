<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<div class="card col-md-6">
    <div class="card-body">
    <form action="<?= base_url('admin/lokasi_presensi/update/'.$lokasi_presensi['id']) ?>" method="post">

      <div class="input-style-1">
         <label>Nama Lokasi</label>
           <input type="text" value="<?= $lokasi_presensi['nama_lokasi'] ?>" class="form-control <?= ($validation->hasError('nama_lokasi')) ? 'is-invalid' : '' ?>" name="nama_lokasi" placeholder="Nama Lokasi" />
           <div class="invalid-feedback"><?= $validation->getError('nama_lokasi') ?></div>
          </div>

          <div class="input-style-1">
         <label>Alamat Lokasi</label>
           <textarea name="alamat_lokasi" class="form-control <?= ($validation->hasError('alamat_lokasi')) ? 'is-invalid' : '' ?>" cols="30" rows="5" placeholder="Alamat Lokasi"><?= $lokasi_presensi['alamat_lokasi'] ?></textarea>
           <div class="invalid-feedback"><?= $validation->getError('alamat_lokasi') ?></div>
          </div>

          <div class="input-style-1">
         <label>Tipe Lokasi</label>
           <input type="text"value="<?= $lokasi_presensi['tipe_lokasi'] ?>" class="form-control <?= ($validation->hasError('tipe_lokasi')) ? 'is-invalid' : '' ?>" name="tipe_lokasi" placeholder="Tipe Lokasi" />
           <div class="invalid-feedback"><?= $validation->getError('tipe_lokasi') ?></div>
          </div>

          <div class="input-style-1">
         <label>Latitude</label>
           <input type="text" value="<?= $lokasi_presensi['latitude'] ?>" class="form-control <?= ($validation->hasError('latitude')) ? 'is-invalid' : '' ?>" name="latitude" placeholder="Latitude" />
           <div class="invalid-feedback"><?= $validation->getError('latitude') ?></div>
          </div>

          <div class="input-style-1">
         <label>Longitude</label>
           <input type="text" value="<?= $lokasi_presensi['longitude'] ?>" class="form-control <?= ($validation->hasError('longitude')) ? 'is-invalid' : '' ?>" name="longitude" placeholder="Longitude" />
           <div class="invalid-feedback"><?= $validation->getError('longitude') ?></div>
          </div>

          <div class="input-style-1">
         <label>Radius</label>
           <input type="number" value="<?= $lokasi_presensi['radius'] ?>" class="form-control <?= ($validation->hasError('radius')) ? 'is-invalid' : '' ?>" name="radius" placeholder="Radius" />
           <div class="invalid-feedback"><?= $validation->getError('radius') ?></div>
          </div>

          <div class="input-style-1">
         <label>Zona Waktu</label>
          <select name="zona_waktu" class="form-control <?= ($validation->hasError('zona_waktu')) ? 'is-invalid' : '' ?>">
          <option value="">---Pilih Zona Waktu---</option>
            <option <?php if ($lokasi_presensi['zona_waktu'] == 'WIB') {
                       echo 'selected';
                    } ?> value="WIB">WIB</option>
                   <option <?php if ($lokasi_presensi['zona_waktu'] == 'WITA') {
                  echo 'selected';
                 } ?> value="WITA">WITA</option>
                 <option <?php if ($lokasi_presensi['zona_waktu'] == 'WIT') {
                 echo 'selected';
                  } ?> value="WIT">WIT</option>
           </select>
           <div class="invalid-feedback"><?= $validation->getError('zona_waktu') ?></div>
          </div>

          <div class="input-style-1">
         <label>Jam Masuk</label>
           <input type="time" value="<?= $lokasi_presensi['jam_masuk'] ?>" class="form-control <?= ($validation->hasError('jam_masuk')) ? 'is-invalid' : '' ?>" name="jam_masuk" placeholder="Jam Masuk" />
           <div class="invalid-feedback"><?= $validation->getError('jam_masuk') ?></div>
          </div>

          <div class="input-style-1">
         <label>Jam Pulang</label>
           <input type="time" value="<?= $lokasi_presensi['jam_keluar'] ?>" class="form-control <?= ($validation->hasError('jam_keluar')) ? 'is-invalid' : '' ?>" name="jam_keluar" placeholder="Jam Pulang" />
           <div class="invalid-feedback"><?= $validation->getError('jam_keluar') ?></div>
          </div>

          <button type="submit" class="btn btn-primary btn-sm">Update</button>
         </div>
      </form>
     </div>
    </div>


<?= $this->endSection() ?>
