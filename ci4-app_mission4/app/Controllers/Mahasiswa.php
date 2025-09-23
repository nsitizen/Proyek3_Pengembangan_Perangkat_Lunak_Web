<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;

class Mahasiswa extends BaseController
{
    protected $mahasiswaModel;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
    }

    // METHOD UNTUK MENAMPILKAN SEMUA DATA (READ)
    public function index()
    {
        $data = [
            'title' => 'Daftar Mahasiswa',
            'mahasiswa' => $this->mahasiswaModel->findAll(),
            'pesan' => session()->getFlashdata('pesan')
        ];
        return view('mahasiswa/index', $data);
    }
}