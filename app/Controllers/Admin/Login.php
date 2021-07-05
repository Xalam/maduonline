<?php

namespace App\Controllers\Admin;

use App\Models\UsersModel;
use Config\Services;

class Login extends BaseController
{
    protected $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Login',
            'validation' => Services::validation(),
        ];

        return view('admin/auth/index', $data);
    }

    public function post_login()
    {
        $users = $this->usersModel->where(['username' => $this->request->getVar('username')])->first();

        if ($users) {
            if (password_verify($this->request->getVar('password'), $users['password'])) {
                session()->set([
                    'username' => $users['username'],
                    'name' => $users['name'],
                    'logged_in' => TRUE
                ]);
                return redirect()->to(base_url('/admin'));
            } else {
                return redirect()->to(base_url('admin/login'))->with('error', 'Username & Password Salah');
            }
        } else {
            return redirect()->to(base_url('admin/login'))->with('error', 'Username & Password Salah');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/admin/login'));
    }
}
