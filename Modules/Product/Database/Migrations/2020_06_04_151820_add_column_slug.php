<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnSlug extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('slug');
        });
        Schema::table('product_groups', function (Blueprint $table) {
            $table->string('slug');
        });
        Schema::table('brands', function (Blueprint $table) {
            $table->string('slug');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->string('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::table('product_groups', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::table('brands', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
