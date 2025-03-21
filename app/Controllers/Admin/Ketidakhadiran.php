<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
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
    
        session()->setFlashData('berhasil', 'Pengajuan ketidakhadiran berhasil disetujui');
    
        return redirect()->to(base_url('admin/ketidakhadiran'));
    }

    public function tolak($id)
    {
        $ketidakhadiranModel = new KetidakhadiranModel();
    
        $ketidakhadiranModel->update($id, [
            'status' => 'Ditolak',
        ]);
    
        session()->setFlashData('gagal', 'Pengajuan ketidakhadiran telah ditolak');
    
        return redirect()->to(base_url('admin/ketidakhadiran'));
    }

    function delete($id)
    {
        $ketidakhadiranModel = new KetidakhadiranModel();
        $ketidakhadiran = $ketidakhadiranModel->find($id);
        if ($ketidakhadiran) {
            $ketidakhadiranModel->where('id_pegawai', $id)->delete();
            $ketidakhadiranModel->delete($id);
            session()->setFlashData('berhasil', 'Data ketidakhadiran berhasil dihapus');
        }
        return redirect()->to(base_url('admin/ketidakhadiran'));
    }
}
