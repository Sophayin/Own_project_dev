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
        Schema::create('award_targets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('position_id')->nullable();
            $table->foreignId('award_id')->nullable();
            $table->integer('target_sale')->default(1);
            $table->integer('target_recruit')->default(0);
            $table->float('salary')->default(0);
            $table->float('incentive')->default(0);
            $table->float('commission_fee')->default(0);
            $table->float('override_fee')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('award_targets');
    }
};
