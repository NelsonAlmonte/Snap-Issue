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
        $payload = $this->request->getJSON(true);
        $uploadedPicture = '';

        $uploadedPicture = $this->_uploadPicture($payload['issue']['picture']);
        if (!empty($uploadedPicture)) {
            $payload['issue']['picture'] = $uploadedPicture;
        } else {
            $response['message'] = 'Error al subir la imagen';
            $response['status'] = 400;
            return $this->fail($response);
        }
        
        $response['token'] = csrf_hash();

        try {
            $issueModel->saveIssue($payload['issue']);
            $response['status'] = 201;
            return $this->respondCreated($response, 'Su reporte ha sido enviado!');
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['status'] = 400;
            return $this->fail($response);
        }
    }

    private function _uploadPicture($picture): string
    {
        helper('text');
        $encodedPicture = [];
        $decodedPicture = '';
        $pictureExtension = '';
        $pictureName = '';
        $uploadedPicture = '';

        $encodedPicture = explode(',', $picture);
        $decodedPicture = base64_decode($encodedPicture[1]);
        $pictureExtension = explode('/', $encodedPicture[0]);
        $pictureExtension = '.' . explode(';', $pictureExtension[1])[0];
        $pictureName = random_string('alnum', 16) . $pictureExtension;

        if (file_put_contents(PATH_TO_UPLOAD_PICURE . $pictureName, $decodedPicture)) 
            $uploadedPicture = $pictureName;

        return $uploadedPicture;
    }

    public function getIssues(): ResponseInterface
    {
        $issueModel = model(IssueModel::class);
        $response = [];

        $response['token'] = csrf_hash();

        try {
            $response['data'] = $issueModel->getIssues();
            $response['status'] = 200;
            return $this->respond($response);
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['status'] = 400;
            return $this->fail($response);
        }
    }
}
