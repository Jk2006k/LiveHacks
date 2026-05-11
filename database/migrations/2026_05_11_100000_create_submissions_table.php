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
        // Add problem_statement_pdf to hackathons table
        Schema::table('hackathons', function (Blueprint $table) {
            $table->string('problem_statement_pdf')->nullable()->after('logo_image');
        });

        // Create submissions table
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hackathon_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('team_name');
            $table->string('participant_name');
            $table->string('mobile_number', 20);
            $table->string('github_link');
            $table->string('project_title');
            $table->text('description');
            $table->string('zip_file');
            $table->string('zip_file_name')->nullable(); // Original file name
            $table->unsignedBigInteger('zip_file_size')->nullable(); // File size in bytes
            $table->string('demo_video_link')->nullable();
            $table->timestamp('submitted_at')->useCurrent();
            $table->integer('submission_count')->default(1); // Track resubmissions
            $table->unique(['hackathon_id', 'user_id']); // One submission per user per hackathon
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');

        Schema::table('hackathons', function (Blueprint $table) {
            $table->dropColumn('problem_statement_pdf');
        });
    }
};
