<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\ArchiveModel;

class EjabberdUsersModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'username';

    protected $allowedFields    = [];
    protected $returnType    = 'object';
    protected $DBGroup = 'secondary';

    public function getUserContacts(string $username)
    {
        $contactsWith = (new ArchiveModel())->getPeersByUsername($username);
        //dd($contactsWith);
        return $contactsWith;
    }
}
