<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
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
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        factory(App\Models\Group::class, 10)->create();
    }
}
