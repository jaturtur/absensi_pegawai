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
            'status' => 'Menunggu',
            'file' => $nama_file,
            ]);

            session()->setFlashdata('berhasil', 'Ketidakhadiran berhasil diajukan');

            return redirect()->to(base_url('pegawai/ketidakhadiran'));
        }
    }
 
    public function edit($id)
    {
    $ketidakhadiranModel = new KetidakhadiranModel();
    $data = [
        'title' => 'Edit Ketidakhadiran',
        'ketidakhadiran' => $ketidakhadiranModel->find($id),
        'validation' => \Config\Services::validation()
    ];
    return view('pegawai/edit_ketidakhadiran', $data);
}

public function update($id)
{
    $ketidakhadiranModel = new KetidakhadiranModel();
    
    $rules = [
        'keterangan' => [
            'rules' => 'max_length[255]', 
            'errors' => [
                'max_length' => "Keterangan maksimal 255 karakter"
            ],
        ],
        'tanggal' => [
            'rules' => 'valid_date', 
            'errors' => [
                'valid_date' => "Tanggal tidak valid"
            ],
        ],
        'deskripsi' => [
            'rules' => 'required',
            'errors' => [
                'required' => "Deskripsi wajib diisi"
            ],
        ],
        'file' => [
            'rules' => 'max_size[file,5120]|mime_in[file,image/png,image/jpeg,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]|ext_in[file,png,jpg,jpeg,pdf,doc,docx]',
            'errors' => [
            'max_size' => "Ukuran file melebihi 5MB",
            'mime_in' => "Jenis file yang diizinkan hanya PNG, JPEG, PDF, atau DOC",
            'ext_in' => "Format file tidak diizinkan",
            ],
        ],

    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('error', \Config\Services::validation()->listErrors());
    }

    $file = $this->request->getFile('file');

    // Cek apakah ada file yang diunggah
    if ($file && $file->isValid() && !$file->hasMoved()) {
        $allowedExtensions = ['png', 'jpg', 'jpeg', 'pdf', 'doc', 'docx'];
        if (!in_array($file->getExtension(), $allowedExtensions)) {
            return redirect()->back()->withInput()->with('error', 'Format file tidak diizinkan');
        }

        $nama_file = $file->getRandomName();
        $file->move('file_ketidakhadiran', $nama_file);
    } else {
        $nama_file = $this->request->getPost('file_lama');
    }

    $ketidakhadiranModel->update($id, [
        'keterangan' => $this->request->getPost('keterangan'),
        'tanggal' => $this->request->getPost('tanggal'),
        'deskripsi' => $this->request->getPost('deskripsi'),
        'status' => 'Menunggu',
        'file' => $nama_file,
    ]);

    session()->setFlashdata('berhasil', 'Data ketidakhadiran berhasil diupdate');
    return redirect()->to(base_url('pegawai/ketidakhadiran'));
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
        return redirect()->to(base_url('pegawai/ketidakhadiran'));
    }

}
