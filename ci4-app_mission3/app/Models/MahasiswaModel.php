<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'student_id';
    protected $useAutoIncrement = true;

    // Kolom yang boleh diisi oleh pengguna
    protected $allowedFields = ['nim', 'nama', 'entry_year'];
    public function getMahasiswa($nim = false)
    {
        if ($nim === false) {
            return $this->orderBy('nim', 'ASC')->findAll();
        }

        return $this->where(['nim' => $nim])->first();
    }
}