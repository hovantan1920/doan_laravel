<?php

namespace Modules\Product\Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;
// use Illuminate\Database\Eloquent\Model;

class ProductDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Model::unguard();

        // $this->call([
        //     SeedFakeCategoryTableSeeder::class,
        //     SeedFakeGalleryTableSeeder::class,
        //     SeedFakeProductTableSeeder::class,
        // ]);
        $groups = [[
            'id'=>Config('product.groups.seller.id'),
            'description'=>'',
            'title'=> Config('product.groups.seller.name'),
            'index'=>Config('product.groups.seller.id'),
        ],[
            'id'=>Config('product.groups.new.id'),
            'description'=>'',
            'title'=> Config('product.groups.new.name'),
            'index'=>Config('product.groups.new.id'),
        ]
        ];
        DB::table('product_groups')->insert($groups);

        $categories = [[
            'title'=> 'Men - clothes',
            'image_source' =>'storage/images/cover_category.jpg',
            'active'=>1,
            'description'=>'Men clothes'
        ],[
            'title'=> 'Women - clothes',
            'image_source' =>'storage/images/cover_category.jpg',
            'active'=>1,
            'description'=>'Women clothes'
        ]
        ];
        DB::table('categories')->insert($categories);
    }
}
