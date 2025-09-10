<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    // Kolom yang boleh diisi oleh pengguna
    protected $allowedFields = ['nim', 'nama', 'umur'];
    public function getMahasiswa($nim = false)
    {
        if ($nim === false) {
            return $this->orderBy('nim', 'ASC')->findAll();
        }

        return $this->where(['nim' => $nim])->first();
    }
}