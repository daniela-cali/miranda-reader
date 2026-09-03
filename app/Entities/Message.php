<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use SimpleXMLElement;

class Message extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at'];
    protected $casts   = ['id', 'timestamp'];



    public function __toString()
    {   

        return $this->xml;

    }

    private function simpleXML(): SimpleXMLElement
    {
        return simplexml_load_string($this->xml);
    }

    public function getSender(): string
    {
        return $this->simpleXML()['from'];
    }

    public function getBody(): string
    {
        return $this->simpleXML()->body;
       
    }

    public function getChat(): string
    {
        $logged = $this->loggedUser();
        return $this->username == $logged ? $this->username. ' is sender' :  $this->username. ' is not sender';

    }

    private function loggedUser(): string
    {
        return 'nhildra';
    }
    
}
