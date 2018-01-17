<?php

use Illuminate\Database\Seeder;

class GoodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('goods')->insert([
            'id'=>1,
            'name'=>'Seamaster Automatic Blue Dial',
            'price'=> 3250,
            'discount_percent'=>50,
            'description'=>'This Men\'s Emporio Armani watch has a stainless steel case and clear, classy looking black dial with silver baton hour markers and other elegant silver touches. Also features chronograph, date function and powered by a quality quartz movement. The watch fastens with a chunky stainless steel bracelet.',
            'brand'=>'Emporio Armani',
            'case_width_approx_mm'=>43,
            'case_depth_approx_mm'=>11,
            'case_material'=>'Stainless Steel',
            'main_id_img'=>1,
            'water_resistancy_m'=>50,
            'public'=>1,
            'guarantee'=>'Emporio Armani 2 year guarantee',
            'color'=>'black',
            'alias'=>'Seamaster_Automatic_Blue_Dial_1',
            'MPN'=>'AR2434',
            'created_at' => date("Y-m-d H:i:s")
        ]);
//
        DB::table('goods')->insert([
            'id'=>2,
            'name'=>'Seamaster Automatic Blue Dial',
            'price'=> 3250,
            'discount_percent'=>50,
            'description'=>'This Men\'s Emporio Armani watch has a stainless steel case and clear, classy looking black dial with silver baton hour markers and other elegant silver touches. Also features chronograph, date function and powered by a quality quartz movement. The watch fastens with a chunky stainless steel bracelet.',
            'brand'=>'Emporio Armani',
            'case_width_approx_mm'=>43,
            'case_depth_approx_mm'=>11,
            'case_material'=>'Stainless Steel',
            'main_id_img'=>4,
            'water_resistancy_m'=>50,
            'public'=>1,
            'guarantee'=>'Emporio Armani 2 year guarantee',
            'alias'=>'Seamaster_Automatic_Blue_Dial_2',
            'color'=>'black',
            'MPN'=>'AR2434',
            'created_at' => date("Y-m-d H:i:s")
        ]);
//
        DB::table('goods')->insert([
            'id'=>3,
            'name'=>'Seamaster Automatic Blue Dial',
            'price'=> 3250,
            'discount_percent'=>50,
            'description'=>'This Men\'s Emporio Armani watch has a stainless steel case and clear, classy looking black dial with silver baton hour markers and other elegant silver touches. Also features chronograph, date function and powered by a quality quartz movement. The watch fastens with a chunky stainless steel bracelet.',
            'brand'=>'Emporio Armani',
            'case_width_approx_mm'=>43,
            'case_depth_approx_mm'=>11,
            'case_material'=>'Stainless Steel',
            'main_id_img'=>7,
            'water_resistancy_m'=>50,
            'public'=>1,
            'guarantee'=>'Emporio Armani 2 year guarantee',
            'color'=>'black',
            'MPN'=>'AR2434',
            'alias'=>'Seamaster_Automatic_Blue_Dial_3',
            'created_at' => date("Y-m-d H:i:s")
        ]);
//
        DB::table('goods')->insert([
            'id'=>4,
            'name'=>'Seamaster Automatic Blue Dial',
            'price'=> 3250,
            'discount_percent'=>50,
            'description'=>'This Men\'s Emporio Armani watch has a stainless steel case and clear, classy looking black dial with silver baton hour markers and other elegant silver touches. Also features chronograph, date function and powered by a quality quartz movement. The watch fastens with a chunky stainless steel bracelet.',
            'brand'=>'Emporio Armani',
            'case_width_approx_mm'=>43,
            'case_depth_approx_mm'=>11,
            'case_material'=>'Stainless Steel',
            'main_id_img'=>10,
            'water_resistancy_m'=>50,
            'public'=>1,
            'guarantee'=>'Emporio Armani 2 year guarantee',
            'alias'=>'Seamaster_Automatic_Blue_Dial_4',
            'color'=>'black',
            'MPN'=>'AR2434',
            'created_at' => date("Y-m-d H:i:s")
        ]);




    }
}
