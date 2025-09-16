<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\TakeModel;

class Courses extends BaseController
{
    protected $courseModel;
    protected $takeModel;

    public function __construct()
    {
        $this->courseModel = new CourseModel();
        $this->takeModel = new TakeModel();
    }

    // ===================================================================
    // METHOD UNTUK ADMIN (CRUD)
    // ===================================================================

    /**
     * Menampilkan daftar semua mata kuliah (untuk Admin).
     */
    public function index()
    {
        $data = [
            'title'   => 'Kelola Mata Kuliah',
            'courses' => $this->courseModel->findAll(),
            'pesan'   => session()->getFlashdata('pesan')
        ];
        // Anda perlu membuat view di: app/Views/courses/index.php
        return view('courses/index', $data);
    }

    /**
     * Menampilkan form untuk membuat mata kuliah baru.
     */
    public function new()
    {
        $data = [
            'title'      => 'Tambah Mata Kuliah Baru',
            'validation' => \Config\Services::validation()
        ];
        // Anda perlu membuat view di: app/Views/courses/new.php
        return view('courses/new', $data);
    }

    /**
     * Menyimpan data mata kuliah baru ke database.
     */
    public function create()
    {
        // Aturan validasi
        $rules = [
            'course_name' => 'required|is_unique[courses.course_name]',
            'credits'     => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $this->courseModel->save([
            'course_name' => $this->request->getVar('course_name'),
            'credits'     => $this->request->getVar('credits')
        ]);

        session()->setFlashdata('pesan', 'Mata kuliah berhasil ditambahkan.');
        return redirect()->to(site_url('courses'));
    }

    /**
     * Menampilkan form untuk mengedit mata kuliah.
     */
    public function edit($course_id = null)
    {
        $courseData = $this->courseModel->find($course_id);

        // PERBAIKAN: Tambahkan pengecekan ini
        if (empty($courseData)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Mata kuliah dengan ID ' . $course_id . ' tidak ditemukan.');
        }

        $data = [
            'title'      => 'Ubah Data Mata Kuliah',
            'validation' => \Config\Services::validation(),
            'course'     => $courseData
        ];
        
        return view('courses/edit', $data);
    }

    /**
     * Memperbarui data mata kuliah di database.
     */
    public function update($course_id = null)
    {
        // Aturan validasi (memperbolehkan nama yang sama jika itu data lama)
        $rules = [
            'course_name' => "required|is_unique[courses.course_name,course_id,{$course_id}]",
            'credits'     => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/courses/edit/' . $course_id)->withInput();
        }

        $this->courseModel->save([
            'course_id'   => $course_id, // Sertakan primary key untuk mode update
            'course_name' => $this->request->getVar('course_name'),
            'credits'     => $this->request->getVar('credits')
        ]);

        session()->setFlashdata('pesan', 'Mata kuliah berhasil diubah.');
        return redirect()->to(site_url('courses'));
    }

    // METHOD UNTUK MENAMPILKAN DETAIL
    public function show($course_id = null)
    {
        $data = [
            'title'  => 'Detail Mata Kuliah',
            'course' => $this->courseModel->find($course_id)
        ];

        if (empty($data['course'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Mata kuliah tidak ditemukan.');
        }

        // Anda perlu membuat view ini di langkah berikutnya
        return view('courses/detail', $data);
    }

    /**
     * Menghapus data mata kuliah.
     */
    public function delete($course_id = null)
    {
        $this->courseModel->delete($course_id);
        session()->setFlashdata('pesan', 'Mata kuliah berhasil dihapus.');
        return redirect()->to(site_url('courses'));
    }


    // ===================================================================
    // METHOD UNTUK MAHASISWA
    // ===================================================================

    /**
     * Menampilkan daftar mata kuliah yang bisa diambil dan yang sudah diambil.
     */
    public function myCourses()
    {
        $user_id = session()->get('user_id');

        $data = [
            'title'      => 'Mata Kuliah Saya',
            // Query untuk mengambil data MK yang sudah diambil saja (JOIN)
            'courses'    => $this->takeModel
                                ->select('courses.course_name, courses.credits')
                                ->join('courses', 'courses.course_id = takes.course_id')
                                ->where('takes.student_id', $user_id)
                                ->findAll(),
            'pesan'      => session()->getFlashdata('pesan')
        ];

        return view('courses/my_courses', $data);
    }

    /**
     * Menampilkan daftar mata kuliah yang BISA diambil (yang belum diambil).
     */
    public function takeCourses()
    {
        $user_id = session()->get('user_id');

        // Ambil dulu ID semua mata kuliah yang sudah diambil
        $enrolledIds = $this->takeModel
                    ->where('student_id', $user_id)
                    ->findColumn('course_id');

        // PENTING: Cek apakah hasilnya array kosong, jika ya, beri nilai default
        if (empty($enrolledIds)) {
            $enrolledIds = [0];
        }

        $data = [
            'title'      => 'Ambil Mata Kuliah',
            // Query untuk mengambil data MK yang BELUM diambil
            'courses'    => $this->courseModel
                                ->whereNotIn('course_id', $enrolledIds)
                                ->findAll(),
            'pesan'      => session()->getFlashdata('pesan')
        ];

        return view('courses/take_courses', $data); // Arahkan ke view baru
    }

    /**
     * Memproses pendaftaran (enroll) mata kuliah.
     */
    public function enroll($course_id = null)
    {
        // Panggil kunci sesi yang benar
        $user_id = session()->get('user_id');

        if (empty($user_id) || empty($course_id)) {
            session()->setFlashdata('pesan', 'Terjadi kesalahan: ID tidak valid.');
            return redirect()->to(site_url('take-courses'));
        }

        $isEnrolled = $this->takeModel->where([
            'student_id' => $user_id,
            'course_id'  => $course_id
        ])->first();

        if ($isEnrolled) {
            session()->setFlashdata('pesan', 'Anda sudah terdaftar di mata kuliah ini.');
            return redirect()->to(site_url('take-courses'));
        }

        $this->takeModel->save([
            'student_id'  => $user_id,
            'course_id'   => $course_id,
            'enroll_date' => date('Y-m-d')
        ]);

        session()->setFlashdata('pesan', 'Berhasil mendaftar mata kuliah!');
        return redirect()->to(site_url('take-courses'));
    }
}