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
        Schema::create('sales', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique()->default(DB::raw('(UUID())'));
            $table->string('source');
            $table->string('items');
            $table->double('amount');
            $table->double('discount')->nullable();
            $table->double('fees')->nullable();
            $table->double('tax')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('payment_tracking_code')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('sales');
    }
};
