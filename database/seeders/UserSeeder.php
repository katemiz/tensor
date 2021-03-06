<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                "name" =>'admin',
                "lastname" => 'admin',
                "email" => 'admin@admin.com',
                "email_verified_at" => now(),
                "password" => bcrypt('admin')
            ],
        );
    }
}
