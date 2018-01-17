<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->truncate();
        DB::table('roles')->truncate();
        DB::table('role_users')->truncate();

        $admin=[
           'name'=>'Admin',
           'slug'=>'admin',
           "permissions"=> [
                "user.create" => true,
                "user.delete" => true,
                "user.view"   => true,
                "user.update" => true,
                "good.create" => true,
                "good.delete" => true,
                "good.view"   => true,
                "good.update" => true,
                "order.create" => true,
                "order.delete" => true,
                "order.view"   => true,
                "order.update" => true,
               "comment.delete" => true,
               "comment.update" => true,
            ],
            'created_at' => date("Y-m-d H:i:s")];

        $adminRole = Sentinel::getRoleRepository()->createModel()-> create($admin);

        $manager = [
           'name'=>'Manager',
           'slug'=>'manager',
            "permissions"=> [
                "user.create" => false,
                "user.delete" => false,
                "user.view"   => true,
                "user.update" => false,
                "good.create" => true,
                "good.delete" => true,
                "good.view"   => true,
                "good.update" => true,
                "order.create" => true,
                "order.delete" => true,
                "order.view"   => true,
                "order.update" => true,
                "comment.delete" => true,
                "comment.update" => true,
            ],
            'created_at' => date("Y-m-d H:i:s")
        ];
        $managerRole = Sentinel::getRoleRepository()->createModel()->create($manager);

        $userRole = [
           'name'=>'User',
           'slug'=>'user',
            'created_at' => date("Y-m-d H:i:s")
        ];
        $userRole = Sentinel::getRoleRepository()->createModel()->create($userRole);


        $adminUse = [
            'email'    => 'whoiam942@gmail.com',
            'password' => 'whoiam942',
            'first_name' => 'Alex',
            'last_name' => 'Br',
            'phone' => '380945543213'
        ];

        $adminUser = Sentinel::registerAndActivate($adminUse);

        $adminRole->users()->attach($adminUser);

    }
}
