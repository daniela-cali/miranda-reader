<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\EjabberdUsersModel;
use App\Models\ArchiveModel;

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
        $data = [
            'title' => 'Conversazione con utente: '.$bare_peer,
            'messages' => $messages
        ];
        return view('chat/conversation', $data);

    }
}
