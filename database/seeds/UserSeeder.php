<?php

use App\User;
use Illuminate\Database\Seeder;
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
        $user = new User();
        $user->name = 'Rahim Ahmed';
        $user->email = 'admin@gmail.com';
        $user->password = Hash::make('12345');
        $user->save();
    }
}
