<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\LokasiPresensiModel;
use App\Models\PegawaiModel;

class Home extends BaseController
{
    public function index()
    {
        $lokasi_presensi = new LokasiPresensiModel();
        $pegawai_model = new PegawaiModel();
        $id_pegawai = session() -> get('id_pegawai');
        $pegawai = $pegawai_model -> where('id', $id_pegawai) -> first();
        $data = [
            'title' => 'Home',
            'lokasi_presensi'=> $lokasi_presensi->where('id', $pegawai ['lokasi_presensi']) -> first()
        ];
        return view('pegawai/home', $data);
    }

    public function presensi_masuk()
    {
        $latitude_pegawai = (float) $this->request->getPost('latitude_pegawai');
        $latitude_kantor = (float) $this->request->getPost('latitude_kantor');
        $radius = $this->request->getPost('radius');

        $jarak = sin(deg2rad($latitude_pegawai)) * sin(deg2rad($latitude_kantor)) + cos(deg2rad($latitude_pegawai)) * cos(deg2rad($latitude_kantor));
        $jarak = acos($jarak);
        $jarak = rad2deg($jarak);
        $mil = $jarak * 60 * 1.1515;
        $km = $mil * 1.609344;
        $jarak_meter = floor($km * 1000);

        if ($jarak_meter > $radius) {
            session()->setFlashdata('gagal', 'Presensi gagal, Lokasi Anda berada di luar radius kantor');
            return redirect()->to(base_url('pegawai/home'));
        } else {
            $data = [
                'title' => "Ambil Foto Selfie",
                'id_pegawai' => $this->request->getPost('id_pegawai'),
                'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
                'jam_masuk' => $this->request->getPost('jam_masuk'),
            ];
            return view('pegawai/ambil_foto', $data);
        }
    
    }
}
