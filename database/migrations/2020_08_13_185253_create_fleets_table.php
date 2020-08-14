<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFleetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fleets', function (Blueprint $table) {
            $table->id();           
             $table->foreignId('user_id');
            $table->integer('number_of_horses');
            $table->integer('number_of_trailers');
            $table->timestamps();
        });
        Schema::create('trailers', function (Blueprint $table) {
            $table->id();           
            $table->string('name');
            $table->timestamps();
        });
        // insert some trailer names
        DB::table('trailers')->insert([
                ['name' =>'boxtruck','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'curtainside','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'flatbed','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'food services','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'lowboy','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'refrigerated / reefer','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'step deck','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'tanker','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'vehicle carrier','created_at'=>now(),'updated_at'=>now()], 
            ]);

        Schema::create('fleet_trailer', function (Blueprint $table) {
            $table->primary(['fleet_id','trailer_id']);
            $table->foreignId('fleet_id');
            $table->foreignId('trailer_id');
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
        Schema::dropIfExists('fleet_trailer');
        Schema::dropIfExists('trailers');
        Schema::dropIfExists('fleets');
    }
}
