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

test('Guest can\'t destroy an article', function () {

    $guest = User::find(2);
    Laravel\be($guest);

        $this->json('DELETE', route('article.destroy', ['article' => $this->article->id]))
            ->assertForbidden();

})->group('article-destroy-tests')->group('article-tests');

test('Admin can destroy an article', function () {


    $admin = User::find(1);
    Laravel\be($admin);

    $this->json('DELETE', route('article.destroy', ['article' => $this->article->id]));

    $this->assertDatabaseMissing('articles', ['id' => $this->article->id]);

})->group('article-destroy-tests')->group('article-tests');
