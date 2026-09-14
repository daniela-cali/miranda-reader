<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\EjabberdUsersModel;
use App\Models\ArchiveModel;
use DateTime;

class ChatViewerController extends BaseController
{
    public function index()
    {
        $loggedUsername = auth()->user()->username;
        $data = [
            'title' => 'Chat Viewer: '. $loggedUsername,
            'needsToolbar' => true,
            'loggedUser' => $loggedUsername,
            'contactsWith' => (new EjabberdUsersModel())->getUserContacts($loggedUsername)
        ];
        return view('chat/index', $data);
    }

    public function conversation()
    {
        $loggedUsername = auth()->user()->username;
        $bare_peer = $this->request->getGet('bare_peer');
        $messages = (new ArchiveModel())->getConversation($loggedUsername, $bare_peer);
        $historyDates = (new ArchiveModel())->getHistoryDates($loggedUsername, $bare_peer);
        //dd($historyDates);
        $historyTree = [];
        foreach ($historyDates as  $date) {
            //dd($date);
            $currYear = date('Y', strtotime($date));
            $currMonth = date('m', strtotime($date));
            if(!array_key_exists($currYear, $historyTree)){
                $historyTree[$currYear]=[];
                } 
            if(!array_key_exists($currMonth, $historyTree[$currYear])) {
                $historyTree[$currYear][$currMonth]=[];
            }
            if(!array_key_exists($date, $historyTree[$currYear][$currMonth])) {
                $historyTree[$currYear][$currMonth][]= $date;
            }
        }
       
        $data = [
            'title' => 'Conversazione con: ' . $bare_peer,
            'bare_peer' => $bare_peer,
            'messages' => $messages,
            'historyTree' => $historyTree
        ];
        return view('chat/conversation', $data);

    }
}
