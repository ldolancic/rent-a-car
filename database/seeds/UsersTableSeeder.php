<?php

use Illuminate\Database\Seeder;

use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Luka',
            'last_name' => 'Dolancic',
            'email' => 'lukadolancic@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        User::create([
            'first_name' => 'Regular',
            'last_name' => 'User',
            'email' => 'regular@user.com',
            'password' => bcrypt('password'),
            'role' => 'regular'
        ]);
    }
}
