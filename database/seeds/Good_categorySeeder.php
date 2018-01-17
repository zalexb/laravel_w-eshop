<?php

use Illuminate\Database\Seeder;

class Good_categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('good_category')->insert([
            'good_id'=>1,
            'category_id'=>1,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('good_category')->insert([
            'good_id'=>2,
            'category_id'=>1,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('good_category')->insert([
            'good_id'=>3,
            'category_id'=>2,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('good_category')->insert([
            'good_id'=>4,
            'category_id'=>3,
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
