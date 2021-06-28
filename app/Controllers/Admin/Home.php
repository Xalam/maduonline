<?php

namespace App\Controllers\Admin;

class Home extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'Dashboard'
		];

		return view('admin/home/index', $data);
	}
}
