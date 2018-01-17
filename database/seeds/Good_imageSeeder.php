<?php

use Illuminate\Database\Seeder;

class Good_imageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('good_image')->insert([
            'good_id'=>1,
            'image_id'=>1,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('good_image')->insert([
            'good_id'=>1,
            'image_id'=>2,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('good_image')->insert([
            'good_id'=>1,
            'image_id'=>3,
            'created_at' => date("Y-m-d H:i:s")
        ]);

///
        DB::table('good_image')->insert([
            'good_id'=>2,
            'image_id'=>4,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('good_image')->insert([
            'good_id'=>2,
            'image_id'=>5,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('good_image')->insert([
            'good_id'=>2,
            'image_id'=>6,
            'created_at' => date("Y-m-d H:i:s")
        ]);

///
        DB::table('good_image')->insert([
            'good_id'=>3,
            'image_id'=>7,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('good_image')->insert([
            'good_id'=>3,
            'image_id'=>8,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('good_image')->insert([
            'good_id'=>3,
            'image_id'=>9,
            'created_at' => date("Y-m-d H:i:s")
        ]);
    ///
        DB::table('good_image')->insert([
            'good_id'=>4,
            'image_id'=>10,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('good_image')->insert([
            'good_id'=>4,
            'image_id'=>11,
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('good_image')->insert([
            'good_id'=>4,
            'image_id'=>12,
            'created_at' => date("Y-m-d H:i:s")
        ]);

    }
}
