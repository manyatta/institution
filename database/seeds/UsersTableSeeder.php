<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Institution;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //clearing the users and the user_roles tables before seeding
        User::truncate();
        DB::table('role_user')->truncate();
        DB::table('institution_user')->truncate();


        //Getting the roles from the roles table
        $superAdminRole = Role::where('role', 'sadmin')->first();
        $institutionAdminRole = Role::where('role','iadmin')->first();
        $employerRole = Role::where('role', 'employer')->first();
        $alumniRole = Role::where('role','alumni')->first();

        //$theInstitution = Institution::where('name','tum')->first();

        //Seeding users dummy data to the users table
        $super = User::create([
            'name' => 'Kaimenyi',
            'email' => 'super@admin.com',
            'password' => Hash::make('Secret.1996'),
        ]);

        $institution = User::create([
            'name' => 'Chiuri',
            'email' => 'instituion@admin.com',
            'password' => Hash::make('Secret.1996')
        ]);

        $employer = User::create([
            'name' => 'Martin',
            'email' => 'employer@admin.com',
            'password' => Hash::make('Secret.1996'),
        ]);

        $alumni = User::create([
            'name' => 'Mwema',
            'email' => 'alumni@alumni.com',
            'password' => Hash::make('Secret.1996'),
        ]);

        $super->roles()->attach($superAdminRole);
        $institution->roles()->attach($institutionAdminRole);
        $employer->roles()->attach($employerRole);
        $alumni->roles()->attach($alumniRole);

        //$institution->institutions()->attach($theInstitution);
    }
}
