<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\Pages\Login;


class LoginTest extends DuskTestCase
{
    # This file holds tests for Login function
    # Current tests include:
    #   -Logging in with correct username and password
    #   -Logging in with incorrect username and password

    # Assertions: (expected outcomes)
    #   -User has been Authenticated
    #   -User details do not match records

    # Dependencies: 
    #   -Seeded data: Admin user
    #   -Login Page

    # Selectors:
    #   home-dashboard located in home.blade.php
    #   login-button located in auth\login.blade.php
    #   login-password located in auth\login.blade   
    #   login-email located in auth\login.blade   

    # Limitations:
    # A lot of other tests hinge on this test, so this test must be maintained. 
    # only checks whether a user is authenticated 
    # doesn't discriminate between regular users, and admins
    
    # Common Failure Points:
    # Database not set up correctly.
    # Database issues with seeded user.
    # Not receiving data correctly from database
    # Selectors removed from home or login page

    
    
    #Command Guide:
    # Generate a new test file using command <php artisan dusk:make NameTest>
    # Run dusk tests by serving app, and then using command:
    #    <php artisan dusk> to run all dusk tests
    #    <php artisan dusk --filter <testName> to run specific tests
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

    public function testLoginWithCorrectPass()
    {
        
        $this->browse(function ($browser) {
            $browser
            ->visit(new Login) #uses methods from Pages/Login
            ->adminLogin('admin@admin.com', 'admin') #func defined in Pages/Login
            ->waitFor('@home-dashboard')
            ->assertAuthenticated();
        });
    }
   
    public function testLoginWithIncorrectPass()
    {
        $this->browse(function ($browser) {
            $browser
            ->visit(new Login) #uses methods from Pages/Login
            ->adminLogin('admin@admin.com', 'badpass') #func defined in Pages/Login
            ->waitFor('@login-button')
            ->assertSee('These credentials do not match our records');
        });
    }
}
