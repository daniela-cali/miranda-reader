<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArchiveModel;
use CodeIgniter\HTTP\ResponseInterface;

class ArchiveController extends BaseController
{
    public function index()
    {
        $data['messages'] = (new ArchiveModel())->findAll(50);
        return view('welcome_message', $data);
    }
}
