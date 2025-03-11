<?= $this->extend('pegawai/layout.php') ?>

<?= $this->section('content') ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js" 
integrity="sha512-dQIiHSl2hr3NWKKLycPndtpbh5iaHLo6MwrXm7F0FM5e+kL2U16oE9uIwPHUl6fQBeCthiEuV/rzP3MiAB8Vfw==" 
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<input type="hidden" id="tanggal_keluar" name="tanggal_keluar" value="<?= $tanggal_keluar ?>">
<input type="hidden" id="jam_keluar" name="jam_keluar" value="<?= $jam_keluar ?>">

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
        border: 5px solid #dc3545;
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
        color: #dc3545;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .camera-title i {
        font-size: 24px;
        color: #dc3545;
    }

    video {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    #ambil-foto-keluar {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 20px auto;
        font-size: 16px;
        font-weight: bold;
        padding: 10px 20px;
        border: none;
        background-color: #dc3545;
        color: white;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
        gap: 10px;
    }

    #ambil-foto-keluar:hover {
        background-color: #b02a37;
    }

    #ambil-foto-keluar i {
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
<button class="btn btn-danger mt-2" id="ambil-foto-keluar">
    <i class="fas fa-sign-out-alt"></i> Pulang
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

    document.getElementById('ambil-foto-keluar').addEventListener('click', function() {
        let tanggal_keluar = document.getElementById('tanggal_keluar').value;
        let jam_keluar = document.getElementById('jam_keluar').value;

        Webcam.snap(function(data_uri) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                document.getElementById('my_result').innerHTML = '<img src="' + data_uri + '" />';
                if (xhttp.readyState === 4 && xhttp.status === 200) {
                    window.location.href = '<?= base_url('pegawai/home') ?>';
                }
            };
            xhttp.open("POST", "<?= base_url('pegawai/presensi_keluar_aksi/' . $id_presensi) ?>", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(
                'foto_keluar=' + encodeURIComponent(data_uri) +
                '&tanggal_keluar=' + tanggal_keluar +
                '&jam_keluar=' + jam_keluar
            );
        });
    });
</script>

<?= $this->endSection() ?>
