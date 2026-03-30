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
        if (!Schema::hasTable('subscriptions')) {
            Schema::create('subscriptions', function (Blueprint $table) {
                $table->id();

                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->foreignId('plan_id')->constrained();

                $table->string('status')->default('active');
                // active, past_due, canceled, trialing

                $table->timestamp('start_date')->useCurrent();
                $table->timestamp('end_date')->nullable();

                $table->timestamp('next_billing_date');
                $table->timestamp('last_payment_date')->nullable();

                $table->string('paystack_subscription_code')->unique()->nullable();
                $table->string('paystack_email_token')->nullable();

                $table->timestamp('canceled_at')->nullable();

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
