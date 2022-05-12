<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\Pages\Login;
use Tests\Browser\Pages\Notes;

class NoteTest extends DuskTestCase
{
    # This file holds tests for Notes function
    # Current tests include:
    #   Creating a note about a specific student

    # Assertions: (expected outcomes)
    #   -New note is added for an existing user
    #   

    # Dependencies:
    # -Seeded data: admin user
    # -Seeded data: notes seeder
    # -Login page

    # Selectors:
    # home-dashboard located in home.blade.php
    # note-nav located in navbar.blade.php
    # add-note-btn located in notes\create.blade.php
    # note located in notes\create.blade.php
    # note-drop-down located in notes\create.blade.php
    # notes-dashboard located in notes\create.blade.php

    # Limitations:
     # -Reliant on LoginTest, so if it's broken test can't be run
    #  -Only creates one note for one student

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


     # Run dusk tests by serving app, and then using command:
    #    <php artisan dusk> to run all dusk tests
    #    <php artisan dusk --filter <testName> to run specific tests
    # Generate a new test file using command <php artisan dusk:make NameTest> 

    /**
     * A Dusk test example.
     *
     * @return void
     */

    public function setUp() :void
    {
        parent::setUp(); 
        $this->artisan('migrate:fresh');
        $this->artisan('db:seed');
        foreach (static::$browsers as $browser) {
            $browser->driver->manage()->deleteAllCookies();
            }
    }
    public function testNoteCreation()
    {
        //creates a note and check it is saved.
        $this->browse(function (Browser $browser) {
            $browser
            ->visit(new Login) #uses methods from Pages/Login
            ->adminLogin('admin@admin.com', 'admin') #func defined in Pages/Login
            ->waitFor('@home-dashboard')
            ->click('@note-nav')
            ->waitFor('@add-note-btn') 
            ->select('@note-drop-down', 'Malinde Petrasso')
            ->type('@note', 'Is doing amazingly')
            ->click('@add-note-btn')
            ->waitFor('@notes-dashboard')
            ->assertSee('Note saved!')
            ;
        });
    }

    public function testEditNote()
    {
        //creates a note and check it is saved.
        $this->browse(function (Browser $browser) {
            $browser
            ->visit(new Login) #uses methods from Pages/Login
            ->adminLogin('admin@admin.com', 'admin') #func defined in Pages/Login
            ->waitFor('@home-dashboard')
            ->visit('/students')
            ->click('@submissions')
            ->waitFor('@edit-notes')
            ->click('@edit-notes')
            ->waitFor('@notes-input')
            ->type('@notes-input', 'changed note')
            ->click('@edit-note-submit')
            ->click('@submissions')
            ->waitFor('@edit-notes')
            ->assertSee('changed note')
            ;
        });
    }

    public function testDeleteNote()
    {
        //creates a note and check it is saved.
        $this->browse(function (Browser $browser) {
            $browser
            ->visit(new Login) #uses methods from Pages/Login
            ->adminLogin('admin@admin.com', 'admin') #func defined in Pages/Login
            ->waitFor('@home-dashboard')
            ->visit('/students')
            ->click('@submissions')
            ->waitFor('@edit-notes')
            ->click('@delete-notes')
            ->waitFor('@back-students')
            ->assertSee('Note deleted!')
            ;
        });
    }
}