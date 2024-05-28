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
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable(true);
            $table->foreignId('agency_id')->nullable(true);
            $table->string('leader_code')->nullable(true);
            $table->string('indirect_leader_code')->nullable(true);
            $table->foreignId('indirect_leader_id')->nullable(true);
            $table->string('referrer_code')->nullable(true);
            $table->string('khmer_identity_card')->nullable(true);
            $table->string('agency_profile')->nullable(true);
            $table->string('full_name')->nullable(true);
            $table->string('full_name_translate')->nullable(true);
            $table->string('phone')->nullable(true);
            $table->string('phone_telegram')->nullable(true);
            $table->string('gender')->nullable(true);
            $table->string('age')->nullable(true);
            $table->foreignId('position_id')->nullable(true);
            $table->foreignId('occupation_id')->nullable(true);
            $table->string('income')->nullable(true);
            $table->integer('status')->default(1); //[0=terminate, 1=active, 2=warning, 3=Resign, 4=Probation]
            $table->json('bank_info')->nullable(true);
            $table->json('date_of_birth')->nullable(true);
            $table->string('company')->nullable(true);
            $table->longText('remark')->nullable(true);
            $table->datetime('registered_date')->nullable(true);
            $table->string('schedule_training')->nullable(true);
            $table->string('created_by')->nullable(true);
            $table->string('updated_by')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agencies');
    }
};
