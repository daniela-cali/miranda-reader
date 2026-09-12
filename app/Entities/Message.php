<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use SimpleXMLElement;

class Message extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at'];
    protected $casts   = ['id' => 'integer'];



    /*public function __toString()
    {   
        return $this->xml;
    }*/
    public function getTimestamp(): \CodeIgniter\I18n\Time
    {
        $usec = (int) $this->attributes['timestamp'];
    
        return \CodeIgniter\I18n\Time::createFromTimestamp(intdiv($usec, 1_000_000));
    }

    private function simpleXML(): SimpleXMLElement
    {
        return simplexml_load_string($this->xml);
    }

    /* Restituisco se lo username del messaggio è anche il sender da xml per formattazione conversazione */
    public function getIsSender(): bool
    {
         return $this->getSender() === $this->username;
    }

    /* Ottengo il reale sender dal campo from dell'xml */
    public function getSender()
    {
        $info = explode('@', $this->simpleXML()['from']);
        $sender = $info[0] == $this->username ? $this->username : $info[0];
        //return strstr((string) $this->simpleXML()['from'], '@', true); Tengo come commento, non sarei mai stata in grado di scriverlo da sola

        return $sender;
    }

    public function getBody(): string
    {
        return $this->simpleXML()->body;
       
    }

    
}
