<?php

namespace App\Models;

use CodeIgniter\Model;

class ArchiveModel extends Model
{
    protected $table            = 'archive';
    protected $primaryKey       = 'id';

    protected $allowedFields    = [];
    protected $returnType    = \App\Entities\Message::class;
    protected $useTimestamps = true;
    protected $DBGroup = 'secondary';

}
