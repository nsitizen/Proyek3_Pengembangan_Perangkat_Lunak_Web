<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home | Welcome to My Website'
        ];
        return view('pages/home', $data);
    }
}