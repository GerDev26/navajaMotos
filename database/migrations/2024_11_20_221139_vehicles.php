<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles_models', function(Blueprint $table){
            $table->id();
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('vehicles', function(Blueprint $table){
            $table->id();
            $table->string('domain')->nullable();
            $table->string('green_card')->nullable();
            $table->unsignedBigInteger('vehicle_id')->nullable();

            $table->foreign('vehicle_id')
                  ->references('id')
                  ->on('vehicles_models')
                  ->onDelete('set null')
                  ->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles_models');
        Schema::dropIfExists('vehicles');
    }
};
