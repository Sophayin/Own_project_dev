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
        Schema::create('application_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id');
            $table->foreignId('loan_company_id')->nullable(true);
            $table->integer('status');
            $table->string('respond_by');
            $table->longText('reason_text')->nullable(true);
            $table->foreignId('reason_id')->nullable(true);
            $table->datetime('registered_date')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_statuses');
        //
    }
};
