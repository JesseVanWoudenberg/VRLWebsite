<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $cruds = ['article', 'constructorchampionship', 'driverchampionship', 'driver', 'powerunit', 'race', 'season', 'team', 'tier', 'track', 'user'];

        foreach ($cruds as $crud)
        {
            Permission::create(['name' => $crud . ' index']);
            Permission::create(['name' => $crud . ' show']);
            Permission::create(['name' => $crud . ' create']);
            Permission::create(['name' => $crud . ' edit']);
            Permission::create(['name' => $crud . ' delete']);
            Permission::create(['name' => $crud . ' all']);
        }

        Permission::create(['name' => 'user permissions']);

        // User profile permissions
        Permission::create(['name' => 'profile-show']);

        $registered = Role::create(['name' => 'registered'])->givePermissionTo('profile-show');

        $reporter = Role::create(['name' => 'reporter'])->givePermissionTo([
            'article all'
        ]);
        $reporter->givePermissionTo($registered->getAllPermissions());

        $steward = Role::create(['name' => 'steward']);
        $steward->givePermissionTo($registered->getAllPermissions());

        $admin = Role::create(['name' => 'admin'])->givePermissionTo(Permission::all());

    }
}
