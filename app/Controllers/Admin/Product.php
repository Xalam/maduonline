<?php

namespace App\Controllers\Admin;

class Product extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Daftar Produk'
        ];

        return view('admin/product/index', $data);
    }
}
