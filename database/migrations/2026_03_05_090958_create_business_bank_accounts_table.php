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
        if (!Schema::hasTable('business_bank_accounts')) {

            Schema::create('business_bank_accounts', function (Blueprint $table) {
                $table->id();

                $table->foreignId('business_id')
                    ->constrained()
                    ->cascadeOnDelete();

                $table->string('account_name');
                $table->string('account_number');
                $table->string('bank_name');
                $table->string('bank_code')->nullable();

                $table->timestamps();
            });

        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_bank_accounts');
    }
};
