<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PegawaiModel;
use App\Models\UserModel;

class DataPegawai extends BaseController
{
    public function index()
    {
       
       $pegawaiModel = new PegawaiModel();
        $data = [
            'title' => 'Data Pegawai',
            'pegawai' => $pegawaiModel->findAll(),
        ];

        return view('admin/data_pegawai/data_pegawai', $data);
    }

    public function detail($id)
    {
         $pegawaiModel = new PegawaiModel();
         $data = [
        'title' => 'Detail Lokasi Presensi',
        'pegawai' => $pegawaiModel->detailPegawai($id),
    ];
        
         return view('admin/data_pegawai/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Lokasi Presensi',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/lokasi_presensi/create', $data);
    }

    public function store()
    {
        $rules = [
             'nama_lokasi' => [
                'rules' => 'required|is_unique[lokasi_presensi.nama_lokasi]',
                'errors' => [
                    'required' => "Nama lokasi wajib diisi",
                     'is_unique' => 'Nama lokasi sudah terdaftar'
                ],
            ],
            'alamat_lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Alamat lokasi wajib diisi"
                ],
            ],
            'tipe_lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Tipe lokasi wajib diisi"
                ],
            ],
            'latitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Latitude wajib diisi"
                ],
            ],
            'longitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Longitude wajib diisi"
                ],
            ],
            'radius' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Radius wajib diisi"
                ],
            ],
            'zona_waktu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Zona waktu wajib diisi"
                ],
            ],
            'jam_masuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Jam masuk wajib diisi"
                ],
            ],
            'jam_keluar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Jam keluar wajib diisi"
                ],
            ],

        ];

        if (!$this->validate($rules)) {

            $data = [
                'title' => 'Tambah Lokasi Presensi',
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/lokasi_presensi/create', $data);

        } else {
           
           $pegawaiModel = new PegawaiModel();
           
           $pegawaiModel ->insert([
                'nama_lokasi' => $this->request->getPost('nama_lokasi'),
                'alamat_lokasi' => $this->request->getPost('alamat_lokasi'),
                'tipe_lokasi' => $this->request->getPost('tipe_lokasi'),
                'latitude' => $this->request->getPost('latitude'),
                'longitude' => $this->request->getPost('longitude'),
                'radius' => $this->request->getPost('radius'),
                'zona_waktu' => $this->request->getPost('zona_waktu'),
                'jam_masuk' => $this->request->getPost('jam_masuk'),
                'jam_keluar' => $this->request->getPost('jam_keluar')
            ]);

            session()->setFlashdata('berhasil', 'Data lokasi presensi berhasil tersimpan');

            return redirect()->to(base_url('admin/lokasi_presensi'));
        }
    }

    public function edit($id)
    {
       
       $pegawaiModel = new PegawaiModel();
        $data = [
            'title' => 'Edit Lokasi Presensi',
            'lokasi_presensi' =>
            $pegawaiModel->find($id),
            'validation' => \Config\Services::validation()
        ];
        return view('admin/lokasi_presensi/edit', $data);
    }

    public function update($id)
    {
       
       $pegawaiModel = new PegawaiModel();
        $rules = [
             'nama_lokasi' => [
                'rules' => 'required|is_unique[lokasi_presensi.nama_lokasi,id,{id}]',
                'errors' => [
                    'required' => "Nama lokasi wajib diisi",
                     'is_unique' => 'Nama lokasi sudah terdaftar'
                ],
            ],
            'alamat_lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Alamat lokasi wajib diisi"
                ],
            ],
            'tipe_lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Tipe lokasi wajib diisi"
                ],
            ],
            'latitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Latitude wajib diisi"
                ],
            ],
            'longitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Longitude wajib diisi"
                ],
            ],
            'radius' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Radius wajib diisi"
                ],
            ],
            'zona_waktu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Zona waktu wajib diisi"
                ],
            ],
            'jam_masuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Jam masuk wajib diisi"
                ],
            ],
            'jam_keluar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Jam keluar wajib diisi"
                ],
            ],
        ];

        if (!$this->validate($rules)) {

            $data = [
                'title' => 'Edit Lokasi Presensi',
                'lokasi_presensi' =>
                $pegawaiModel->find($id),
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/lokasi_presensi/edit', $data);

        } else {
           
           $pegawaiModel = new PegawaiModel();
           
           $pegawaiModel ->update($id, [
                'nama_lokasi' => $this->request->getPost('nama_lokasi'),
                'alamat_lokasi' => $this->request->getPost('alamat_lokasi'),
                'tipe_lokasi' => $this->request->getPost('tipe_lokasi'),
                'latitude' => $this->request->getPost('latitude'),
                'longitude' => $this->request->getPost('longitude'),
                'radius' => $this->request->getPost('radius'),
                'zona_waktu' => $this->request->getPost('zona_waktu'),
                'jam_masuk' => $this->request->getPost('jam_masuk'),
                'jam_keluar' => $this->request->getPost('jam_keluar')
            ]);


            session()->setFlashdata('berhasil', 'Data lokasi presensi berhasil diupdate');

            return redirect()->to(base_url('admin/lokasi_presensi'));
        }
    }

    function delete($id)
    {
       
       $pegawaiModel = new PegawaiModel();
        $lokasipresensi =
        $pegawaiModel->find($id);

        if ($lokasipresensi) {
           
           $pegawaiModel ->delete($id);
            session()->setFlashData('berhasil', 'Data lokasi presensi berhasil dihapus');
            return redirect()->to(base_url('admin/lokasi_presensi'));
        }
    }
}
