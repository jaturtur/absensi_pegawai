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
        border: 3px solid #dc3545;
        border-radius: 10px;
        padding: 10px;
        background: #f8f9fa;
        overflow: hidden;
        width: 400px;
        height: 300px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .camera-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    video {
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    #ambil-foto-keluar {
        display: block;
        margin: 20px auto;
        font-size: 16px;
        font-weight: bold;
        padding: 10px 20px;
        border: none;
        background-color: #dc3545;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    #ambil-foto-keluar:hover {
        background-color: #b02a37;
    }
</style>

<div class="camera-container">
    <div class="camera-title">📷 Silahkan Ambil Foto</div>
    <div class="camera-box">
        <div id="my_camera"></div>
    </div>
</div>
<div style="display: none;" id="my_result"></div>
<button class="btn btn-danger mt-2" id="ambil-foto-keluar">Pulang</button>

<script>
    Webcam.set({
        width: 320,
        height: 240,
        dest_width: 320,
        dest_height: 240,
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
