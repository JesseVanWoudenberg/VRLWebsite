<?php

namespace Tests\Browser\Articles;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ArticleEditTest extends DuskTestCase
{
    /** @test */
    public function test_user_can_edit_article()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('https://ovl:444/')
                ->clickLink('Login')
                ->type('email', 'admin@gmail.com')
                ->type('password', 'admin')
                ->press('login')
                ->clickLink('Admin')
                ->clickLink('Articles')
                ->clickLink('Edit')
                ->type('article_name', 'newArticleName12345')
                ->type('author', 'newAuthorName12345')
                ->type('description', 'newDescription12345')
                ->press('edit')
                ->assertSee('newArticleName12345')
                ->assertSee('newAuthorName12345');
        });
    }
}
