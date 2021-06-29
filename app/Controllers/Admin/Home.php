<?php

namespace App\Controllers\Admin;

use App\Models\ProductModel;

class Home extends BaseController
{
	public function index()
	{
		$product = new ProductModel();

		$data = [
			'title' => 'Dashboard',
			'sumProduct' => sizeof($product->findAll())
		];

		return view('admin/home/index', $data);
	}
}
