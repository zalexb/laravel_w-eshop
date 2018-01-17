<?php

use Illuminate\Database\Seeder;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('images')->insert([
            'id'=>1,
            'name'=>'Seamaster Automatic Blue Dial Men\'s Watch 1',
            'link'=>'armani1.jpg',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('images')->insert([
            'id'=>2,
            'name'=>'Seamaster Automatic Blue Dial Men\'s Watch 2',
            'link'=>'armani2.jpg',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('images')->insert([
            'id'=>3,
            'name'=>'Seamaster Automatic Blue Dial Men\'s Watch 3',
            'link'=>'armani3.jpg',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        //
        DB::table('images')->insert([
            'id'=>4,
            'name'=>'Seamaster Automatic Blue Dial Men\'s Watch 1',
            'link'=>'armani1.jpg',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('images')->insert([
            'id'=>5,
            'name'=>'Seamaster Automatic Blue Dial Men\'s Watch 2',
            'link'=>'armani2.jpg',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('images')->insert([
            'id'=>6,
            'name'=>'Seamaster Automatic Blue Dial Men\'s Watch 3',
            'link'=>'armani3.jpg',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        //
        DB::table('images')->insert([
            'id'=>7,
            'name'=>'Seamaster Automatic Blue Dial Men\'s Watch 1',
            'link'=>'armani1.jpg',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('images')->insert([
            'id'=>8,
            'name'=>'Seamaster Automatic Blue Dial Men\'s Watch 2',
            'link'=>'armani2.jpg',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('images')->insert([
            'id'=>9,
            'name'=>'Seamaster Automatic Blue Dial Men\'s Watch 3',
            'link'=>'armani3.jpg',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        //
        DB::table('images')->insert([
            'id'=>10,
            'name'=>'Seamaster Automatic Blue Dial Men\'s Watch 1',
            'link'=>'armani1.jpg',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('images')->insert([
            'id'=>11,
            'name'=>'Seamaster Automatic Blue Dial Men\'s Watch 2',
            'link'=>'armani2.jpg',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('images')->insert([
            'id'=>12,
            'name'=>'Seamaster Automatic Blue Dial Men\'s Watch 3',
            'link'=>'armani3.jpg',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        //
        DB::table('images')->insert([
            'id'=>13,
            'name'=>'Slider Watches 1',
            'slider'=>1,
            'link'=>'bnr-1.jpg',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('images')->insert([
            'id'=>14,
            'name'=>'Slider Watches 2',
            'slider'=>1,
            'link'=>'bnr-2.jpg',
            'created_at' => date("Y-m-d H:i:s")
        ]);
        DB::table('images')->insert([
            'id'=>15,
            'name'=>'Slider Watches 3',
            'slider'=>1,
            'link'=>'bnr-3.jpg',
            'created_at' => date("Y-m-d H:i:s")
        ]);

    }
}
