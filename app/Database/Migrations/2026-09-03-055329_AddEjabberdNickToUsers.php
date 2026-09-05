<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEjabberdNickToUsers extends Migration
{
    public function up()
    {
        $fields =[
            'ejabberd_nick' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true //Null true perché Admin inserito via seeder non ha nick, serve solo per gestire il backend
            ]
        ];
        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'ejabberd_nick');
    }
}

