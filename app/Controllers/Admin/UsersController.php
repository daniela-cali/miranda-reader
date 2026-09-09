<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EjabberdUsersModel;
use App\Models\EjabberdUsersModel\EjabberdUsers;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Shield\Authentication\Passwords;
use CodeIgniter\Shield\Validation\ValidationRules;

class UsersController extends BaseController
{
    public function index()
    {
        $users = auth()->getProvider();
        
        $usersList = $users
            ->withGroups()
            ->withPermissions()
            ->findAll();

        $data = [
            'title'     => 'Gestione Utenti',
            'usersList' => $usersList,
            // $route viene derivato automaticamente da BaseController::view():
            // Admin\UsersController → "admin/users"
        ];
        //dd($data);

        return view('admin/users/index', $data);
    }

    public function show(int $id)
    {
        $users = auth()->getProvider();
        $user  = $users
            ->withGroups()
            ->withPermissions()
            ->find($id);

        if (!$user) {
            return redirect()->to(url_to('users_index'))->with('error', 'Utente non trovato.');
        }

        $data = [
            'title'   => 'Dettagli Utente: ' . esc($user->username),
            'user'    => $user,
            'allGroups'      => config('AuthGroups')->groups,
            'allPermissions' => config('AuthGroups')->permissions,
        ];
        return view('admin/users/show', $data);
    }

    public function create()
    {
        $ejabberUsers = (new EjabberdUsersModel())->findAll();
        $data = [
            'title'  => 'Crea Nuovo Utente',
            'ejabberdUsers' => $ejabberUsers,
            'allGroups'      => config('AuthGroups')->groups,
            'allPermissions' => config('AuthGroups')->permissions,
        ];

        //dd($data);
        return view('admin/users/create', $data);
    }

    // public function edit($id)
    // {
    //     $users = auth()->getProvider();
    //     $user  = $users
    //         ->withGroups()
    //         ->withPermissions()
    //         ->find($id);

    //     if (!$user) {
    //         return redirect()->to(url_to('users_index'))->with('error', 'Utente non trovato.');
    //     }

    //     return view('admin/users/form', [
    //         'title'   => 'Modifica Utente: ' . esc($user->username),
    //         'mode'    => 'edit',
    //         'user'    => $user,
    //         'form'    => [
    //             // url_to('users_update', $id) genera /admin/users/{id} (la rotta PUT ha il placeholder (:num)).
    //             // Il form invia POST con spoof _method=PUT, che CI4 instradia su put('(:num)') → update()
    //             'action'     => url_to('users_update', $id),
    //             'method'     => 'POST',
    //             'spoof'      => 'PUT',
    //             'submitText' => 'Aggiorna',
    //             'readonly'   => false,
    //         ],
    //         'allGroups'      => config('AuthGroups')->groups,
    //         'allPermissions' => config('AuthGroups')->permissions,
    //     ]);
    // }

    /**
     * store() — crea un nuovo utente da backoffice (POST /utenti/).
     *
     * Shield tiene separati i dati base (username → tabella `users`) dalle
     * credenziali di accesso (email + password hashata → tabella `auth_identities`).
     * Assegnando email e password sull'entità prima del save(), Shield provvede
     * a creare entrambi i record in automatico.
     */
    public function store()
    {
        $users = auth()->getProvider();
        $data  = $this->request->getPost();

        // Validazione con rules nel controller
        $rules = $this->getValidationRules(null);
        if (!$this->validate($rules)){
            return redirect()->back()
                ->withInput() //Ripopola i campi input con old()
                ->with('errors', $users->errors()); 
        }

        // Validazione OK posso creare l'utente

        $user = new User([
            'username' => $data['username'],
            'email' => $data['email'],
            'ejabberd_nick' => $data['ejabberd_nick'],
            'password' => $data['password'],
        ]);

        $users->save($user);
        $id = $users->getInsertID();
        return redirect()->route('users_show', [$id])->with('success', 'Utente creato correttamente');

    }
        

       

        
    //     $newUser = $users->find($users->getInsertID());       

    //     $selectedGroups = $post['groups'] ?? [];
    //     foreach ($selectedGroups as $group) {
    //         try {
    //             $newUser->addGroup($group);
    //         } catch (DatabaseException $e) {
    //             log_message('error', "Errore nell'aggiungere utente al gruppo $group: " . $e->getMessage());
    //         }
    //     }


    //     $selectedPermissions = $post['permissions'] ?? [];
    //     foreach ($selectedPermissions as $permission) {
    //         try {
    //             $newUser->addPermission($permission);
    //         } catch (DatabaseException $e) {
    //             log_message('error', "Errore nell'aggiungere permesso $permission all'utente: " . $e->getMessage());
    //         }
    //     }

    //     return redirect()->to(route_to('users_index'))->with('success', 'Utente creato con successo.');
    // }

    // /**
    // * update() — salva le modifiche a un utente esistente (PUT /utenti/:id).
    // //  * Riceve l'ID dall'URL tramite method spoofing dal form di modifica.
    // //  */
    // // public function update($id)
    // // {
    // //     $users = auth()->getProvider();
    // //     $post  = $this->request->getPost();

    // //     $user = $users->find($id);
    // //     if (!$user) {
    // //         return redirect()->to(url_to('users_index'))->with('error', 'Utente non trovato.');
    // //     }

    // //     $user->username = $post['username'];
    // //     $user->email    = $post['email'];

    // //     if (!$users->save($user)) {
    // //         return redirect()->back()->withInput()
    // //             ->with('error', implode(', ', $users->errors()));
    // //     }

    // //     // Gestione gruppi: elimina tutti i gruppi attuali e riassegna quelli selezionati nel form.
    // //     // Si opera direttamente su DB perché Shield non espone un metodo "setGroups" atomico.
    // //     $db = db_connect();
    // //     $db->table('auth_groups_users')->where('user_id', $id)->delete();
    // //     $selectedGroups = $this->request->getPost('groups') ?? [];
    // //     foreach ($selectedGroups as $group) {
    // //         try {
    // //             $user->addGroup($group);
    // //         } catch (DatabaseException $e) {
    // //             log_message('error', "Errore nell'aggiungere utente al gruppo $group: " . $e->getMessage());
    // //         }
    // //     }

    // //     // Gestione permessi utente-level: stessa logica dei gruppi.
    // //     // I permessi individuali vivono in `auth_permissions_users`; azzeriamo e
    // //     // riassegnamo così un permesso deselezionato nel form viene effettivamente rimosso.
    // //     $db->table('auth_permissions_users')->where('user_id', $id)->delete();
    // //     $selectedPermissions = $this->request->getPost('permissions') ?? [];
    // //     foreach ($selectedPermissions as $permission) {
    // //         try {
    // //             $user->addPermission($permission);
    // //         } catch (DatabaseException $e) {
    // //             log_message('error', "Errore nell'aggiungere permesso $permission all'utente $id: " . $e->getMessage());
    // //         }
    // //     }

    // //     return redirect()->to(
    // //         $this->getBackTo(url_to('users_index'))
    // //     )->with('success', 'Utente aggiornato con successo.');
    // // }

    // // public function delete($id)
    // // {
    // //     $users = auth()->getProvider();
    // //     $user  = $users->find($id);

    // //     if (!$user) {
    // //         return redirect()->to(url_to('users_index'))->with('error', 'Utente non trovato.');
    // //     }

    // //     try {
    // //         $users->delete($id);
    // //     } catch (DatabaseException) {
    // //         return redirect()->to(url_to('users_index'))
    // //             ->with('error', 'Errore nell\'eliminazione utente.');
    // //     }

    // //     return redirect()->to(url_to('users_index'))
    // //         ->with('success', 'Utente eliminato con successo.');
    // // }

    // // public function changePassword()
    // // {
    // //     $user = auth()->user();
    // //     log_message('info', 'Request method: ' . $this->request->getMethod());
    // //     if ($this->request->getMethod() === 'POST') {
    // //         $rules = [
    // //             'current_password' => [
    // //                 'label'  => 'Password attuale',
    // //                 'rules'  => 'required|checkCurrentPassword',
    // //             ],
    // //             'new_password'     => [
    // //                 'label' => 'Nuova password',
    // //                 'rules' => 'required|min_length[8]|strong_password',
    // //             ],
    // //             'new_password_confirm' => [
    // //                 'label' => 'Conferma nuova password',
    // //                 'rules' => 'required|matches[new_password]',
    // //             ],
    // //         ];
    // //         log_message('info', 'Validazione con regole: ' . print_r($rules, true));
    // //         if (! $this->validate($rules)) {
    // //             return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    // //         }

    // //         // Aggiornamento password
    // //         $user->password = $this->request->getPost('new_password');
    // //         log_message('info', 'Nuovo oggetto user: ' . print_r($user, true));
    // //         $userModel = auth()->getProvider();
    // //         $userModel->save($user);

    // //         return redirect()->back()->with('success', 'Password aggiornata con successo.');
    // //     }

    // //     return view('admin/users/changePassword');
    // // }

    // // public function approva($id)
    // // {
    // //     $users      = auth()->getProvider();
    // //     $user       = $users->withGroups()->withPermissions()->find($id);
    // //     if (!$user) {
    // //         return redirect()->to(url_to('users_index'))->with('error', 'Utente non trovato.');
    // //     }

    // //     if (!in_array('pending', $user->getGroups())) {
    // //         return redirect()->to(url_to('users_index'))
    // //             ->with('error', 'L\'utente non è in stato pending.');
    // //     }

    // //     try {
    // //         $user->removeGroup('pending');
    // //         $user->addGroup('user');

    // //         // ==== Invio email di notifica approvazione ====
    // //         $admin = setting('SiteConfig.adminEmail');
    // //         $email = \Config\Services::email();
    // //         $email->setFrom($admin, 'MeTe Licenze Admin');
    // //         $email->setTo($user->email);
    // //         $email->setSubject('Account Approvato');
    // //         $content = "
    // //             <p>Ciao <strong>" . esc($user->username) . "</strong>,</p>
    // //             <p>Il tuo account è stato approvato. Ora puoi effettuare il login.</p>
    // //             <p><a href='" . setting('SiteConfig.siteURL') . "/login' class='button'>Accedi al gestionale</a></p>
    // //         ";
    // //         $message = view('emails/layout', [
    // //             'title'   => 'Account approvato su MeTe Licenze',
    // //             'content' => $content,
    // //         ]);
    // //         $email->setMessage($message);
    // //         $email->setMailType('html');
    // //         if (!$email->send()) {
    // //             log_message('error', "Errore nell'invio della mail di approvazione a {$user->email}: " . $email->printDebugger(['headers', 'subject', 'body']));
    // //         }
    // //     } catch (DatabaseException $e) {
    // //         log_message('error', "Errore nell'approvare utente $id: " . $e->getMessage());
    // //         return redirect()->to(url_to('users_index'))
    // //             ->with('error', 'Errore nell\'approvazione utente.');
    // //     }

    // //     return redirect()->to(url_to('users_index'))
    // //         ->with('success', 'Utente approvato con successo.');
    // // }
    private function getValidationRules(?int $id): array {
        $isUpdate = $id !== null;

        $CommonRules = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required|min_length[3]|max_length[30]|is_unique[users.username]',
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
            ],
        ];
        $PasswordRules = [];
        if ($isUpdate) {
            $PasswordRules = [
                'password' => [
                    'label' => 'Password',
                    'rules' => 'permit_empty|min_length[8]|strong_password',
                ],
                'password_conf' => [
                    'label' => 'Conferma Password',
                    'rules' => 'permit_empty|matches[password]',
                ],
            ];
        } else {
            $PasswordRules = [
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required|min_length[8]|strong_password',
                ],
                'password_conf' => [
                    'label' => 'Conferma Password',
                    'rules' => 'required|matches[password]',
                ],
            ];
        }
        $rules = array_merge($CommonRules, $PasswordRules);
        return $rules;

    }
}