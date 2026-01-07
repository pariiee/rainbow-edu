<?php

namespace App\Controllers;

use App\Models\UsersModel;

class UsersController extends BaseController
{
    public function store()
    {
        $model = new UsersModel();

        $model->insert([
            'username' => 'admin',
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'otp'      => null
        ]);

        return 'User berhasil dibuat';
    }
}
