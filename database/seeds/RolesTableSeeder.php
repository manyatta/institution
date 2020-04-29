<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        Role::create(['role' => 'sadmin']);
        Role::create(['role' => 'iadmin']);
        Role::create(['role' => 'employer']);
        Role::create(['role'=>'alumni']);
    }
}
