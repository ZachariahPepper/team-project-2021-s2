<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class createUser extends Page
{

    public function registeruser(Browser $browser, $user, $email, $pass)
    {
        // register a user
        $browser
        ->waitFor('@register-submit')
        ->type('@register-name', $user)
        ->type('@register-email', $email)
        ->type('@register-password', $pass)
        ->type('@register-password-confirmation', $pass)
        ->click('@select-course-2')
        ->click('@register-submit')
        ;
    }
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/users/create';
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
