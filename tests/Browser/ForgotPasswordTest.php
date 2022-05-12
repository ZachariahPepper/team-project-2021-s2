<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\Pages\Login;
use Tests\Browser\Pages\createUser;

class ForgotPasswordTest extends DuskTestCase
{
      # This file holds tests for the Forgot Password function
    # Current tests include:
    #   -Registering a user
    #   -Forgot Password feature


    # Assertions: (expected outcomes)
    #   -User has been registered
    #   -User email has been sent link for a new password

    # Dependencies: 
    #   -Login Page
    #   -Register page
    #   -Forgot Password page

    # Selectors:
    #   -home-dashboard located in home.blade.php
    #   -dropdown located in home.blade.php
    #   -register-button located in navbar.blade.php
    #   -forgotPasswordBtn located in login.blade.php
    #   -sendResetBtn located in paswords/email.blade.php
    #   -forgot-email located in passwords/email.blade.php  

    # Limitations:
    #   -Reliant on LoginTest, so if it's broken test can't be run
    
    # Common Failure Points:
    #   -Database not set up correctly.
    #   -Database issues with seeded user.
    #   -Not receiving data correctly from database
    #   -Selectors removed from home or login page


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

    public function testRegistrationPasswordForget()
    {
        $this->browse(function (Browser $browser){
            $browser->visit(new Login) #uses methods from Pages/Login
            ->adminLogin('admin@admin.com', 'admin') #func defined in Pages/Login
            ->waitFor('@home-dashboard')
            ->click('@dropdown')
            ->click('@register-button')
            ->visit(new createUser) #uses methods from Pages/Register
            ->registeruser('Test', 'test@test.com', 'testing123')
            ->waitFor('@create-user-button')
            ->assertSee("Test")
            ;
    });
    }
    public function testForgotPassword()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new Login) #uses methods from Pages/Login 
            ->click('@forgotPasswordBtn')
            ->waitFor('@sendResetBtn')
            ->type('@forgot-email', 'test@test.com')
            ->click('@sendResetBtn')
            ;
        });
        
    }
}
