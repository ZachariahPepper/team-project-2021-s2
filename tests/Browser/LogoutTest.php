<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\Pages\Login;

class LogoutTest extends DuskTestCase
{
    # This file holds tests for Logout function
    # Current tests include:
    #   -Logging in as admin user
    #   -Logging out 

    # Assertions: (expected outcomes)
    #   -Asserts that the user is returned to the login screen
    #   

    # Dependencies:
    # -Seeded data: admin user

    # Selectors:
    # home-dashboard located in home.blade.php
    # dropdown located in navbar.blade.php
    # logout-button located in navbar.blade.php
    # login-button located in login.blade.php

     # Limitations:
    # -Reliant on LoginTest, so if it's broken test can't be run
    # -Does not check if the user is unauthorised, only that the login page can be seen

    # Common Failure Points:
    # Not receiving data from the database
    # Database not correctly set up
    # Database issues with seeded user
    # Selectors removed (especially navbar changes)
    # Not using correct version of chrome driver`   

    # Run dusk tests by serving app, and then using command:
    #    <php artisan dusk> to run all dusk tests
    #    <php artisan dusk --filter testName> to run specific tests
    # Generate a new test file using command <php artisan dusk:make NameTest> 

    /**
     * A Dusk test example.
     *
     * @return void
     */

    
    protected function setUp() :void 
    #func runs before the start of each test. Resets enviroment so tests don't conflict with eachother
    {
        parent::setUp(); 
        $this->artisan('migrate:fresh');
        $this->artisan('db:seed');
        foreach (static::$browsers as $browser) {
            $browser->driver->manage()->deleteAllCookies();
        }
    }

    public function testLogout()
    {
        $this->browse(function ($browser) {
            $browser
            ->visit(new Login) #uses methods from Pages/Login
            ->adminLogin('admin@admin.com', 'admin') #func defined in Pages/Login
            ->waitFor('@home-dashboard')
            ->click('@dropdown')
            ->click('@logout')
            ->waitFor('@login-button')
            ->assertPresent('@login-button')
            ;
        });
    }
}
