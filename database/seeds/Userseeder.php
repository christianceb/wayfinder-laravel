<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['email' => 'j393554@tafe.wa.edu.au', 'password' => Hash::make('mangoes4u5only')],
            ['email' => 'j393430@tafe.wa.edu.au', 'password' => Hash::make('mangoes4u5only')],
            ['email' => '20026909@tafe.wa.edu.au', 'password' => Hash::make('mangoes4u5only')]
        ]);
    }
}
