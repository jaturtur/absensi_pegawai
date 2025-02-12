<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Logbook extends BaseController
{
    function __construct()
    {
    helper(['url', 'form']);
    }

    public function index()
    {
        $data = [
            'title' => 'Logbook',
        ];
        return view('pegawai/logbook/logbook', $data);
    }
}
