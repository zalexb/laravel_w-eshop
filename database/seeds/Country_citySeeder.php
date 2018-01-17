<?php

use Illuminate\Database\Seeder;

class Country_citySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('countries')->insert([
            'id'=>1,
            'name'=>'Ukraine',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('countries')->insert([
            'id'=>2,
            'name'=>'England',
            'created_at' => date("Y-m-d H:i:s")
        ]);


        DB::table('cities')->insert([
            'id'=>1,
            'name'=>'Dnepr',
            'country_id'=>1,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('cities')->insert([
            'id'=>2,
            'name'=>'Kharkiv',
            'country_id'=>1,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('cities')->insert([
            'id'=>3,
            'name'=>'Kiev',
            'country_id'=>1,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('cities')->insert([
            'id'=>4,
            'name'=>'Lviv',
            'country_id'=>1,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('cities')->insert([
            'id'=>5,
            'name'=>'Odessa',
            'country_id'=>1,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('cities')->insert([
            'id'=>6,
            'name'=>'London',
            'country_id'=>2,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('cities')->insert([
            'id'=>7,
            'name'=>'Liverpool',
            'country_id'=>2,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('cities')->insert([
            'id'=>8,
            'name'=>'Manchester',
            'country_id'=>2,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('cities')->insert([
            'id'=>9,
            'name'=>'Cambridge',
            'country_id'=>2,
            'created_at' => date("Y-m-d H:i:s")
        ]);

    }
}
