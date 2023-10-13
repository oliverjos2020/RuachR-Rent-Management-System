<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // $table->integer('role_id')->index()->unsigned()->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            // $table->string('avatar')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            // 2014_10_12_000000_create_users_table
        });

        // $this->insertDefaultData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // // Perform rollback operations here
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    //  private function insertDefaultData()
    // {
    //     $data = [
    //         ['name' => 'Admin Dressmetrix', 'email' => 'admin@dressmetrix.com', 'phone' => '07012345678', 'password' => Hash::make(12345678), 'status' => 1]
    //         // Add more default data as needed
    //     ];

    //     DB::table('users')->insert($data);
    // }
}
