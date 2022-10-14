<?php

use App\Models\Article;
use App\Models\User;
use \Pest\Laravel;

beforeEach(function () {

    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');

});

test('Guest can\'t create article', function () {

    $this->postJson(route('article.store'))
        ->assertForbidden();

})->group('article-store-tests')->group('article-tests');

test('Admin can create article', function () {

    $admin = User::find(1);
    $article = Article::factory()->make();

    Laravel\be($admin)
        ->postJson(route('article.store'), $article->toArray())
        ->assertRedirect(route('article'));

    $this->assertDatabaseHas('articles', [
        'article_name' => $article->article_name,
        'author' => $article->author,
        'description' => $article->description
    ]);

})->group('article-store-tests')->group('article-tests');
