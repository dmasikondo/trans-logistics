<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('slug')->unique();
            $table->string('name');
            $table->timestamp('pickup_date')->nullable();
            $table->timestamp('destination_date')->nullable();
            $table->string('size');
            $table->integer('containers')->nullable();
            $table->integer('quantity')->default(1);
            $table->string('pickup_street');
            $table->string('pickup_city');
            $table->string('pickup_country');
            $table->string('destination_street');
            $table->string('destination_city');
            $table->string('destination_country');
            $table->string('vehicle_type')->nullable();
            $table->string('distance')->nullable();
            $table->boolean('is_published')->default(false);
            $table->boolean('private_visibility')->default(false);
            $table->boolean('public_visibility')->default(false);
            $table->string('payment_option');
            $table->string('amount')->nullable();
            $table->text('description')->nullable();
            $table->text('requirements')->nullable();
            $table->string('preferred_route')->nullable();
            $table->enum('carriage_rate', ['cost_per_km','cost_for_whole_journey','request_a_quote']);  
            $table->enum('transport_mode', ['air freight','rail freight','road freight','sea freight']); 
            $table->softDeletes();        
            $table->timestamps();
        });


        Schema::create('categories', function (Blueprint $table) {
            $table->id();           
            $table->string('name');
            $table->timestamps();
        });   

                // insert some types of goods
        DB::table('categories')->insert([
                ['name' =>'clothing / textile','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'construction material','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'dangerous goods','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'food services','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'furniture','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'grain','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'groceries','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'liquid bulk','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'live animals','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'machinery','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'medicines','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'minerals','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'parcels','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'perishables','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'vehicles','created_at'=>now(),'updated_at'=>now()], 
                ['name' =>'wood / logs','created_at'=>now(),'updated_at'=>now()], 
            ]); 
       
        Schema::create('category_load', function (Blueprint $table) {
            $table->primary(['category_id','load_id']);
            $table->foreignId('category_id');
            $table->foreignId('load_id');
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
        Schema::dropIfExists('category_load');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('loads');
    }
}





