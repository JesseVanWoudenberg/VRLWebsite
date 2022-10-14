<?php

use App\Models\User;
use \Pest\Laravel;

beforeEach(function () {

    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');

    User::factory()->create();

});

test('Guest can\'t access article create page', function () {

    $guest = User::find(2);
    Laravel\be($guest)
        ->get(route('article.create'))
        ->assertForbidden();


})->group('article-create-tests')->group('article-tests');

test('Admin can access article create page', function () {

    $admin = User::find(1);
    Laravel\be($admin)
        ->get(route('article.create'))
        ->assertStatus(200);

})->group('article-create-tests')->group('article-tests');

test('Reporter can access article create page', function () {

    $admin = User::find(3);
    Laravel\be($admin)
        ->get(route('article.create'))
        ->assertStatus(200);


})->group('article-create-tests')->group('article-tests');
