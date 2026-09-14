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

    /* Restituisce tutti i contatti con cui lo username ha chattato */
    public function getPeersByUsername(string $username)
    {
        return $this->asObject()
                    ->select('bare_peer, COUNT(id) as count')
                    ->where('username', $username)
                    ->where('bare_peer LIKE', '%@%') //esclude i messaggi di sistema, vedi ad es. record id 2060
                    ->groupBy('bare_peer')
                    ->findAll();
    }

    /* Restituisce la conversazione tra due utenti */
    public function getConversation(string $username, string $bare_peer)
    {
        return $this->where('username', $username)
                    ->where('bare_peer', $bare_peer)
                    ->findAll(30);
    }

    public function getHistoryDates(string $username, string $bare_peer)
    {
        /* Secondo parametro escape false, altrimenti i metodi parsano gli elementi come campi a sé stanti */
        $result = $this->asArray()
                    ->select("strftime('%Y-%m-%d', timestamp/1000000.0, 'unixepoch') as date", false)
                    ->where('username', $username)
                    ->where('bare_peer', $bare_peer)
                    ->groupBy("strftime('%Y-%m-%d', timestamp/1000000.0, 'unixepoch')", false)
                    ->findAll();
        return array_column($result, 'date');            
    }

    public function getHistoryYears(string $username, string $bare_peer)
    {
        /* Secondo parametro escape false, altrimenti i metodi parsano gli elementi come campi a sé stanti */
        return $this->select("strftime('%Y', timestamp/1000000.0, 'unixepoch') as year", false)
                    ->where('username', $username)
                    ->where('bare_peer', $bare_peer)
                    ->groupBy("strftime('%Y', timestamp/1000000.0, 'unixepoch')", false)
                    ->get()
                    ->getResultArray();
    }
    public function getHistoryMonths(string $username, string $bare_peer)
    {
        /* Secondo parametro escape false, altrimenti i metodi parsano gli elementi come campi a sé stanti */
        return $this->select("strftime('%m', timestamp/1000000.0, 'unixepoch') as month", false)
                    ->where('username', $username)
                    ->where('bare_peer', $bare_peer)
                    ->groupBy("strftime('%Y-%m', timestamp/1000000.0, 'unixepoch')", false)
                    ->get()
                    ->getResultArray();
    }
    
    
    

}
