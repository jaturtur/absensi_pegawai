<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use App\Models\KetidakhadiranModel;
use CodeIgniter\HTTP\ResponseInterface;

class Ketidakhadiran extends BaseController
{

    function __construct()
    {
    helper(['url', 'form']);
    }

    public function index()
    {
        $ketidakhadiranModel = new KetidakhadiranModel();
        $id_pegawai = session()->get('id_pegawai');
        $data = [
            'title' => "Ketidakhadiran",
            'ketidakhadiran' => $ketidakhadiranModel->where('id_pegawai', $id_pegawai)->findAll()
        ];
    
        return view('pegawai/ketidakhadiran', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Ajukan Ketidakhadiran',
            'validation' => \Config\Services::validation()
        ];
        
        return view('pegawai/create_ketidakhadiran', $data);
    }

    public function store()
    {
        $rules = [
             'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Keterangan wajib diisi"
                ],
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Tanggal wajib diisi"
                ],
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Deskripsi wajib diisi"
                ],
            ],
          'file' => [
             'rules' => 'uploaded[file]|max_size[file,10240]|mime_in[file,image/png,image/jpeg,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]',
                'errors' => [
                 'uploaded' => "File wajib diupload",
                 'max_size' => "Ukuran file melebihi 10MB",
                  'mime_in' => "Jenis file yang diizinkan hanya PNG, JPEG atau PDF/DOC",
                  ],
                ],
        ];

        if (!$this->validate($rules)) {

            $data = [
                'title' => 'Ajukan Ketidakhadiran',
                'validation' => \Config\Services::validation()
            ];
            
            return view('pegawai/create_ketidakhadiran', $data);
        } else {

           $ketidakhadiranModel = new KetidakhadiranModel();

           $file = $this->request->getFile('file');

           if ($file->getError() == 4) {
            $nama_file = '';
             } else {
                  $nama_file = $file->getRandomName();
                  $file->move('file_ketidakhadiran', $nama_file);
             }

          
          
             $ketidakhadiranModel->insert([
            'keterangan' => $this->request->getPost('keterangan'),
            'tanggal' => $this->request->getPost('tanggal'),
            'id_pegawai' => $this->request->getPost('id_pegawai'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'status' => 'pending',
            'file' => $nama_file,
            ]);

            session()->setFlashdata('berhasil', 'Ketidakhadiran berhasil diajukan');

            return redirect()->to(base_url('pegawai/ketidakhadiran'));
        }
    }

}
