<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique()->default(DB::raw('(UUID())'));
            $table->string('street_name');
            $table->uuid('barangay_id')->nullable();
            $table->uuid('town_id');
            $table->uuid('province_id');
            $table->uuid('state_id');
            $table->uuid('country_id');
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
        Schema::dropIfExists('addresses');
    }
};
