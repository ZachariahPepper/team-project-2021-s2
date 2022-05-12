<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class Students extends Page
{

    public function createStudent(Browser $browser, $name, $email, $git)
    {
        $browser
        ->click('@student-nav')
        ->waitfor('@create-student-button')
        ->click('@create-student-button')
        ->type('@student-name', $name)
        ->type('@student-email', $email)
        ->type('@student-git', $git)
        ->select('@student-courses-id', 1)
        ->click('@submit-student')
        ;
    }

    public function editStudent(Browser $browser, $index, $name)
    {
        $browser
        ->click("@edit-student-{$index}") #note to self, use double quotes for in line vars
        ->waitFor('@edit-student-name')
        ->type('@edit-student-name', $name)
        ->select('@edit-student-courses-id', 1)
        ->click('@edit-student-submit')
        ;
    }
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/students';
        
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
