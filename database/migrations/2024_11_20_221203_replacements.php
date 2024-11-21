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
        Schema::create('replacements', function(Blueprint $table){
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('replacements_invoices', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('replacement_id')->nullable();
            $table->float('unit_price');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('replacement_id')
                  ->references('id')
                  ->on('replacements')
                  ->onDelete('set null')
                  ->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replacements_invoices');
        Schema::dropIfExists('replacements');
    }
};
