<?php

use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('templates')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        factory(\App\Models\Template::class, 10)->create();
    }
}
