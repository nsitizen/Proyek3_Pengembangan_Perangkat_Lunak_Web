<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\TakeModel; // 1. Pastikan TakeModel dipanggil di sini

class Courses extends BaseController
{
    protected $courseModel;
    protected $takeModel;

    public function __construct()
    {
        $this->courseModel = new CourseModel();
        // 2. Buat (inisialisasi) TakeModel di sini agar bisa dipakai di seluruh class
        $this->takeModel = new TakeModel(); 
    }

    /**
     * Menampilkan halaman utama untuk mengelola mata kuliah (Admin).
     */
    public function index()
    {
        $data = [
            'title'   => 'Kelola Mata Kuliah',
            'courses' => $this->courseModel->findAll()
        ];
        return view('courses/index', $data);
    }

    /**
     * Menampilkan halaman untuk mahasiswa mengambil mata kuliah.
     */
    public function takeCourses()
    {
        // Asumsi student_id disimpan di session sebagai 'user_id'
        $student_id = session()->get('user_id'); 

        // Ambil ID semua mata kuliah yang SUDAH diambil
        $enrolledIds = $this->takeModel
                            ->where('student_id', $student_id)
                            ->findColumn('course_id') ?? []; // Jika null, jadikan array kosong

        $data = [
            'title'        => 'Ambil Mata Kuliah',
            'courses'      => $this->courseModel->findAll(),
            'enrolled_ids' => $enrolledIds
        ];
    
        return view('courses/take_courses', $data);
    }

    /**
     * Menampilkan halaman "Mata Kuliah Saya" untuk mahasiswa.
     */
    public function myCourses()
    {
        $student_id = session()->get('user_id'); 

        $data = [
            'title'   => 'Mata Kuliah Saya',
            // Query JOIN untuk mengambil data MK yang sudah diambil
            'courses' => $this->takeModel
                            ->select('courses.course_name, courses.credits')
                            ->join('courses', 'courses.course_id = takes.course_id')
                            ->where('takes.student_id', $student_id)
                            ->findAll()
        ];
        
        return view('courses/my_courses', $data);
    }

    public function enrollStudent()
    {
        // Pastikan ini adalah request AJAX, untuk keamanan
        if ($this->request->isAJAX()) {
            $student_id = session()->get('user_id');
            
            // Ambil data JSON yang dikirim oleh Fetch
            $json = $this->request->getJSON();
            $courseIds = $json->course_ids;

            // Pastikan ada data yang dikirim
            if (empty($courseIds)) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Tidak ada mata kuliah yang dipilih.'])->setStatusCode(400);
            }

            // Siapkan data untuk dimasukkan ke database
            $dataToInsert = [];
            foreach ($courseIds as $courseId) {
                $dataToInsert[] = [
                    'student_id'  => $student_id,
                    'course_id'   => $courseId,
                    'enroll_date' => date('Y-m-d')
                ];
            }

            // Gunakan insertBatch untuk efisiensi
            $this->takeModel->insertBatch($dataToInsert);

            // Siapkan data respons, tambahkan hash CSRF yang baru
            $responseData = [
                'status'        => 'success',
                'message'       => 'Pendaftaran berhasil disimpan.',
                'csrf_hash_baru' => csrf_hash() // <-- TAMBAHKAN INI
            ];
            
            // Kirim respons sukses kembali ke JavaScript
            return $this->response->setJSON($responseData);
        }
        
        // Jika bukan request AJAX, tolak akses
        return redirect()->to('/');
    }
}