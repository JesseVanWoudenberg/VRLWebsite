<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {

        $guest = User::factory()->create([
            'name' => 'guest',
            'email' => 'guest@gmail.com',
            'password' => Hash::make('guest')
        ]);
        $guest->assignRole('registered');
        $guest->givePermissionTo('article index');

        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin')
        ]);
        $admin->assignRole('admin');

        $reporter = User::factory()->create([
            'name' => 'reporter',
            'email' => 'reporter@gmail.com',
            'password' => Hash::make('reporter')
        ]);
        $reporter->assignRole('reporter');
    }
}
