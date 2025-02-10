<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KetidakhadiranModel;

class Ketidakhadiran extends BaseController
{
    public function index()
    {
        $ketidakhadiranModel = new KetidakhadiranModel();
        $data = [
            'title' => "Ketidakhadiran",
            'ketidakhadiran' => $ketidakhadiranModel->findAll()
        ];
    
        return view('admin/ketidakhadiran', $data);
    }

    public function setuju($id)
    {
        $ketidakhadiranModel = new KetidakhadiranModel();
    
        $ketidakhadiranModel->update($id, [
            'status' => 'Setuju',
        ]);
    
        session()->setFlashData('berhasil', 'Pengajuan ketidakhadiran berhasil di setujui');
    
        return redirect()->to(base_url('admin/ketidakhadiran'));
    }

}
