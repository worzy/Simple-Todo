<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Entities\User;
use App\Entities\Todo;

class TodoTest extends DuskTestCase
{

    use DatabaseMigrations;

    /**
     * Test that todos show
     *
     * @return void
     */
    public function test_todos_show()
    {
        $user = factory(User::class)->create([
            'email' => 'testlogin@user.com',
            'password' => bcrypt('secret'),
        ]);

        $todo = factory(Todo::class)->create([
            'user_id' => $user->id,
            'name' => 'My new fancy todo',
        ]);

        $response = $this->actingAs($user);

        // Page loads
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs(User::find($user->id))
                    ->visit('/')
                    ->waitForText('My new fancy todo')
                    ->assertSee('My new fancy todo');
        });

    }

    /**
     * Test that todos can be added
     *
     * @return void
     */
    public function test_add_todo()
    {
        $user = factory(User::class)->create([
            'email' => 'testlogin@user.com',
            'password' => bcrypt('secret'),
        ]);

        $response = $this->actingAs($user);

        // Page loads
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs(User::find($user->id))
                    ->visit('/')
                    ->keys('@add-todo-input', 'hello world 123', '{enter}')
                    ->waitForText('hello world 123')
                    ->assertSee('hello world 123');
        });

    }

    /**
     * Test that todos can be removed
     *
     * @return void
     */
    public function test_removing_todo()
    {
        $user = factory(User::class)->create([
            'email' => 'testlogin@user.com',
            'password' => bcrypt('secret'),
        ]);

        $todo = factory(Todo::class)->create([
            'user_id' => $user->id,
            'name' => 'My new fancy todo',
        ]);

        $response = $this->actingAs($user);

        // Page loads
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs(User::find($user->id))
                    ->visit('/')
                    ->waitForText('My new fancy todo')
                    ->assertSee('My new fancy todo')
                    ->click('@remove-button')
                    ->pause(2000)
                    ->assertSee("You're all done.");
        });

    }

    /**
     * Test that todos can be amended
     *
     * @return void
     */
    public function test_amending_todo()
    {
        $user = factory(User::class)->create([
            'email' => 'testlogin@user.com',
            'password' => bcrypt('secret'),
        ]);

        $todo = factory(Todo::class)->create([
            'user_id' => $user->id,
            'name' => 'My new fancy todo',
        ]);

        $response = $this->actingAs($user);

        // Page loads
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs(User::find($user->id))
                    ->visit('/')
                    ->waitForText('My new fancy todo')
                    ->assertSee('My new fancy todo')
                    ->click('@edit-todo')
                    ->keys('@edit-todo-input', 'hello world', '{enter}')
                    ->assertSee("My new fancy todohello world");
        });

    }


}
