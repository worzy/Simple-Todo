<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Entities\User;
use App\Entities\Todo;

class TodoTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Test creating a todo.
     *
     * @return void
     */
    public function test_creating_a_todo()
    {
        $user = factory(User::class)->create([
            'email' => 'testlogin@user.com',
            'password' => bcrypt('secret'),
        ]);

        $response = $this->actingAs($user);

        $payload = ['name' => 'My first todo'];

        $this->json('POST', 'todos', $payload)
            ->assertStatus(200)
            ->assertJson([
                    'name' => 'My first todo'
                ]);
    }

    /**
     * Test creating a todo unauthenticated.
     *
     * @return void
     */
    public function test_creating_a_todo_unauthenticated()
    {

        $payload = ['name' => 'My first todo'];

        $this->json('POST', 'todos', $payload)
            ->assertStatus(401);
    }

    /**
     * Test creating a todo unauthenticated.
     *
     * @return void
     */
    public function test_updating_a_todo()
    {
        $user = factory(User::class)->create([
            'email' => 'testlogin@user.com',
            'password' => bcrypt('secret'),
        ]);

        $todoName = 'Test 1234';

        $todo = $user->todos()->save(new Todo(['name' =>  $todoName]));

        $response = $this->actingAs($user);

        $payload = ['name' =>  $todoName];

        $this->json('PUT', "todos/{$todo->id}", $payload)
            ->assertStatus(200);

        $this->json('GET', 'todos')
            ->assertStatus(200)
            ->assertJson([[
                "name" =>  $todoName
            ]]);
    }

    /**
     * Test creating a todo unauthenticated.
     *
     * @return void
     */
    public function test_updating_a_todo_other_user()
    {
        $user = factory(User::class)->create([
            'email' => 'testlogin@user.com',
            'password' => bcrypt('secret'),
        ]);

        $user2 = factory(User::class)->create([
            'email' => 'testlogin1@user.com',
            'password' => bcrypt('secret'),
        ]);

        $todo = $user2->todos()->save(new Todo(['name' => 'Test 123']));

        $response = $this->actingAs($user);

        $payload = ['name' => 'Bad update'];

        $this->json('PUT', "todos/{$todo->id}", $payload)
            ->assertStatus(403);
    }
}
