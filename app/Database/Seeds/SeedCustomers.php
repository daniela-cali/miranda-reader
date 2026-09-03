<?php

namespace App\Database\Seeds;

use App\Models\CustomersModel;
use CodeIgniter\Database\Seeder;

class SeedCustomers extends Seeder
{
    public function run()
    {
        $customer = new CustomersModel();
        $faker = \Faker\Factory::create();

        for($i=0;$i<50;$i++){
            $customer->save([
                'name' => $faker->name,
                'email' => $faker->email
            ]);
        }
    }
}
