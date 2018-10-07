<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::table('social_accounts')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        //Default admin
        factory(App\Models\User::class)->create([
           'email' => 'admin@example.com',
           'name' => 'Administrator',
           'username' => 'admin',
        ]);

        // Default user
        $user = factory(App\Models\User::class)->create([
            'email' => 'user@example.com',
            'name' => 'User',
            'username' => 'user',
        ]);



        /** @var \App\Models\User $user */
        $user = \App\Models\User::whereEmail('admin@example.com')->first();
        $user->assignRole('admin');
        $user = \App\Models\User::whereEmail('user@example.com')->first();
        $user->assignRole('user');
    }
}
