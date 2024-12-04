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
        Schema::create('invoices', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->float('total_price')->nullable();
            $table->float('advancement')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null')
                  ->onUpdate('set null');

            $table->foreign('vehicle_id')
                  ->references('id')
                  ->on('vehicles')
                  ->onDelete('set null')
                  ->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
