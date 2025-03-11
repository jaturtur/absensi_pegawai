<?= $this->extend('pegawai/layout.php') ?>

<?= $this->section('content') ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js" 
integrity="sha512-dQIiHSl2hr3NWKKLycPndtpbh5iaHLo6MwrXm7F0FM5e+kL2U16oE9uIwPHUl6fQBeCthiEuV/rzP3MiAB8Vfw==" 
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<input type="hidden" id="id_pegawai" name="id_pegawai" value="<?= $id_pegawai ?>">
<input type="hidden" id="tanggal_masuk" name="tanggal_masuk" value="<?= $tanggal_masuk ?>">
<input type="hidden" id="jam_masuk" name="jam_masuk" value="<?= $jam_masuk ?>">

<!-- Tambahan Style -->
<style>
    .camera-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        margin-top: 20px;
    }

    .camera-box {
        border: 5px solid #007bff;
        border-radius: 15px;
        padding: 0;
        background: #f8f9fa;
        overflow: hidden;
        width: 400px;
        height: 300px;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }

    .camera-title {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #007bff;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .camera-title i {
        font-size: 24px;
        color: #007bff;
    }

    video {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    #ambil-foto {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 20px auto;
        font-size: 16px;
        font-weight: bold;
        padding: 10px 20px;
        border: none;
        background-color: #007bff;
        color: white;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
        gap: 10px;
    }

    #ambil-foto:hover {
        background-color: #0056b3;
    }

    #ambil-foto i {
        font-size: 18px;
    }
</style>

<div class="camera-container">
    <div class="camera-title">
        <i class="fas fa-camera"></i> Silahkan Ambil Foto
    </div>
    <div class="camera-box">
        <div id="my_camera"></div>
    </div>
</div>
<div style="display: none;" id="my_result"></div>
<button class="btn btn-primary mt-2" id="ambil-foto">
    <i class="fas fa-sign-in-alt"></i> Masuk
</button>

<script>
    Webcam.set({
        width: 400,
        height: 300,
        dest_width: 400,
        dest_height: 300,
        image_format: 'jpeg',
        jpeg_quality: 90,
        force_flash: false
    });

    Webcam.attach('#my_camera');

    document.getElementById('ambil-foto').addEventListener('click', function() {
        let id = document.getElementById('id_pegawai').value;
        let tanggal_masuk = document.getElementById('tanggal_masuk').value;
        let jam_masuk = document.getElementById('jam_masuk').value;

        Webcam.snap(function(data_uri) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                document.getElementById('my_result').innerHTML = '<img src="' + data_uri + '" />';
                if (xhttp.readyState === 4 && xhttp.status === 200) {
                    window.location.href = '<?= base_url('pegawai/home') ?>';
                }
            };      
            xhttp.open("POST", "<?= base_url('pegawai/presensi_masuk_aksi') ?>", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(
                'foto_masuk=' + encodeURIComponent(data_uri) +
                '&id_pegawai=' + id +
                '&tanggal_masuk=' + tanggal_masuk +
                '&jam_masuk=' + jam_masuk
            );
        });
    });
</script>

<?= $this->endSection() ?>
