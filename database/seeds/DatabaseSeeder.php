<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ImagesSeeder::class);
        $this->call(GoodsSeeder::class);
        $this->call(Good_imageSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(Good_categorySeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(Country_citySeeder::class);
    }
}
