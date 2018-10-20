<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Entities\User;

class AuthTest extends DuskTestCase
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
        $email = "testlogin@user.com";
        $password = "secret";

        $user = factory(User::class)->create([
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        // Page loads
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Simple Todo')
                    ->assertSee('E-Mail Address')
                    ->assertSee('Register');
        });

        // Login validation test
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->type('email', 'notmy@email.com')
                    ->type('password', 'hello')
                    ->press('Login')
                    ->assertSee('These credentials do not match our records.');
        });

        //Login works
        $this->browse(function (Browser $browser) use ($email, $password) {
            $browser->visit('/')
                    ->type('email', $email)
                    ->type('password', $password)
                    ->press('Login')
                    ->assertSee('Todos');
        });
    }
}
