<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'hackathon_id',
        'user_id',
        'team_name',
        'participant_name',
        'mobile_number',
        'github_link',
        'project_title',
        'description',
        'zip_file',
        'zip_file_name',
        'zip_file_size',
        'demo_video_link',
        'submitted_at',
        'submission_count',
    ];

    protected function casts(): array
    {
        return [
            'submitted_at'   => 'datetime',
            'zip_file_size'  => 'integer',
            'submission_count' => 'integer',
        ];
    }

    /**
     * The hackathon this submission belongs to.
     */
    public function hackathon(): BelongsTo
    {
        return $this->belongsTo(Hackathon::class);
    }

    /**
     * The user who made this submission.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get human-readable file size.
     */
    public function getFormattedFileSizeAttribute(): string
    {
        $bytes = $this->zip_file_size;
        if (!$bytes) return 'Unknown';

        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;
        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Get submission status label.
     */
    public function getStatusLabelAttribute(): string
    {
        if ($this->submission_count > 1) {
            return 'Resubmitted';
        }
        return 'Submitted';
    }
}
