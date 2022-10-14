<?php

namespace Tests\Browser\Articles;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ArticleDeleteTest extends DuskTestCase
{
    /** @test */
    public function test_user_can_delete_article()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('https://ovl:444/')
                ->clickLink('Login')
                ->type('email', 'admin@gmail.com')
                ->type('password', 'admin')
                ->press('login')
                ->clickLink('Admin')
                ->clickLink('Articles')
                ->clickLink('51')
                ->clickLink('Delete')
                ->press('delete');
        });
    }
}
