<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PermissionModel;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn')) 
            return redirect()->to('map');

        return view('auth/login');
    }

    public function authenticate()
    {
        $userModel = model(UserModel::class);
        $user = [];
        $userPassword = '';
        $username = $_POST['username'];
        $password = $_POST['password'];
        $isPasswordAuthenticated = false;

        $user = $userModel->getUser($username, 'username');

        if (!$user) {
            session()->setFlashdata('message', 'Este usuario no existe');
            return redirect()->to('auth/login');
        }

        $userPassword = $user['password'];
        $isPasswordAuthenticated = password_verify($password, $userPassword);

        if (!$isPasswordAuthenticated) {
            session()->setFlashdata('message', 'Contraseña incorrecta');
            return redirect()->to('auth/login');
        }

        if ($this->_setSessionData($user)) {
            return redirect()->to('map');
        } else {
            session()->setFlashdata('message', 'Error al iniciar sesión');
            return redirect()->to('auth/login');
        }
    }

    public function signup()
    {
        if (session()->get('isLoggedIn')) 
            return redirect()->to('map');

        return view('auth/signup');
    }

    public function register()
    {
        $userModel = model(UserModel::class);
        $user = [];
        $username = [];
        $signedUpUser = [
            'name' => $this->request->getPost('name'),
            'last' => $this->request->getPost('last'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'email' => $this->request->getPost('email'),
            'image' => DEFAULT_PROFILE_IMAGE,
            'role' => DEFAULT_USER_ROLE_ID,
        ];

        $username = $userModel->getUser($signedUpUser['username'], 'username');
        if ($username) {
            session()->setFlashdata('message', 'Este usuario ya existe');
            return redirect()->to('auth/signup');
        }

        if (!$userModel->saveUser($signedUpUser)) {
            session()->setFlashdata('message', 'Error al guardar el usuario');
            return redirect()->to('auth/signup');
        }

        $user = $userModel->getUser($signedUpUser['username'], 'username');

        if ($this->_setSessionData($user)) {
            return redirect()->to('onboarding');
        } else {
            session()->setFlashdata('message', 'Usuario registrado pero ocurrio un error al iniciar sesión');
            return redirect()->to('auth/login');
        }
    }

    private function _setSessionData($user)
    {
        $sessionData = [
            'id'       => $user['id'],
            'username' => $user['username'],
            'name'     => $user['name'],
            'last'     => $user['last'],
            'auth' => [
                'role' => [
                    'id'   => $user['roleId'],
                    'name' => $user['roleName'],
                ],
                'permissions' => $this->_getPermissions($user['role']),
            ],
            'isLoggedIn' => TRUE,
        ];

        session()->set($sessionData);
        
        return session()->get('id') ? true : false;
    }

    private function _getPermissions($role)
    {
        $permissionModel = model(PermissionModel::class);
        $permissions = $permissionModel->getRolePermissions($role);
        $permissions = array_map(fn($permission) => $permission['name'], $permissions);
        return $permissions;
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('auth/login');
    }
}
