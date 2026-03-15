<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pet_medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pet_id')->constrained()->onDelete('cascade');
            $table->enum('record_type', [
                'vaccination',
                'deworming',
                'check_up',
                'surgery',
                'treatment',
                'dental',
                'other'
            ]);
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('veterinarian_name')->nullable();
            $table->string('clinic_name')->nullable();
            $table->date('date');
            $table->date('next_due_date')->nullable();
            $table->decimal('cost', 8, 2)->nullable();
            $table->string('medicine_given')->nullable();
            $table->string('dosage')->nullable();
            $table->enum('status', ['completed', 'scheduled', 'cancelled'])->default('completed');
            $table->string('attachment')->nullable();
            $table->foreignId('recorded_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pet_medical_records');
    }
};
