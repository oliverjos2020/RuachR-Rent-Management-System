<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoleUser;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //  \App\Models\User::factory(10)->create();
         \App\Models\Product::factory(50)->create();
        // \App\Models\categoryProduct::factory(50)->create();
        //  \App\Models\Role::factory(5)->create();
        //  \App\Models\Location::factory(50)->create();
        //  \App\Models\Photo::factory(100)->create();
        // \App\Models\RoleUser::factory(10)->create();
    }

    public function down()
{
    DB::table('users')->truncate();
    DB::table('roles')->truncate();
    DB::table('categories')->truncate();
    DB::table('products')->truncate();
    DB::table('photos')->truncate();
}
}
 