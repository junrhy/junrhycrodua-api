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
        DB::statement('SET SESSION sql_require_primary_key=0');
        Schema::create('barangays', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique()->default(DB::raw('(UUID())'));
            $table->string('name');
            $table->string('official_id');
            $table->string('brgy_code');
            $table->string('region_code');
            $table->string('province_code');
            $table->string('municipal_code');
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
        Schema::dropIfExists('barangays');
    }
};
