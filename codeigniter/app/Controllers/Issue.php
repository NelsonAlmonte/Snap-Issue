<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\IssueModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class Issue extends BaseController
{
    use ResponseTrait;

    public function save(): ResponseInterface
    {
        $issueModel = model(IssueModel::class);
        $response = [];
        $json = $this->request->getJSON(true);
        
        $response['token'] = csrf_hash();
        
        if ($issueModel->saveIssue($json['issue'])) {
            $response['status'] = 201;
            return $this->respondCreated($response, 'Su reporte ha sido enviado!');    
        } else {
            return $this->fail('Error al enviar el reporte');
        }
    }
}
