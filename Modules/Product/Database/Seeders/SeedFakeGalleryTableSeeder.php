<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

//Model
use Modules\Product\Entities\Gallery;

class SeedFakeGalleryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Gallery::class, 20)->create();

        // $this->call("OthersTableSeeder");
    }
}
