<?php

use App\Models\Article;
use App\Models\User;
use \Pest\Laravel;

beforeEach(function () {

    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->article = Article::factory()->create();

    User::factory()->create();

});

test('Guest can\'t access article create page', function () {

    $guest = User::find(2);
    Laravel\be($guest)
        ->get(route('article.edit', ['article' => $this->article->id]))
        ->assertForbidden();

})->group('article-edit-tests')->group('article-tests');

test('Admin can access article create page', function () {

    $admin = User::find(1);
    Laravel\be($admin)
        ->get(route('article.edit', ['article' => $this->article->id]))
        ->assertSee($this->article->article_name)
        ->assertSee($this->article->author)
        ->assertSee($this->article->description)
        ->assertStatus(200);

})->group('article-edit-tests')->group('article-tests');
