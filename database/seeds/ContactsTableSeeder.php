<?php

use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('group_contacts')->truncate();
        DB::table('campaigns')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        factory(App\Models\Contact::class, 10)->create();
    }
}
