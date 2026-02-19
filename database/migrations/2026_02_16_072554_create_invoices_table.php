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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            // Ownership (Tenant Isolation)
            $table->foreignId('business_id')
                ->constrained()
                ->cascadeOnDelete();

            // Client relationship
            $table->foreignId('client_id')
                ->constrained('client_profile')
                ->cascadeOnDelete();

            // Invoice identity
            $table->string('invoice_number');

            // Dates
            $table->date('issue_date');
            $table->date('due_date');

            // Status lifecycle
            $table->enum('status', [
                'draft',
                'sent',
                'paid',
                'partial',
                'overdue',
                'cancelled'
            ])->default('draft');

            // Monetary fields (NO FLOATS)
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('tax', 12, 2)->default(0);
            $table->decimal('discount', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);

            // Optional currency support
            $table->string('currency', 3)->default('USD');

            // Additional notes
            $table->text('notes')->nullable();

            $table->timestamps();

            // Unique invoice number per business
            $table->unique(['business_id', 'invoice_number']);

            // Performance indexes
            $table->index('business_id');
            $table->index('client_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
