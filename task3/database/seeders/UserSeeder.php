<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
        $user->email = "admin@admin.com";
        $user->admin = 1;
        $user->password = bcrypt("123456789");
        $user->name = "admin";
        $user->save();
    }
}
