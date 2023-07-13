<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use CodeIgniter\API\ResponseTrait;

class Category extends BaseController
{
    use ResponseTrait;

    public function getCategories()
    {
        $categoryModel = model(CategoryModel::class);
        $response = [];

        $response['token'] = csrf_hash();

        try {
            $response['data'] = $categoryModel->getCategories();
            $response['status'] = 200;
            return $this->respond($response);
        } catch (\Throwable $th) {
            $response['message'] = 'Error al recibir las categorias';
            $response['status'] = 400;
            return $this->fail($response);
        }
    }
}
