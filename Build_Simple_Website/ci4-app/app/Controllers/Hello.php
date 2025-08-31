<?php

namespace App\Controllers;

class Hello extends BaseController
{
    public function index()
    {
        return view('hello_world');
    }

    public function tabel()
    {
        return view('tabel_html');
    }

    public function tabelLoop()
    {
        $data = [
            'mahasiswa' => [
                ['nama' => 'Ani', 'nim' => '123'],
                ['nama' => 'Budi', 'nim' => '124'],
                ['nama' => 'Cici', 'nim' => '125']
            ]
        ];
        return view('tabel_loop', $data);
    }
}

?>
