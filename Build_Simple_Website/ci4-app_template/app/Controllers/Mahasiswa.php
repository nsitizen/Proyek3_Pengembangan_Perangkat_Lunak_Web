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
            'mahasiswa' => $this->mahasiswaModel->getMahasiswa(),
            'pesan' => session()->getFlashdata('pesan') // Ambil flash message
        ];

        return view('mahasiswa/index', $data);
    }

    // METHOD UNTUK MENAMPILKAN DETAIL
    public function detail($nim)
    {
        $data = [
            'title' => 'Detail Mahasiswa',
            'mahasiswa' => $this->mahasiswaModel->getMahasiswa($nim)
        ];

        if (empty($data['mahasiswa'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Mahasiswa dengan NIM ' . $nim . ' tidak ditemukan.');
        }
        
        return view('mahasiswa/detail', $data);
    }

    // METHOD UNTUK MENAMPILKAN FORM TAMBAH DATA (CREATE)
    public function create()
    {
        $data = [
            'title' => 'Form Tambah Data Mahasiswa',
            'validation' => \Config\Services::validation()
        ];
        return view('mahasiswa/create', $data);
    }

    // METHOD UNTUK MENYIMPAN DATA BARU (CREATE)
    public function save()
    {
        // Aturan validasi
    $rules = [
        'nim' => [
            'rules' => 'required|is_unique[mahasiswa.nim]',
            'errors' => [
                'required' => 'NIM mahasiswa wajib diisi.',
                'is_unique' => 'NIM mahasiswa sudah terdaftar.'
            ]
        ],
        'nama' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama mahasiswa wajib diisi.'
            ]
        ],
        'umur' => [
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Umur mahasiswa wajib diisi.',
                'numeric' => 'Umur harus berupa angka.'
            ]
        ]
    ];

    // Cek apakah data valid
    if (!$this->validate($rules)) {
        // Jika tidak valid, kembalikan ke form tambah data dengan pesan error
        return redirect()->back()->withInput();
    }

    // Jika data valid, simpan ke database
    $this->mahasiswaModel->save([
        'nim' => $this->request->getVar('nim'),
        'nama' => $this->request->getVar('nama'),
        'umur' => $this->request->getVar('umur')
    ]);

    // Buat flash message
    session()->setFlashdata('pesan', 'Data berhasil ditambahkan!');

    return redirect()->to(site_url('mahasiswa'));
    }

    // METHOD UNTUK MENGHAPUS DATA (DELETE)
    public function delete($nim)
    {
        $this->mahasiswaModel->where('nim', $nim)->delete();
        
        // Buat flash message
        session()->setFlashdata('pesan', 'Data berhasil dihapus!');

        return redirect()->to('/mahasiswa');
    }

    // METHOD UNTUK MENAMPILKAN FORM EDIT (UPDATE)
    public function edit($nim)
    {
        $data = [
            'title' => 'Form Ubah Data Mahasiswa',
            'validation' => \Config\Services::validation(), 
            'mahasiswa' => $this->mahasiswaModel->where('nim', $nim)->first()
        ];
        return view('mahasiswa/edit', $data);
    }

    // METHOD UNTUK MEMPERBARUI DATA (UPDATE)
    public function update()
    {
        // Ambil data dari form, termasuk id dan nim lama dari hidden input
        $id = $this->request->getVar('id');
        $nim_lama = $this->request->getVar('nim_lama');
        $nim_baru = $this->request->getVar('nim');

        // Tentukan aturan validasi untuk NIM
        // Jika NIM tidak diubah, aturan is_unique tidak diperlukan
        if ($nim_baru == $nim_lama) {
            $rule_nim = 'required';
        } else {
            // Jika NIM diubah, pastikan NIM baru unik
            $rule_nim = 'required|is_unique[mahasiswa.nim]';
        }

        // Aturan validasi lengkap
        $rules = [
            'nim' => [
                'rules' => $rule_nim,
                'errors' => [
                    'required' => 'NIM mahasiswa wajib diisi.',
                    'is_unique' => 'NIM mahasiswa sudah terdaftar.'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama mahasiswa wajib diisi.'
                ]
            ],
            'umur' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Umur mahasiswa wajib diisi.',
                    'numeric' => 'Umur harus berupa angka.'
                ]
            ]
        ];
    
        // Jalankan validasi
        if (!$this->validate($rules)) {
            // Jika validasi gagal, kembalikan ke form edit dengan error
            return redirect()->back()->withInput();
        }

        // Jika validasi berhasil, simpan data
        $this->mahasiswaModel->save([
            'id'   => $id, // KUNCI UTAMA: sertakan ID untuk mode UPDATE
            'nim'  => $nim_baru,
            'nama' => $this->request->getVar('nama'),
            'umur' => $this->request->getVar('umur')
        ]);

        // Buat flash message
        session()->setFlashdata('pesan', 'Data berhasil diubah!');

        return redirect()->to(site_url('mahasiswa'));
    }
}