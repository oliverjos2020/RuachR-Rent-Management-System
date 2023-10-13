<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();

            $table->timestamps();
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
        Schema::dropIfExists('roles');
    }
 
    private function insertDefaultData()
    {
        $data = [
            ['name' => 'Admin'],
            ['name' => 'Illustrator'],
            ['name' => 'User']
            // Add more default data as needed
        ];

        DB::table('roles')->insert($data);
    }
}
