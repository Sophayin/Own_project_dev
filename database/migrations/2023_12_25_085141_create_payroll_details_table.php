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
        Schema::create('payroll_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payroll_reference');
            $table->string('agency_name')->nullable(true);
            $table->string('agency_code')->nullable(true);
            $table->foreignId('agency_id');
            $table->integer('own_sale')->default(0);
            $table->integer('sale_by_team')->default(0);
            $table->integer('indirect_sale_team')->default(0);
            $table->integer('total_sale')->default(0);
            $table->integer('target_sale')->default(0);
            $table->integer('total_recruit')->default(0);
            $table->integer('target_recruit')->default(0);
            $table->float('salary', 8, 2)->default(0);
            $table->float('incentive', 8, 2)->default(0);
            $table->float('commission_fee', 8, 2)->default(0);
            $table->float('override_fee', 8, 2)->default(0);
            $table->float('total_payroll', 8, 2)->default(0);
            $table->string('remark');
            $table->string('status');
            $table->json('application_ids')->nullable(true);
            $table->json('recruit_ids')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_details');
    }
};
