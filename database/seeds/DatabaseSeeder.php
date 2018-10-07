<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleAndPermissionSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
        $this->call(TemplateSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(CallsTableSeeder::class);
        $this->call(PackagesTableSeeder::class);
    }
}
