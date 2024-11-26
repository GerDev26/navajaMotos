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
        Schema::create('works', function(Blueprint $table){
            $table->id();
            $table->string('description');
        });

        Schema::create('works_invoices', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('work_id')->nullable();
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->float('unit_price');
            $table->timestamps();

            $table->foreign('work_id')
                  ->references('id')
                  ->on('works')
                  ->onDelete('set null')
                  ->onUpdate('set null');
                  
            $table->foreign('invoice_id')
                  ->references('id')
                  ->on('invoices')
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
