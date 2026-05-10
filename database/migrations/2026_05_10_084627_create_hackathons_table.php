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
        Schema::create('hackathons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('tagline')->nullable();
            $table->text('description')->nullable();
            $table->string('category'); // AI/ML, Web3, IoT, etc.
            $table->string('difficulty')->default('Intermediate'); // Beginner Friendly, Intermediate, Advanced
            $table->decimal('prize_pool', 10, 2)->default(0);
            $table->integer('team_limit')->default(4);
            $table->integer('max_participants')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('logo_image')->nullable();
            $table->json('tags')->nullable(); // ['Python', 'TensorFlow', 'React']
            $table->timestamp('registration_start')->nullable();
            $table->timestamp('registration_end')->nullable();
            $table->timestamp('hackathon_start')->nullable();
            $table->timestamp('hackathon_end')->nullable();
            $table->enum('status', ['draft', 'published', 'ongoing', 'completed', 'cancelled'])->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });

        // Pivot table for participants
        Schema::create('hackathon_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hackathon_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamp('registered_at')->useCurrent();
            $table->unique(['hackathon_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hackathon_user');
        Schema::dropIfExists('hackathons');
    }
};
