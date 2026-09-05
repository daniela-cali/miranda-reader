<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Entities\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $users = new UserModel();

        $user = new User([
            'username' => 'admin',
            'active'   => true,
        ]);

        $users->save($user);

        $user = $users->findById($users->getInsertID());
        $user->addGroup('superadmin');

        $user->createEmailIdentity([
            'email'    => 'ejabberdmiranda@gmail.com',
            'password' => 'CK10cpMirandaReaderEjabberd2026!',
        ]);
    }
}