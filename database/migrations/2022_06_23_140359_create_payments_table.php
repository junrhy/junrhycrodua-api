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
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique()->default(DB::raw('(UUID())'));
            $table->longText('item');
            $table->double('amount');
            $table->uuid('brand_id');
            $table->uuid('person_id');
            $table->uuid('card_id')->nullable();
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
        Schema::dropIfExists('payments');
    }
};
