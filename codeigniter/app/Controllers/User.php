<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class User extends BaseController
{
    use ResponseTrait;

    public function getUser(): ResponseInterface
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

    public function updateUser(): ResponseInterface
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
        $userModel = model(UserModel::class);

        $data['user'] = $userModel->getUser(session()->get('id'));

        return view('template/header') . 
            view('user/profile', $data) .
            view('template/footer');
    }
}
