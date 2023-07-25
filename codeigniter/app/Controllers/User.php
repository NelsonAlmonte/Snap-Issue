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
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['status'] = 400;
            return $this->fail($response);
        }
    }

    public function updateUser()
    {
        $userModel = model(UserModel::class);
        $payload = $this->request->getJSON(true);
        $response = [];

        $response['token'] = csrf_hash();

        try {
            $userModel->updateUser($payload['user']);
            $response['status'] = 200;
            return $this->respondUpdated($response, 'Usuario actualizado!');
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['status'] = 400;
            return $this->fail($response);
        }
    }

    public function profile(): string
    {
        
        return view('template/header') . 
            view('user/profile') .
            view('template/footer');
    }
}
