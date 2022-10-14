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

test('Guest can\'t see delete article page', function () {

    $guest = User::find(2);
    Laravel\be($guest)
        ->get(route('article.delete', ['article' => $this->article->id]))
        ->assertForbidden();

})->group('article-delete-tests')->group('article-tests');

test('Admin can see delete article page', function () {

    $admin = User::find(1);
    Laravel\be($admin)
        ->get(route('article.delete', ['article' => $this->article->id]))
        ->assertSee($this->article->article_name)
        ->assertSee($this->article->author)
        ->assertSee($this->article->description)
        ->assertStatus(200);


})->group('article-delete-tests')->group('article-tests');

