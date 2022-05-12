<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class Login extends Page
{   
    # Pages are useful for functions of a page that will be reused often in different tests
    # This page has the login function often used on the /login page. 
    
    # Generate a page by using command <php artisan dusk:page PageName>

    public function adminLogin(Browser $browser, $user, $pass)
    #logs in using passed user and password variables.
    {
            $browser
            ->waitFor('@login-button')
            ->type('@login-email', $user)
            ->type('@login-password', $pass)
            ->click('@login-button')
            ;
    }

    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/login';
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
