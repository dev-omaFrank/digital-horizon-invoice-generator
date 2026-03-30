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
        if (!Schema::hasTable('plans')) {
           Schema::create('plans', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->integer('amount'); // in kobo
                $table->string('currency')->default('NGN');
                $table->string('interval'); // monthly, yearly

                $table->string('paystack_plan_code')->unique()->nullable();

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
