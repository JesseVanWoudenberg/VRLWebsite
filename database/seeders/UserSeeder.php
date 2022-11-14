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

        $guest = User::factory()->create([
            'name' => 'guest',
            'email' => 'guest@gmail.com',
            'password' => Hash::make('guest')
        ]);
        $guest->assignRole(Role::all()->where('name', '=', 'registered')->first());

        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin')
        ]);
        $admin->assignRole(Role::all()->where('name', '=', 'admin')->first());

        $reporter = User::factory()->create([
            'name' => 'reporter',
            'email' => 'reporter@gmail.com',
            'password' => Hash::make('reporter')
        ]);
        $reporter->assignRole(Role::all()->where('name', '=', 'reporter')->first());

        $steward = User::factory()->create([
            'name' => 'steward',
            'email' => 'steward@gmail.com',
            'password' => Hash::make('steward')
        ]);
        $steward->assignRole(Role::all()->where('name', '=', 'steward')->first());
    }
}
