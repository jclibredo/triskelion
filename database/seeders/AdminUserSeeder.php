<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@triskelion.org'],
            [
                'name'         => 'System Administrator',
                'password'     => Hash::make('AdminPassword123!'),
                'accountType'  => 'ADMIN',
                'typeid'       => null,
                'mobilenumber' => 9123456789,
                'status'       => true,
            ]
        );
    }
}
