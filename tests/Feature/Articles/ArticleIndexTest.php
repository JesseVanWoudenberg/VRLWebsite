<?php

use App\Models\Article;
use App\Models\User;
use \Pest\Laravel;

beforeEach(function (){

    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');

    $this->articles = Article::factory()->create();

});

it('Admin can access article index page', function () {

    $admin = User::find(1);
    Laravel\be($admin)
        ->get(route('article'))
        ->assertStatus(200);

})->group('article-index-tests')->group('article-tests');

it('Guest can\'t access article index page', function () {

    $guest = User::find(2);
    Laravel\be($guest)
        ->get(route('article'))
        ->assertForbidden();

})->group('article-index-tests')->group('article-tests');

it('Article index data is visible', function () {

    $admin = User::find(1);
        Laravel\be($admin)
            ->get(route('article'))
            ->assertStatus(200)
            ->assertSee($this->articles->article_name)
            ->assertSee($this->articles->author);

})->group('article-index-tests')->group('article-tests');
