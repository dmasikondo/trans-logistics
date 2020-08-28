<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('slug');
            $table->string('capacity');
            $table->string('trailer_type');
            $table->string('route');
            $table->timestamp('available_date');
            $table->string('city_from');
            $table->string('city_to');
            $table->string('country_from');
            $table->string('country_to');
            $table->string('load_type');
            $table->string('more_details');
            $table->boolean('is_published')->default(false);
            $table->boolean('private_visibility')->default(false);
            $table->boolean('public_visibility')->default(false);
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
        Schema::dropIfExists('vehicles');
    }
}
