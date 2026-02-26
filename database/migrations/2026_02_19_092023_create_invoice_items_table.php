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
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            
             // Relationship
            $table->foreignId('invoice_id')
                  ->constrained('invoices')
                  ->cascadeOnDelete();
            
                  // Item details
            $table->string('description');
            $table->unsignedInteger('quantity');

            // Monetary fields
            $table->decimal('price', 15, 2);
            $table->decimal('total', 15, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
    }
};
