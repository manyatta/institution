<?php

use Illuminate\Database\Seeder;
use App\Institution;

class InstitutionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Institution::truncate();
        // Institution::create([
        //     'name' => 'tum',
        //     'user_id' => 2
        //     ]);
    }
}
