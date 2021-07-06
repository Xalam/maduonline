<?php

namespace App\Controllers\FrontEnd;

use App\Controllers\BaseController;
use App\Models\ArticleModel;
use App\Models\ProductModel;

class Home extends BaseController
{
    protected $articleModel;
    protected $productModel;

    public function __construct()
    {
        $this->articleModel = new ArticleModel();
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $article = $this->articleModel->findAll();
        $product = $this->productModel->findAll();

        $data = [
            'article' => $article,
            'product' => $product
        ];

        return view('frontend/index', $data);
    }

    public function show($id)
    {
        $articleId = $this->articleModel->find($id);

        $data = [
            'article' => $articleId
        ];

        return view('frontend/detail', $data);
    }
}
