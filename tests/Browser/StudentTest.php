<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\Pages\Login;
use Tests\Browser\Pages\Students;

class StudentTest extends DuskTestCase
{
        # This file holds tests for Student function
    # Current tests include:
    #   -Adds a new student
    #   -Edits a student which already exists
    #   -Deletes a student which already exists
    #   -Prevents user with duplicate email from being added via validation
    #   -prevents user with duplicate git from being added via validation

    # Assertions: (expected outcomes)
    #   -New student is added
    #   -Existing student is edited
    #   -Existing student is deleted
    #   -Student not added "The email has already been taken."
    #   -Student not added "The git has already been taken."

    # Dependencies:
    # -Seeded data: admin user
    # -Seeded data: student seeder
    # -Login page

    # Selectors:
    # home-dashboard located in home.blade.php
    # student-success located in students\index.blade.php
    # delete-student-2 located in students\index.blade.php
    # create-student-button located in students\index.blade.php


    # Limitations:
    # -Reliant on LoginTest, so if it's broken test can't be run
    # -Only checks one student

    # Common Failure Points:
    # Not receiving data from the database
    # Database not correctly set up
    # Database issues with seeded user
    # Selectors removed
    # Not using correct version of chrome driver

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

    public function testAddStudent()
    {
        $this->browse(function ($browser) {
            $browser
            ->visit(new Login) #uses methods from Pages/Login
            ->adminLogin('admin@admin.com', 'admin') #func defined in Pages/Login
            ->waitFor('@home-dashboard')
            ->visit(new Students)
            ->createStudent('SpookyBoi', 'SpookyBoi@bOO.com', 'SpookyBoi.git', 1)
            ->waitfor('@student-success')
            ->assertSee('Student created!')
            ;
        });
    }

    public function testDuplicateStudentName()
    {
        $this->browse(function ($browser) {
            $browser
            ->visit(new Login) #uses methods from Pages/Login
            ->adminLogin('admin@admin.com', 'admin') #func defined in Pages/Login
            ->waitFor('@home-dashboard')
            ->visit(new Students)
            ->createStudent('SpookyBoi', 'SpookyBoi@bOO.com', 'SpookyBoi.git', 1)
            ->waitfor('@student-success')
            ->assertSee('Student created!')
            ->visit(new Students)
            ->createStudent('SpookyBoi', 'SpookyBoi@bOO.com', 'SpookyBoi2.git', 1)
            ->waitfor('@student-email')
            ->assertSee('The email has already been taken.')
            ;
        });
    }

    public function testDuplicateStudentGit()
    {
        $this->browse(function ($browser) {
            $browser
            ->visit(new Login) #uses methods from Pages/Login
            ->adminLogin('admin@admin.com', 'admin') #func defined in Pages/Login
            ->waitFor('@home-dashboard')
            ->visit(new Students)
            ->createStudent('SpookyBoi', 'SpookyBoi@bOO.com', 'SpookyBoi.git', 1)
            ->waitfor('@student-success')
            ->assertSee('Student created!')
            ->visit(new Students)
            ->createStudent('SpookyBoi', 'SpookyBoi2@bOO.com', 'SpookyBoi.git', 1)
            ->waitfor('@student-email')
            ->assertSee('The github has already been taken.')
            ;
        });
    }

    public function testEditStudent()
    {
        $this->browse(function ($browser){
            $browser
            ->visit(new Login) #uses methods from Pages/Login
            ->adminLogin('admin@admin.com', 'admin') #func defined in Pages/Login
            ->waitFor('@home-dashboard')
            ->visit(new Students)
            ->editStudent(2, 'Casper the Ghost')
            ->waitfor('@student-success')
            ->assertSee('Student updated!')
            ;
        });
    }

    public function testDeleteStudent()
    {
        $this->browse(function ($browser){
            $index=2;
            $browser
            ->visit(new Login) #uses methods from Pages/Login
            ->adminLogin('admin@admin.com', 'admin') #func defined in Pages/Login
            ->waitFor('@home-dashboard')
            ->visit('/students')
            ->click("@delete-student-2")
            ->waitFor('@create-student-button')
            ->assertSee('Student deleted!') 
            ;
        });
    }
}
