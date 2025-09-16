<?php

namespace App\Models;

use CodeIgniter\Model;

class TakeModel extends Model
{
    protected $table            = 'takes';
    protected $primaryKey       = 'take_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['student_id', 'course_id', 'enroll_date'];
}