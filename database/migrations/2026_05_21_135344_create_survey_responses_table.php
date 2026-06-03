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
        Schema::create('survey_responses', function (Blueprint $table) {
            $table->id();
            $table->string('tourist_name');
            $table->string('tourist_email')->nullable();
            $table->string('nationality');
            $table->string('age_group');
            $table->foreignId('destination_id')->constrained()->cascadeOnDelete();
            $table->json('answers');
            $table->text('feedback_text')->nullable();
            $table->decimal('overall_rating', 3, 1)->default(0);
            $table->string('encoded_by')->default('self');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_responses');
    }
};
