<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert([
            'id'=>1,
            'name'=>'Men',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('categories')->insert([
            'id'=>2,
            'name'=>'Women',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('categories')->insert([
            'id'=>3,
            'name'=>'Kids',
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
