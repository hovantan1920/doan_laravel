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
            'name'=>'administrator',
            'email'=>'admin@example.com',
            'numberphone'=>'0979629201',
            'active' => 1,
            'avatar' => 'https://firebasestorage.googleapis.com/v0/b/pbanana-38db9.appspot.com/o/avatar%2Fimg_12.png?alt=media',
            'password'=>bcrypt('123456'),
            'roles_id'=>'1'
        ],
        [
            'numberphone'=>'0979629202',
            'active' => 1,
            'avatar' => 'https://firebasestorage.googleapis.com/v0/b/pbanana-38db9.appspot.com/o/avatar%2Fimg_12.png?alt=media',
            'password'=>bcrypt('123456'),
            'name'=>'customer',
            'email'=>'customer@example.com',
            'roles_id'=>'3'
        ]];
        DB::table('users')->insert($user);
    }
}
