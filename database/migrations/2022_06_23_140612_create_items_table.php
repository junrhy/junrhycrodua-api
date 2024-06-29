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
        Schema::create('items', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique()->default(DB::raw('(UUID())'));
            $table->string('name');
            $table->string('item_code');
            $table->string('currency');
            $table->double('price');
            $table->date('expired_at')->nullable();
            $table->longText('properties')->nullable();
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
        Schema::dropIfExists('items');
    }
};
