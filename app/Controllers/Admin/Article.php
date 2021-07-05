<?php

namespace App\Controllers\Admin;

use App\Models\ArticleModel;
use Config\Services;

class Article extends BaseController
{
    protected $articleModel;

    public function __construct()
    {
        $this->articleModel = new ArticleModel();
    }
    public function index()
    {
        $article = $this->articleModel->findAll();

        $data = [
            'title' => 'Daftar Artikel',
            'validation' => Services::validation(),
            'article' => $article
        ];

        return view('admin/article/index', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'article_title' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Judul Artikel wajib diisi'
                ]
            ],
            'article_content' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Konten Artikel wajib diisi'
                ]
            ],
            'article_image' => [
                'rules'  => 'mime_in[article_image,image/jpg,image/jpeg,image/png]|max_size[article_image,1024]|is_image[article_image]',
                'errors' => [
                    'mime_in'  => 'Format gambar harus .jpg/.jpeg/.png',
                    'max_size' => 'Ukuran gambar maksimal 1 Mb',
                    'is_image' => 'File harus berbentuk gambar',
                ]
            ],
        ])) {
            return redirect()->to(base_url('/admin/article'))->withInput();
        }

        //Ambil Gambar
        $imageFile = $this->request->getFile('article_image');

        //Nama Gambar
        $fileName = $imageFile->getRandomName();

        //Pindahkan Folder Gambar
        $imageFile->move('img/article', $fileName);

        $this->articleModel->save([
            'article_creator'       => 1,
            'article_title'         => $this->request->getVar('article_title'),
            'article_content'       => $this->request->getVar('article_content'),
            'article_image'         => $fileName,
        ]);

        return redirect()->to(base_url('/admin/article'))->with('success', 'Berhasil menambahkan artikel');
    }

    public function edit($id)
    {
        $articleId = $this->articleModel->find($id);

        $data = [
            'title' => 'Edit Artikel',
            'validation' => Services::validation(),
            'article' => $articleId
        ];

        return view('admin/article/edit', $data);
    }

    public function update($id)
    {
        $articleId = $this->articleModel->find($id);

        if (!$this->validate([
            'article_title' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Judul Artikel wajib diisi'
                ]
            ],
            'article_content' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Konten Artikel wajib diisi'
                ]
            ],
            'article_image' => [
                'rules'  => 'mime_in[article_image,image/jpg,image/jpeg,image/png]|max_size[article_image,1024]|is_image[article_image]',
                'errors' => [
                    'mime_in'  => 'Format gambar harus .jpg/.jpeg/.png',
                    'max_size' => 'Ukuran gambar maksimal 1 Mb',
                    'is_image' => 'File harus berbentuk gambar',
                ]
            ],
        ])) {
            return redirect()->to(base_url('/admin/article/edit/' . $articleId['id']))->withInput();
        }

        //Ambil Gambar
        $imageFile = $this->request->getFile('article_image');

        if ($imageFile->getError() == 4) {
            $fileName = $articleId['article_image'];
        } else {
            //Hapus Gambar Sebelumnya
            unlink('img/article/' . $articleId['article_image']);

            //Nama Gambar
            $fileName = $imageFile->getRandomName();

            //Pindahkan Folder Gambar
            $imageFile->move('img/article', $fileName);
        }

        $this->articleModel->save([
            'id'                    => $id,
            'article_creator'       => 1,
            'article_title'         => $this->request->getVar('article_title'),
            'article_content'       => $this->request->getVar('article_content'),
            'article_image'         => $fileName,
        ]);

        return redirect()->to(base_url('/admin/article'))->with('success', 'Berhasil mengubah artikel');
    }

    public function delete($id)
    {
        $articleId = $this->articleModel->find($id);

        $this->articleModel->delete($id);

        //Hapus Gambar
        unlink('img/article/' . $articleId['article_image']);

        return redirect()->to(base_url('/admin/article'))->with('success', 'Berhasil menghapus artikel');
    }

    public function modal($id)
    {
        $article = $this->articleModel->find($id);

        $data = [
            'article' => $article
        ];

        return view('admin/article/modal', $data);
    }
}
