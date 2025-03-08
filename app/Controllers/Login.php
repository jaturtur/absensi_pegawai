<?php

namespace App\Controllers;

use App\Models\LoginModel;
use App\Models\PegawaiModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    public function index()
    {
        $data = [
            'validation' => \Config\Services::validation()
        ];
        return view('login', $data);
    }

    public function login_action()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator;
            return view('login', $data);
        } else {
            $session = session();
            $loginModel = new LoginModel();
            $pegawaiModel = new PegawaiModel(); // Perbaikan di sini

            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            $cekusername = $loginModel->where('username', $username)->first();

            if ($cekusername) {
                $password_db = $cekusername['password'];
                $cek_password = password_verify($password, $password_db);
                
                if ($cek_password) {
                    // Ambil data pegawai berdasarkan id_pegawai
                    $pegawai = $pegawaiModel->where('id', $cekusername['id_pegawai'])->first();

                    $session_data = [
                        'username'   => $cekusername['username'],
                        'logged_in'  => TRUE,
                        'role_id'    => $cekusername['role'],
                        'id_pegawai' => $cekusername['id_pegawai'],
                        'foto'       => $pegawai ? $pegawai['foto'] : 'default.jpg' // Ambil foto dari tabel pegawai
                    ];

                    $session->set($session_data);

                    switch ($cekusername['role']) {
                        case "Admin":
                            return redirect()->to('admin/home');
                        case "Pegawai":
                            return redirect()->to('pegawai/home');
                        default:
                            $session->setFlashdata('pesan', 'Akun Anda belum terdaftar');
                            return redirect()->to('/');
                    }
                } else {
                    $session->setFlashdata('pesan', 'Password salah, silahkan coba lagi');
                    return redirect()->to('/');
                }
            } else {
                $session->setFlashdata('pesan', 'Username salah, silahkan coba lagi');
                return redirect()->to('/');
            }
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
