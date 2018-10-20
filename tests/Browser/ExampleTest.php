<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Entities\User;

class HomePageTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test home loads
     *
     * @return void
     */
    public function test_home_loads()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Simple Todo')
                    ->assertSee('E-Mail Address')
                    ->assertSee('Register');
        });
    }

    /**
     * Test login page
     *
     * @return void
     */
    public function test_login()
    {
        $user = factory(User::class)->create([
            'email' => 'testlogin@user.com',
            'password' => bcrypt('secret'),
        ]);

        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Simple Todo')
                    ->assertSee('E-Mail Address')
                    ->assertSee('Register');
        });
    }
}
