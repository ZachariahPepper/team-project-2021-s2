<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class Notes extends Page
{

    public function createNote(Browser $browser, $name, $comment)
    {
        $browser
        ->pause(1000)
        ->waitFor('@add-btn')
        ->select('@note-drop-down', $name)
        ->type('@note', $comment)
        ->click('@add-btn')
        ;
    }


    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/notes/create';
        
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@element' => '#selector',
        ];
    }
}
