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

    // METHOD UNTUK MENAMPILKAN DETAIL
    public function show($student_id = null)
    {
        $data = [
            'title' => 'Detail Mahasiswa',
            'mahasiswa' => $this->mahasiswaModel->find($student_id)
        ];

        if (empty($data['mahasiswa'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Mahasiswa tidak ditemukan.');
        }
        
        return view('mahasiswa/detail', $data);
    }

    // METHOD UNTUK MENAMPILKAN FORM TAMBAH DATA (CREATE)
    public function new()
    {
        $data = [
            'title' => 'Form Tambah Data Mahasiswa',
            'validation' => \Config\Services::validation()
        ];
        return view('mahasiswa/create', $data);
    }

    // METHOD UNTUK MENYIMPAN DATA BARU (CREATE)
    public function create()
    {
        $rules = [
            'nim' => 'required|is_unique[students.nim]',
            'nama' => 'required',
            // PERBAIKAN TAHUN MASUK
            'entry_year' => [
                'rules' => 'required|numeric|exact_length[4]',
                'errors' => [
                    'required' => 'Tahun masuk wajib diisi.',
                    'numeric' => 'Tahun masuk harus berupa angka.',
                    'exact_length' => 'Tahun masuk harus terdiri dari 4 digit.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $this->mahasiswaModel->save([
            'nim' => $this->request->getVar('nim'),
            'nama' => $this->request->getVar('nama'),
            'entry_year' => $this->request->getVar('entry_year')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan!');
        return redirect()->to(site_url('mahasiswa'));
    }

    // METHOD UNTUK MENAMPILKAN FORM EDIT (UPDATE)
    public function edit($student_id = null)
    {
        $data = [
            'title' => 'Form Ubah Data Mahasiswa',
            'validation' => \Config\Services::validation(), 
            'mahasiswa' => $this->mahasiswaModel->find($student_id)
        ];
        return view('mahasiswa/edit', $data);
    }

    // METHOD UNTUK MEMPERBARUI DATA (UPDATE)
    public function update($student_id = null)
    {
        $nim_lama = $this->request->getVar('nim_lama');
        $nim_baru = $this->request->getVar('nim');

        if ($nim_baru == $nim_lama) {
            $rule_nim = 'required';
        } else {
            $rule_nim = 'required|is_unique[students.nim]';
        }

        $rules = [
            // PERBAIKAN LOGIKA VALIDASI NIM
            'nim' => $rule_nim, 
            'nama' => 'required',
            // PERBAIKAN TAHUN MASUK
            'entry_year' => [
                'rules' => 'required|numeric|exact_length[4]',
                'errors' => [
                    'required' => 'Tahun masuk wajib diisi.',
                    'numeric' => 'Tahun masuk harus berupa angka.',
                    'exact_length' => 'Tahun masuk harus terdiri dari 4 digit.'
                ]
            ]
        ];
    
        if (!$this->validate($rules)) {
            // Penting: Kirim ID lagi saat kembali ke form edit jika validasi gagal
            return redirect()->to('/mahasiswa/edit/' . $student_id)->withInput();
        }

        $this->mahasiswaModel->save([
            'student_id'   => $student_id,
            'nim'  => $nim_baru,
            'nama' => $this->request->getVar('nama'),
            'entry_year' => $this->request->getVar('entry_year')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah!');
        return redirect()->to(site_url('mahasiswa'));
    }

    // METHOD UNTUK MENGHAPUS DATA (DELETE)
    public function delete($student_id = null)
    {
        $this->mahasiswaModel->delete($student_id);
        
        session()->setFlashdata('pesan', 'Data berhasil dihapus!');
        return redirect()->to(site_url('mahasiswa'));
    }
}