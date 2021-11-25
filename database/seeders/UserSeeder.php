<?php

namespace Database\Seeders;
use App\Models\User;
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
        $admin = new User();
        $admin->first_name = "Md. Abu Bakkar";
        $admin->last_name = "Siddik";
        $admin->username = "anik";
        $admin->phone = "017XXXXXXXX";
        $admin->image = "image.jpg";
        $admin->email = "anik@gmail.com";
        $admin->enrollment = "517890";
        $admin->designation = "Assistant Officer, IT";
        $admin->password = Hash::make('123456');
        $admin->is_admin = 1;
        $admin->save();
        $admin->assignRole('Super Admin');

        $admin = new User();
        $admin->first_name = "Asif";
        $admin->last_name = "Habib";
        $admin->username = "asif";
        $admin->phone = "019XXXXXXXX";
        $admin->image = "image.jpg";
        $admin->email = "asif@gmail.com";
        $admin->enrollment = "517891";
        $admin->designation = "Assistant Officer, IT";
        $admin->password = Hash::make('123456');
        $admin->is_admin = 0;
        $admin->save();
        $admin->assignRole('Admin');
    }
}
