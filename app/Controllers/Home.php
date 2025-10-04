<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Home | APLIKASI PENGHITUNGAN & TRANSPARANSI GAJI DPR BERBASIS WEB'
        ];
        return view('pages/home', $data);
    }
}
