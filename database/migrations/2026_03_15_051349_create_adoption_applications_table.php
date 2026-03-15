<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('adoption_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');       // applicant
            $table->foreignId('pet_id')->constrained()->onDelete('cascade');
            $table->foreignId('shelter_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['pending', 'under_review', 'approved', 'rejected', 'cancelled'])->default('pending');
            $table->text('reason')->nullable();                  // why they want to adopt
            $table->string('home_type')->nullable();             // house, apartment, condo
            $table->boolean('has_yard')->default(false);
            $table->boolean('has_other_pets')->default(false);
            $table->text('other_pets_details')->nullable();
            $table->boolean('has_children')->default(false);
            $table->integer('children_ages')->nullable();        // youngest child age
            $table->string('previous_pet_experience')->nullable();
            $table->text('reviewer_notes')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adoption_applications');
    }
};