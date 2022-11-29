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

        $cruds = ['article', 'constructorchampionship', 'driverchampionship', 'driver', 'powerunit', 'race', 'season', 'team', 'track', 'user', 'role', 'permission'];

        foreach ($cruds as $crud)
        {
            Permission::create(['name' => $crud . ' index']);
            Permission::create(['name' => $crud . ' show']);
            Permission::create(['name' => $crud . ' create']);
            Permission::create(['name' => $crud . ' edit']);
            Permission::create(['name' => $crud . ' delete']);
        }

        Permission::create(['name' => 'user permissions']);

        Permission::create(['name' => 'penaltypoint index']);
        Permission::create(['name' => 'penaltypoint create']);
        Permission::create(['name' => 'penaltypoint edit']);

        Permission::create(['name' => 'tier index']);
        Permission::create(['name' => 'tier create']);
        Permission::create(['name' => 'tier delete']);

        // User profile permissions
        Permission::create(['name' => 'profile-show']);

        $registered = Role::create(['name' => 'registered'])->givePermissionTo('profile-show');

        $reporter = Role::create(['name' => 'reporter'])->givePermissionTo([
            'article index',
            'article show',
            'article create',
            'article edit',
            'article delete',
        ]);
        $reporter->givePermissionTo($registered->getAllPermissions());

        $steward = Role::create(['name' => 'steward'])->givePermissionTo($registered->getAllPermissions());

        $admin = Role::create(['name' => 'admin'])->givePermissionTo(Permission::all());

    }
}
