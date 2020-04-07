<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $permission = [[
            'title' => 'Write - PageAdmin',
            'descride'=> 'Only write',
        ],[
            'title' => 'Read - PageAdmin',
            'descride'=> 'Only read',
        ],[
            'title' => 'Booking - PageStore',
            'descride'=> 'Only booking',
        ]];
        DB::table('permissions')->insert($permission);

        $role = [[
            'title' => 'admin-master',
            'descride'=> 'This is master',
        ],
        [
            'title' => 'admin-sub',
            'descride'=> 'This is master sub',
        ],
        [
            'title' => 'customer',
            'descride'=> 'This is customer',
        ]];
        DB::table('roles')->insert($role);

        $roles_permission = [[
            'permissions_id'=>'1',
            'roles_id'      =>'1'
        ],[
            'permissions_id'=>'2',
            'roles_id'      =>'1'
        ],[
            'permissions_id'=>'3',
            'roles_id'      =>'1'
        ],
        [
            'permissions_id'=>'2',
            'roles_id'      =>'2'
        ],[
            'permissions_id'=>'3',
            'roles_id'      =>'2'
        ],
        [
            'permissions_id'=>'3',
            'roles_id'      =>'3'
        ]];

        DB::table('roles_permissions')->insert($roles_permission);

        $user = [[
            'name'=>'user01',
            'email'=>'admin@exemple.com',
            'password'=>bcrypt('111111'),
            'roles_id'=>'1'
        ],
        [
            'name'=>'user02',
            'email'=>'adminsubr@exemple.com',
            'password'=>bcrypt('111111'),
            'roles_id'=>'2'
        ],
        [
            'name'=>'customer',
            'email'=>'customer@exemple.com',
            'password'=>bcrypt('111111'),
            'roles_id'=>'3'
        ]];
        DB::table('users')->insert($user);
    }
}
