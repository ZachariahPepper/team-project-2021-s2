<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\Pages\Login;
## currently commented because feature broke - sad
class EvidenceTest extends DuskTestCase
{
    # This file holds tests for Evidence function
    # Current tests include:
    #   -Creates new evidence for a specific student

    # Assertions: (expected outcomes)
    #   -New evidence is added for an existing user
    #   

    # Dependencies:
    # -Seeded data: admin user
    # -Seeded data: students seeder
    # -Seeded data: evidence seeder
    # -Login page

    # Selectors:
    # home-dashboard located in home.blade.php
    # evidence-drop-down located in evidence/create.blade.php
    # add-evidence-btn located in evidence/create.blade.php
    # url located in evidence/create.blade.php
    # description located in evidence/create.blade.php
    # evidence-dashboard located in  evidence/create.blade.php

    # Limitations:
    # -Reliant on LoginTest, so if it's broken test can't be run
    # -Only adds one piece of evidence to one student
    # -Does not currently explicity check for the evidence

    # Common Failure Points:
    # Not receiving data from the database
    # Database not correctly set up
    # Database issues with seeded user, students
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

//     public function testEvidenceCreation()
//     {
//         $this->browse(function ($browser) {
//             $browser
//             ->visit(new Login)
//             ->adminLogin('admin@admin.com', 'admin')
//             ->waitFor('@home-dashboard')            
//             ->visit('evidence/create')
//             ->waitFor('@add-evidence-btn')
//             ->select('@evidence-drop-down', 'Amye Perkis')
//             ->type('@url', 'https://www.google.com/')
//             ->type('@description', 'google dot com')
//             ->click('@add-evidence-btn')
//             ->waitFor('@evidence-dashboard')
//             ->assertPresent('@evidence-dashboard')
//             ;

//         });
//     }
//     public function testEditEvidence()
//     {
//         $this->browse(function($browser){
//             $browser
//             ->visit(new Login) #uses methods from Pages/Login
//             ->adminLogin('admin@admin.com', 'admin') #func defined in Pages/Login
//             ->waitFor('@home-dashboard')
//             ->visit('/students')
//             ->click('@submissions')
//             ->waitFor('@edit-evidence')
//             ->click('@edit-evidence')
//             ->waitFor('@edit-evidence-submit')
//             ->type('@evidence-url', 'www.notgoodgle.com/')
//             ->type('@evidence-url', 'www.notgoodgle.com/')
//             ->click('@edit-evidence-submit')
//             ->waitFor('@submissions')
//             ->assertSee('Evidence updated!')
//             ;
//         });
//     }

//     public function testDeleteEvidence()
//     {
//         $this->browse(function($browser){
//             $browser
//             ->visit(new Login)
//             ->adminLogin('admin@admin.com', 'admin')
//             ->waitFor('@home-dashboard')
//             ->visit('/students')
//             ->click('@submissions')
//             ->waitFor('@edit-evidence')
//             ->click('@evidence-delete')
//             ->waitFor('@back-students')
//             ->assertSee('Submission deleted!')
//             ;
//         });
//     }
    

    
    
}
