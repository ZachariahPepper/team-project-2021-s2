<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\Pages\Login;
use Tests\Browser\Pages\createUser;

class RegistrationTest extends DuskTestCase
{
  # This file holds tests for the Registration function
    # Current tests include:
    #   -Registering a user
    #   -Checking for duplicate users

    # Assertions: (expected outcomes)
    #   -User has been registered
    #   -User email has already been taken

    # Dependencies: 
    #   -Seeded data: Admin user
    #   -Login Page
    #   -Register page

    # Selectors:
    #   home-dashboard located in home.blade.php
    #   dropdown located in home.blade.php
    #   register-button located in navbar.blade.php  

    # Limitations:
    # A lot of other tests hinge on this test, so this test must be maintained. 
    # Only checks if email is unique
    
    # Common Failure Points:
    # Database not set up correctly.
    # Database issues with seeded user.
    # Not receiving data correctly from database
    # Selectors removed from home or login page

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
     

    public function testRegistration()
    {
        // Test updated and works(as of sprint-4)
        $this->browse(function (Browser $browser) {
            
            $browser->visit(new Login) #uses methods from Pages/Login
                ->adminLogin('admin@admin.com', 'admin') #func defined in Pages/Login
                ->waitFor('@home-dashboard')
                ->click('@dropdown')
                ->click('@register-button')
                ->visit(new createUser) #uses methods from Pages/Register
                ->registeruser('Ghosty', 'ghostyboi@gmail.com', 'boo-boo-boo')
                ->waitFor('@create-user-button')
                ->assertSee("Ghosty")
                ;

        });
    }
    public function testDuplicateUser()
    {
        //tests that duplicate users are handled gracefully
        $this->browse(function (Browser $browser) {
            
            $browser->visit(new Login) #uses methods from Pages/Login
                ->adminLogin('admin@admin.com', 'admin') #func defined in Pages/Login
                ->waitFor('@home-dashboard')
                ->click('@dropdown')
                ->click('@register-button')
                ->visit(new createUser) #uses methods from Pages/Register
                ->registeruser('Ghosty', 'ghostyboi@gmail.com', 'boo-boo-boo') #func defined in Pages/Register
                ->visit(new createUser) 
                ->registeruser('Ghosty', 'ghostyboi@gmail.com', 'boo-boo-boo')
                ->waitFor('@register-submit')
                ->assertSee("The email has already been taken.")
                ;

        });
    }
}
