<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class User extends BaseController
{
    use ResponseTrait;

    public function getUser()
    {
        $userModel = model(UserModel::class);
        $field = 'username';
        $value = session()->get('username');
        $payload = $this->request->getGet();
        $response = [];

        $response['token'] = csrf_hash();

        if ($payload) {
            $field = 'u.id';
            $value = $payload['id'];
        }

        try {
            $response['data'] = $userModel->getUser($value, $field);
            $response['status'] = 200;
            return $this->respond($response);
        } catch (\Throwable $th) {
            $response['message'] = 'Error al recibir el usuario';
            $response['status'] = 400;
            return $this->fail($response);
        }
    }
}
