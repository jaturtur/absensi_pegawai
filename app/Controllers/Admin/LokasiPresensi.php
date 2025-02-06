<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\LokasiPresensiModel; 

class LokasiPresensi extends BaseController
{
    public function index()
    {
        $lokasipresensiModel = new LokasiPresensiModel();
        $data = [
            'title' => 'Data Lokasi Presensi',
            'lokasi_presensi' => $lokasipresensiModel->findAll(),
        ];

        return view('admin/lokasi_presensi/lokasi_presensi', $data);
    }

    public function detail($id)
    {
        $lokasipresensiModel = new LokasiPresensiModel();
        $data = [
            'title' => 'Detail Lokasi Presensi',
            'lokasi_presensi' => $lokasipresensiModel->find($id),
        ];

        return view('admin/lokasi_presensi/detail', $data);
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
            $lokasipresensiModel = new LokasiPresensiModel();
            $lokasipresensiModel->insert([
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
        $lokasipresensiModel = new LokasiPresensiModel();
        $data = [
            'title' => 'Edit Lokasi Presensi',
            'lokasi_presensi' => $lokasipresensiModel->find($id),
            'validation' => \Config\Services::validation()
        ];
        return view('admin/lokasi_presensi/edit', $data);
    }

    public function update($id)
    {
        $lokasipresensiModel = new LokasiPresensiModel();
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
                'lokasi_presensi' => $lokasipresensiModel->find($id),
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/lokasi_presensi/edit', $data);

        } else {
            $lokasipresensiModel = new LokasiPresensiModel();
            $lokasipresensiModel->update($id, [
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
        $lokasipresensiModel = new LokasiPresensiModel();
        $lokasipresensi = $lokasipresensiModel->find($id);

        if ($lokasipresensi) {
            $lokasipresensiModel->delete($id);
            session()->setFlashData('berhasil', 'Data lokasi presensi berhasil dihapus');
            return redirect()->to(base_url('admin/lokasi_presensi'));
        }
    }
}