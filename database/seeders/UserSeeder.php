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
        $admin->first_name = "Super";
        $admin->last_name = "Admin";
        $admin->username = "superadmin";
        $admin->phone = "017XXXXXXXX";
        $admin->image = "image.jpg";
        $admin->email = "superadmin@gmail.com";
        $admin->enrollment = "0007";
        $admin->designation_id = 1;
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
        $admin->designation_id = 2;
        $admin->password = Hash::make('123456');
        $admin->is_admin = 0;
        $admin->save();
        $admin->assignRole('Admin');
    }
}
