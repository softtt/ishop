<?php

namespace Database\Seeders;

use App\Enums\Roles;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'admin2',
            'email' => 'admin2@mail.ru',
            'password' => Hash::make('adminadmin')
        ]);

        $adminRole = Role::findByName(Roles::SuperAdmin->value);
        $user->assignRole($adminRole);
    }
}
