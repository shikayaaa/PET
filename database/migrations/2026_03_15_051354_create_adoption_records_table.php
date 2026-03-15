<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('adoption_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adoption_application_id')->constrained()->onDelete('cascade');
            $table->foreignId('pet_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');       // adopter
            $table->foreignId('shelter_id')->constrained()->onDelete('cascade');
            $table->date('adoption_date');
            $table->string('adoption_fee')->nullable();
            $table->enum('payment_status', ['paid', 'waived', 'pending'])->default('pending');
            $table->string('contract_number')->unique()->nullable();
            $table->text('notes')->nullable();
            $table->string('contract_file')->nullable();                            // uploaded PDF
            $table->foreignId('processed_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adoption_records');
    }
};