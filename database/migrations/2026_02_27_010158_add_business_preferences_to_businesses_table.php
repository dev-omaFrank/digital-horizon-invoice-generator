<?php
    //currency preference is stored here.
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

        if (!Schema::hasTable('businesses')) {
            return;
        }

        Schema::table('businesses', function (Blueprint $table){
            if (!Schema::hasColumn('businesses', 'currency')) {
                $table->string('currency');
            }
        });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            //
        });
    }
};
