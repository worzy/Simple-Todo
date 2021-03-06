<?php

use Illuminate\Database\Seeder;

class TodoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Entities\User::class, 1)->create([
            'email' => 'admin@admin.com'
        ])->each(function ($u) {

            $u->todos()->saveMany(factory(App\Entities\Todo::class, 20)->make());
        });
    }
}
