<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class CoursesApi extends ResourceController
{
    protected $modelName = 'App\Models\CourseModel';
    protected $format    = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }
}
