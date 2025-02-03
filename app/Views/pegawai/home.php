<?= $this->extend('pegawai/layout.php') ?>

<?= $this->section('content') ?>

<style>
  .parent-clock {
    display: grid;
    grid-template-columns: auto auto auto auto auto;
    font-size: 35px;
    font-weight: bold;
    justify-content: center;
  }

  .icon-large {
        font-size: 100px; /* Perbesar ikon */
        display: block; /* Membuat ikon berada di satu baris penuh */
        margin: 0 auto 10px; /* Tengah & beri jarak bawah */
    }

    #map {
      height: 500px;
      width: 700px;
      margin: auto;
  }
</style>

<div class="row mb-3">
  <div class="col-md-2"></div>
  <div class="col-md-4">
    <div class="card h-100">
      <div class="card-header">Presensi Masuk</div>
      <?php if($cek_presensi < 1) : ?>
      <div class="card-body text-center">
      <div class="fw-bold"><?= date('d F Y') ?></div>
      <div class="parent-clock">
        <div id="jam-masuk"></div>
        <div>:</div>
        <div id="menit-masuk"></div>
        <div>:</div>
        <div id="detik-masuk"></div>
      </div>
      <form method="POST" action="<?= base_url('pegawai/presensi_masuk') ?>">
      <?php
        if($lokasi_presensi['zona_waktu'] == 'WIB'){
         date_default_timezone_set('Asia/Jakarta');
        }elseif($lokasi_presensi['zona_waktu'] == 'WITA'){
        date_default_timezone_set('Asia/Makassar');
        }elseif($lokasi_presensi['zona_waktu'] == 'WIT'){
          date_default_timezone_set('Asia/Jayapura');}
        ?>
      
        <input type="hidden" name="latitude_kantor" value="<?= $lokasi_presensi['latitude'] ?>">
        <input type="hidden" name="longitude_kantor" value="<?= $lokasi_presensi['longitude'] ?>">
        <input type="hidden" name="radius" value="<?= $lokasi_presensi['radius']?>" />

        <input type="hidden" name="latitude_pegawai" id="latitude_pegawai">
        <input type="hidden" name="longitude_pegawai" id="longitude_pegawai">

        <input type="hidden" name="tanggal_masuk" value="<?= date('Y-m-d') ?>">
        <input type="hidden" name="jam_masuk" value="<?= date('H:i:s') ?>">
        <input type="hidden" name="id_pegawai" value="<?= session()->get('id_pegawai') ?>">
        <button class="btn btn-primary mt-3">Masuk</button>
    </form>
     </div>
     <?php else : ?>
      <div class="card-body text-center">
        <i class="lni lni-checkmark-circle text-success icon-large"></i>
        <h5>Anda telah melakukan absen masuk</h5>
  </div>
      <?php endif; ?>
    </div>
  </div>
  <div class="col-md-4"><div class="card h-100">
      <div class="card-header">Presensi Keluar</div>
      <?php if ($cek_presensi < 1) : ?>
        <div class="card-body text-center">
        <i class="lni lni-cross-circle text-danger icon-large"></i>
        <h5>Anda belum melakukan absen masuk</h5>
  </div>
  <?php elseif ($cek_presensi_keluar > 0) : ?>
<div class="card-body text-center">
<i class="lni lni-checkmark-circle text-success icon-large"></i>
  <h5 class="text-center">Anda telah melakukan absen pulang</h5>
</div>
<?php else : ?>
<div class="card-body text-center">
      <div class="fw-bold"><?= date('d F Y') ?></div>
      <div class="parent-clock">
        <div id="jam-keluar"></div>
        <div>:</div>
        <div id="menit-keluar"></div>
        <div>:</div>
        <div id="detik-keluar"></div>
       </div>
      <form method="POST" action="<?= base_url('pegawai/presensi_keluar/'.''.$ambil_presensi_masuk['id']) ?>">
      <?php
        if($lokasi_presensi['zona_waktu'] == 'WIB'){
         date_default_timezone_set('Asia/Jakarta');
        }elseif($lokasi_presensi['zona_waktu'] == 'WITA'){
        date_default_timezone_set('Asia/Makassar');
        }elseif($lokasi_presensi['zona_waktu'] == 'WIT'){
          date_default_timezone_set('Asia/Jayapura');}
        ?>
      
        <input type="hidden" name="latitude_kantor" value="<?= $lokasi_presensi['latitude'] ?>">
        <input type="hidden" name="longitude_kantor" value="<?= $lokasi_presensi['longitude'] ?>">
        <input type="hidden" name="radius" value="<?= $lokasi_presensi['radius']?>" />

        <input type="hidden" name="latitude_pegawai" id="latitude_pegawai">
        <input type="hidden" name="longitude_pegawai" id="longitude_pegawai">

        <input type="hidden" name="tanggal_keluar" value="<?= date('Y-m-d') ?>">
        <input type="hidden" name="jam_keluar" value="<?= date('H:i:s') ?>">
        <button class="btn btn-danger mt-3">Keluar</button>
      </form>
     </div>
    </div>

<?php endif; ?>
</div>
  <div class="col-md-2"></div>
</div>

<div id="map">

</div>

<script>
  window.setInterval("waktuMasuk()", 1000)

  function waktuMasuk (){
  const waktu = new Date();
  document.getElementById("jam-masuk").innerHTML =formatWaktu(waktu.getHours());
  document.getElementById("menit-masuk").innerHTML = formatWaktu(waktu.getMinutes());
  document.getElementById("detik-masuk").innerHTML = formatWaktu(waktu.getSeconds());

  }

  window.setInterval("waktuKeluar()", 1000)

  function waktuKeluar(){
  const waktu = new Date();
  document.getElementById("jam-keluar").innerHTML =formatWaktu(waktu.getHours());
  document.getElementById("menit-keluar").innerHTML = formatWaktu(waktu.getMinutes());
  document.getElementById("detik-keluar").innerHTML = formatWaktu(waktu.getSeconds());

  }
  function formatWaktu(waktu) {
  if (waktu < 10) {
    return "0" + waktu;
  } else {
    return waktu;
  }
}

getLocation();
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    alert("Browser Anda tidak mendukung Geolocation");
  }
}

function showPosition(position) {
  var latitude_pegawai = position.coords.latitude;
  var longitude_pegawai = position.coords.longitude;

  document.getElementById('latitude_pegawai').value = latitude_pegawai;
  document.getElementById('longitude_pegawai').value = longitude_pegawai;

  initMap(latitude_pegawai, longitude_pegawai)
  
}


function initMap(latitude_pegawai, longitude_pegawai){
  var map = L.map('map').setView([<?= $lokasi_presensi['latitude'] ?>, <?= $lokasi_presensi['longitude'] ?>], 13);

  L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
  maxZoom: 19,
  attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
  }).addTo(map);

  var marker = L.marker([<?= $lokasi_presensi['latitude'] ?>, <?= $lokasi_presensi['longitude'] ?>]).addTo(map);
  var circle = L.circle([latitude_pegawai, longitude_pegawai], {
  color: 'red',
  fillColor: '#f03',
  fillOpacity: 0.5,
  radius: 300
  }).addTo(map);

  var greenIcon = L.icon({
    iconUrl: '<?= base_url('assets/images/icon.png') ?>',
  

    iconSize:     [38, 95], // size of the icon
    shadowSize:   [50, 64], // size of the shadow
    iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
    shadowAnchor: [4, 62],  // the same for the shadow
    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
  });
  L.marker([<?= $lokasi_presensi['latitude'] ?>, <?= $lokasi_presensi['longitude'] ?>], {icon: greenIcon}).addTo(map);

  circle.bindPopup("Lokasi Anda Saat Ini");
}
 
</script>
<?= $this->endSection() ?>