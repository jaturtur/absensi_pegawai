<?= $this->extend('pegawai/layout.php') ?>

<?= $this->section('content') ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js" 
integrity="sha512-dQIiHSl2hr3NWKKLycPndtpbh5iaHLo6MwrXm7F0FM5e+kL2U16oE9uIwPHUl6fQBeCthiEuV/rzP3MiAB8Vfw=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<style>
    #camera-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-top: 20px;
    }

    #my_camera {
        border: 3px solid #8B0000;
        border-radius: 10px;
        width: 400px; /* Atur lebar */
        height: 300px; /* Atur tinggi */
        overflow: hidden; /* Pastikan tidak ada elemen yang keluar */
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: white;
    }

    #ambil-foto-keluar {
        margin-top: 10px;
        background-color: #8B0000;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
    }

    #ambil-foto-keluar:hover {
        background-color: #600000;
    }

    .title {
        font-size: 20px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 10px;
        color: #333;
    }
</style>

<input type="hidden" id="tanggal_keluar" name="tanggal_keluar" value="<?= $tanggal_keluar ?>">
<input type="hidden" id="jam_keluar" name="jam_keluar" value="<?= $jam_keluar ?>">

<div id="camera-container">
    <div class="title">📸 Silahkan Ambil Foto</div>
    <div id="my_camera"></div>
    <button id="ambil-foto-keluar">Keluar</button>
</div>

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
            
            // Memperbaiki kesalahan spasi pada pengiriman data
            xhttp.open("POST", "<?= base_url('pegawai/presensi_keluar_aksi/' . $id_presensi) ?>", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(
                'foto_keluar=' + encodeURIComponent(data_uri) +
                 '&tanggal_keluar=' + tanggal_keluar +
                 '&jam_keluar=' + jam_keluar 
        );

       
        })
    });
</script>

<?= $this->endSection() ?>