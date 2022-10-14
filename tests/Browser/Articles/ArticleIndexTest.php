<?php

namespace Tests\Browser\Articles;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ArticleIndexTest extends DuskTestCase
{
    /** @test */
    public function test_user_can_access_article_index_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('https://ovl:444/')
                    ->clickLink('Login')
                    ->type('email', 'admin@gmail.com')
                    ->type('password', 'admin')
                    ->press('login')
                    ->clickLink('Admin')
                    ->clickLink('Articles')
                    ->assertSee('ARTICLE NAME')
                    ->assertSee('AUTHOR')
                    ->seeLink('Create new article');
        });
    }
}
