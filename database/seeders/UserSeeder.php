<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        $admin = User::factory()->create([
            'name' => 'Ijesseeee',
            'email' => 'Ijesseee@gmail.com',
            'password' => Hash::make('123')
        ]);
        $admin->assignRole(Role::all()->where('name', '=', 'admin')->first());

        $admin = User::factory()->create([
            'name' => 'maxette',
            'email' => 'mishowbizjr@gmail.com',
            'password' => Hash::make('123')
        ]);
        $admin->assignRole(Role::all()->where('name', '=', 'admin')->first());
    }
}
