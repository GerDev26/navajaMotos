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
        });

        Schema::create('vehicles', function(Blueprint $table){
            $table->id();
            $table->string('domain', 7)->unique();
            $table->string('green_card')->nullable();
            $table->unsignedBigInteger('vehicle_model_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('vehicle_model_id')
                  ->references('id')
                  ->on('vehicles_models')
                  ->onDelete('set null')
                  ->onUpdate('set null');

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
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
