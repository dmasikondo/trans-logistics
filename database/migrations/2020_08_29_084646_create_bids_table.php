<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->id();
            $table->string('price');
            $table->string('available_capacity');
            $table->string('trailer_type');
            $table->string('city_location');
            $table->string('country_location');
            $table->string('slug');
            $table->foreignId('bidable_id');
            $table->foreignId('user_id');
            $table->string('bidable_type');            
            $table->boolean('is_awarded')->default(false);            
            $table->timestamp('date_available');
            $table->timestamps();
        });
/*        Schema::create('interested', function (Blueprint $table) {
            $table->id();
            $table->foreignId('interestedable_id');
            $table->foreignId('user_id');
            $table->string('interestedable_type');
            $table->timestamps();
        });    
*/            
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bids');
      //  Schema::dropIfExists('interested');
    }
}
