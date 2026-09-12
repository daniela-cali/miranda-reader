<?php

namespace App\Models;

use CodeIgniter\Model;

class ArchiveModel extends Model
{
    protected $table            = 'archive';
    protected $primaryKey       = 'id';

    protected $allowedFields    = [];
    protected $returnType    = \App\Entities\Message::class;
    protected $DBGroup = 'secondary';

    public function getPeersByUsername(string $username)
    {
        return $this->asObject()
                    ->select('bare_peer, COUNT(id) as count')
                    ->where('username', $username)
                    ->where('bare_peer LIKE', '%@%') //esclude i messaggi di sistema, vedi ad es. record id 2060
                    ->groupBy('bare_peer')
                    ->findAll();
    }

    public function getConversation(string $username, string $bare_peer)
    {
        return $this->where('username', $username)
                    ->where('bare_peer', $bare_peer)
                    ->findAll(50);
    }
    
    

}
