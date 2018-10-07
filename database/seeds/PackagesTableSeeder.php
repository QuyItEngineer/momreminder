<?php

use Illuminate\Database\Seeder;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('packages')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        factory(App\Models\Package::class)->create([
            'name' => 'Basic',
            'price' => 47.50,
            'credit' => 500,
            'description' =>'500 Text Message<br>
                            Unlimited Contacts<br>
                            Picture Messaging<br>
                            Rollover Texts',
            'status' => 0
        ]);

        factory(App\Models\Package::class)->create([
            'name' => 'Plus',
            'price' => 95.00,
            'credit' => 1000,
            'description' =>'1,000 Text Message<br>
                            Unlimited Contacts<br>
                            Picture Messaging<br>
                            Rollover Texts',
            'status' => 0
        ]);

        factory(App\Models\Package::class)->create([
            'name' => 'Pro',
            'price' => 337.50,
            'credit' => 4500,
            'description' =>'4,500 Text Message<br>
                            Unlimited Contacts<br>
                            Picture Messaging<br>
                            Rollover Texts',
            'status' => 0
        ]);
    }

}
