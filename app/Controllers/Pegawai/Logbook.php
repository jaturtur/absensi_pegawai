<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Logbook extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Logbook',
        ];
        return view('pegawai/logbook', $data);
    }
}
