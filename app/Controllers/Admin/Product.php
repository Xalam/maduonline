<?php

namespace App\Controllers\Admin;

use App\Models\ProductModel;
use Config\Services;

class Product extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $product = $this->productModel->findAll();

        $data = [
            'title' => 'Daftar Produk',
            'validation' => Services::validation(),
            'product' => $product
        ];

        return view('admin/product/index', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'product_name' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama Produk wajib diisi'
                ]
            ],
            'product_price' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Harga Produk wajib diisi'
                ]
            ],
            'product_description' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Deskripsi Produk wajib diisi'
                ]
            ],
            'product_image' => [
                'rules'  => 'uploaded[product_image]|mime_in[product_image,image/jpg,image/jpeg,image/png]|max_size[product_image,1024]|is_image[product_image]',
                'errors' => [
                    'uploaded' => 'Gambar harus diupload',
                    'mime_in'  => 'Format gambar harus .jpg/.jpeg/.png',
                    'max_size' => 'Ukuran gambar maksimal 1 Mb',
                    'is_image' => 'File harus berbentuk gambar',
                ]
            ],
        ])) {
            return redirect()->to(base_url('/admin/product'))->withInput();
        }

        //Ambil Gambar
        $imageFile = $this->request->getFile('product_image');

        //Nama Gambar
        $fileName = $imageFile->getRandomName();

        //Pindahkan Folder Gambar
        $imageFile->move('img/product', $fileName);

        $cleanPrice = str_replace('.', '', $this->request->getVar('product_price'));

        $this->productModel->save([
            'product_name'          => $this->request->getVar('product_name'),
            'product_price'         => $cleanPrice,
            'product_description'   => $this->request->getVar('product_description'),
            'product_image'         => $fileName,
        ]);

        return redirect()->to(base_url('/admin/product'))->with('success', 'Berhasil menambahkan produk');
    }

    public function edit($id)
    {
        $productId = $this->productModel->find($id);

        $data = [
            'title' => 'Edit Produk',
            'validation' => Services::validation(),
            'product' => $productId
        ];

        return view('admin/product/edit', $data);
    }

    public function update($id)
    {
        $productId = $this->productModel->find($id);

        if (!$this->validate([
            'product_name' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama Produk wajib diisi'
                ]
            ],
            'product_price' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Harga Produk wajib diisi'
                ]
            ],
            'product_description' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Deskripsi Produk wajib diisi'
                ]
            ],
            'product_image' => [
                'rules'  => 'mime_in[product_image,image/jpg,image/jpeg,image/png]|max_size[product_image,1024]|is_image[product_image]',
                'errors' => [
                    'mime_in'  => 'Format gambar harus .jpg/.jpeg/.png',
                    'max_size' => 'Ukuran gambar maksimal 1 Mb',
                    'is_image' => 'File harus berbentuk gambar',
                ]
            ],
        ])) {
            return redirect()->to(base_url('/admin/product/edit/' . $productId['id']))->withInput();
        }

        //Ambil Gambar
        $imageFile = $this->request->getFile('product_image');

        if ($imageFile->getError() == 4) {
            $fileName = $productId['product_image'];
        } else {
            //Hapus Gambar Sebelumnya
            unlink('img/product/' . $productId['product_image']);

            //Nama Gambar
            $fileName = $imageFile->getRandomName();

            //Pindahkan Folder Gambar
            $imageFile->move('img/product', $fileName);
        }

        $cleanPrice = str_replace('.', '', $this->request->getVar('product_price'));

        $this->productModel->save([
            'id'                    => $id,
            'product_name'          => $this->request->getVar('product_name'),
            'product_price'         => $cleanPrice,
            'product_description'   => $this->request->getVar('product_description'),
            'product_image'         => $fileName,
        ]);

        return redirect()->to(base_url('/admin/product'))->with('success', 'Berhasil mengubah produk');
    }

    public function delete($id)
    {
        $productId = $this->productModel->find($id);

        $this->productModel->delete($id);

        //Hapus Gambar
        unlink('img/product/' . $productId['product_image']);

        return redirect()->to(base_url('/admin/product'))->with('success', 'Berhasil menghapus produk');
    }

    public function modal($id)
    {
        $product = $this->productModel->find($id);

        $data = [
            'product' => $product
        ];

        return view('admin/product/modal', $data);
    }
}
