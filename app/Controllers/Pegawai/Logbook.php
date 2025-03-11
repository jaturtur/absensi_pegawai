<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
<<<<<<< HEAD
use App\Models\LogbookModel;
=======
>>>>>>> 4bcf2d23cb5aacf9c36cc4ac2dcfba60ea878756
use CodeIgniter\HTTP\ResponseInterface;

class Logbook extends BaseController
{
<<<<<<< HEAD
    protected $logbookModel;

    public function __construct()
    {
        $this->logbookModel = new LogbookModel();
=======
    function __construct()
    {
    helper(['url', 'form']);
>>>>>>> 4bcf2d23cb5aacf9c36cc4ac2dcfba60ea878756
    }

    public function index()
    {
        $data = [
<<<<<<< HEAD
            'title' => 'Daftar Logbook',
            'logbooks' => $this->logbookModel->findAll(),
        ];
        return view('pegawai/logbook', $data);
    }

    public function create()
    {
        $data = ['title' => 'Tambah Logbook'];
        return view('pegawai/create_logbook', $data);
    }

    public function store()
    {
        $status = $this->request->getPost('status') ?? 'proses'; // Kalau kosong, jadi 'proses'

        $this->logbookModel->insert([
            'hari_tanggal'   => $this->request->getPost('hari_tanggal'),
            'rencana_target' => $this->request->getPost('rencana_target'),
            'output'         => $this->request->getPost('output'),
            'keterangan'     => $this->request->getPost('keterangan'),
            'status'         => $status, 
        ]);

        return redirect()->to('/pegawai/logbook')->with('success', 'Logbook berhasil ditambahkan');
    }

    public function edit($id)
    {
        $logbook = $this->logbookModel->find($id);
        if (!$logbook) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = ['title' => 'Edit Logbook', 'logbook' => $logbook];
        return view('pegawai/edit_logbook', $data);
    }

    public function update($id)
    {
        $status = $this->request->getPost('status') ?? 'proses'; // Kalau kosong, jadi 'proses'

        $this->logbookModel->update($id, [
            'hari_tanggal'   => $this->request->getPost('hari_tanggal'),
            'rencana_target' => $this->request->getPost('rencana_target'),
            'output'         => $this->request->getPost('output'),
            'keterangan'     => $this->request->getPost('keterangan'),
            'status'         => $status,
        ]);

        session()->setFlashdata('berhasil', 'Data berhasil diperbarui!');
        return redirect()->to('/pegawai/logbook');
    }

    public function delete($id)
    {
        $this->logbookModel->delete($id);
        session()->setFlashdata('berhasil', 'Data logbook berhasil dihapus');
        return redirect()->to('/pegawai/logbook');
    }

    public function detail($id)
    {
        $logbook = $this->logbookModel->find($id);
        if (!$logbook) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = ['title' => 'Detail Logbook', 'logbook' => $logbook];
        return view('pegawai/detail_logbook', $data);
=======
            'title' => 'Logbook',
        ];
        return view('pegawai/logbook/logbook', $data);
>>>>>>> 4bcf2d23cb5aacf9c36cc4ac2dcfba60ea878756
    }
}
