<?php

use App\Models\Article;
use App\Models\User;
use \Pest\Laravel;

beforeEach(function () {

    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');

    User::factory()->create();

    $this->article = Article::factory()->create();

});

test('Guest can\'t update article', function () {

    $article = Article::find(1);

    $guest = User::find(2);
    Laravel\be($guest)
        ->patchJson(route('article.update', ['article' => $this->article->id]),
            array_merge($article->toArray()))
        ->assertForbidden();

})->group('article-update-tests')->group('article-tests');

test('Admin can update article', function () {

    $article = Article::find(1);

    $admin = User::find(1);
    Laravel\be($admin)
        ->patchJson(route('article.update', ['article' => $this->article->id]),

        ['article_name' => 'testname123',
            'author' => 'testauthor123',
            'description' => 'testdescription123']
        );

    $this->article = $this->article->fresh();

    $this->get(route('article'))
        ->assertSee('testname123')
        ->assertSee('testauthor123');

    $this->get(route('article'))
        ->assertSee($this->article->article_name)
        ->assertSee($this->article->author);

})->group('article-update-tests')->group('article-tests');
