<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['dog', 'cat', 'bird', 'rabbit', 'other']);
            $table->string('breed')->nullable();
            $table->enum('gender', ['male', 'female', 'unknown'])->default('unknown');
            $table->integer('age_months')->nullable();
            $table->decimal('weight_kg', 5, 2)->nullable();
            $table->enum('size', ['small', 'medium', 'large', 'extra_large'])->nullable();
            $table->enum('status', ['available', 'pending', 'adopted', 'unavailable'])->default('available');
            $table->text('description')->nullable();
            $table->boolean('is_vaccinated')->default(false);
            $table->boolean('is_neutered')->default(false);
            $table->boolean('is_microchipped')->default(false);
            $table->boolean('is_house_trained')->default(false);
            $table->boolean('good_with_kids')->default(false);
            $table->boolean('good_with_dogs')->default(false);
            $table->boolean('good_with_cats')->default(false);
            $table->string('color')->nullable();
            $table->string('photo')->nullable();
            $table->date('intake_date')->nullable();
            $table->foreignId('shelter_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};