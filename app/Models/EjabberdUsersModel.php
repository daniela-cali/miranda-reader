<?php

namespace App\Models;

use CodeIgniter\Model;

class EjabberdUsersModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'username';

    protected $allowedFields    = [];
    protected $returnType    = \App\Entities\EjabberdUser::class;
    protected $DBGroup = 'secondary';
}
