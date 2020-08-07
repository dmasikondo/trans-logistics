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
            $table->string('name');
            $table->string('label')->nullable();
            $table->timestamps();
        });

        // insert some role names
        DB::table('roles')->insert([
                ['name' =>'no-role','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'carrier-initialising','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'general-initialising','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'general','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'carrier','created_at'=>now(),'updated_at'=>now()], 
                ['name' => 'admin','created_at'=>now(),'updated_at'=>now()],
                ['name' =>'manager', 'created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'superadmin','created_at'=>now(),'updated_at'=>now()]
            ]);

        Schema::create('role_user', function (Blueprint $table) {
            $table->primary(['user_id','role_id']);
            $table->foreignId('user_id');
            $table->foreignId('role_id');
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('roles');
    }
}
