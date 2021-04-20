<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{

    public function run()
    {

        $admin = \App\Models\Admin::create([
            'name' => 'super_admin',
            'email' => 'super_admin@app.com',
            'password' => bcrypt('123456'),
            'image'   => 'default.png',
        ]);

        $admin->attachRole('super_admin');

    }
}
