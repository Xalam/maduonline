<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username'  => 'admin',
            'password'  =>  password_hash('madumurni555', PASSWORD_BCRYPT),
            'name'      => 'Admin'
        ];
        $this->db->table('users')->insert($data);
    }
}
