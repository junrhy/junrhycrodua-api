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
        Schema::create('logistics', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique()->default(DB::raw('(UUID())'));
            $table->text('trip');
            $table->longText('contact_person');
            $table->text('truck');
            $table->longText('driver');
            $table->text('trailer');
            $table->text('distance');
            $table->text('weight')->nullable();
            $table->text('pieces')->nullable();
            $table->double('amount')->nullable();
            $table->string('origin');
            $table->datetime('loaded_at');
            $table->datetime('pickup_at');
            $table->string('destination');
            $table->datetime('drop_at');
            $table->datetime('arrived_at');
            $table->datetime('unloaded_at');
            $table->longText('journey');
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
        Schema::dropIfExists('logistics');
    }
};
