<?php

namespace Tests\Browser\Articles;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ArticleCreateTest extends DuskTestCase
{
    /** @test */
    public function test_user_can_create_article()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('https://ovl:444/')
                ->clickLink('Login')
                ->type('email', 'admin@gmail.com')
                ->type('password', 'admin')
                ->press('login')
                ->clickLink('Admin')
                ->clickLink('Articles')
                ->clickLink('Create new article')
                ->type('article_name', 'newArticleName123')
                ->type('author', 'newAuthorName123')
                ->type('description', 'newDescription123')
                ->press('Create Article')
                ->clickLink('51')
                ->assertSee('newArticleName123')
                ->assertSee('newAuthorName123');

        });
    }
}
