<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->id();

            // Identity
            $table->string('name');
            $table->string('title');         // e.g. "Senior Full-Stack Engineer"
            $table->string('subtitle');      // e.g. "Laravel & Vue 3"
            $table->text('tagline');         // one-liner under the title

            // About section
            $table->text('bio')->nullable(); // paragraphs separated by \n\n
            $table->json('tags')->nullable(); // ["API Designer", "Team Player", …]

            // Contact & presence
            $table->string('location')->nullable();
            $table->string('availability')->nullable(); // "Available for work · Remote / Pakistan"
            $table->string('email')->nullable();
            $table->string('github_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('resume_url')->nullable();

            // Stats
            $table->unsignedSmallInteger('years_of_experience')->default(0);
            $table->unsignedInteger('open_source_commits')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
};
