<?php

namespace App\Controllers\Admin;

class Article extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Daftar Artikel'
        ];

        return view('admin/article/index', $data);
    }
}
