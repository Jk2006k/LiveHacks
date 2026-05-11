<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hackathon extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'tagline',
        'description',
        'category',
        'difficulty',
        'prize_pool',
        'team_limit',
        'max_participants',
        'banner_image',
        'logo_image',
        'problem_statement_pdf',
        'tags',
        'entry_fee',
        'registration_start',
        'registration_end',
        'hackathon_start',
        'hackathon_end',
        'status',
        'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'tags'                => 'array',
            'prize_pool'          => 'decimal:2',
            'entry_fee'           => 'decimal:2',
            'registration_start'  => 'datetime',
            'registration_end'    => 'datetime',
            'hackathon_start'     => 'datetime',
            'hackathon_end'       => 'datetime',
            'is_featured'         => 'boolean',
        ];
    }

    /**
     * The user who hosts/created this hackathon.
     */
    public function host(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Participants who registered for this hackathon.
     */
    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'hackathon_user')
                    ->withPivot('registered_at');
    }

    /**
     * Submissions for this hackathon.
     */
    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class);
    }

    /**
     * Get participant count.
     */
    public function getParticipantCountAttribute(): int
    {
        return $this->participants()->count();
    }

    /**
     * Check if registration is open.
     */
    public function getIsRegistrationOpenAttribute(): bool
    {
        $now = now();
        return $this->status === 'published'
            && ($this->registration_start === null || $now->gte($this->registration_start))
            && ($this->registration_end === null || $now->lte($this->registration_end));
    }

    /**
     * Get formatted prize pool.
     */
    public function getFormattedPrizeAttribute(): string
    {
        return '$' . number_format($this->prize_pool, 0);
    }

    /**
     * Get formatted entry fee.
     */
    public function getFormattedEntryFeeAttribute(): string
    {
        if ($this->entry_fee <= 0) {
            return 'Free';
        }
        return '$' . number_format($this->entry_fee, 0);
    }

    /**
     * Scope: only published hackathons.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope: featured hackathons.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Get color scheme based on category — Solar Orange theme.
     */
    public function getColorSchemeAttribute(): array
    {
        return match (strtolower($this->category)) {
            'ai/ml', 'ai', 'machine learning' => [
                'gradient'    => 'from-blue-500 to-blue-600',
                'border'      => 'hover:border-blue-200',
                'badge_color' => 'text-blue-600 border-blue-200 bg-blue-50',
                'accent'      => 'text-blue-600',
            ],
            'web3', 'blockchain', 'defi' => [
                'gradient'    => 'from-violet-500 to-violet-600',
                'border'      => 'hover:border-violet-200',
                'badge_color' => 'text-violet-600 border-violet-200 bg-violet-50',
                'accent'      => 'text-violet-600',
            ],
            'iot', 'cleantech', 'green tech' => [
                'gradient'    => 'from-emerald-500 to-emerald-600',
                'border'      => 'hover:border-emerald-200',
                'badge_color' => 'text-emerald-600 border-emerald-200 bg-emerald-50',
                'accent'      => 'text-emerald-600',
            ],
            'mobile', 'app development' => [
                'gradient'    => 'from-solar to-solar-hover',
                'border'      => 'hover:border-solar-light',
                'badge_color' => 'text-solar border-solar-light bg-solar-bg',
                'accent'      => 'text-solar',
            ],
            'cybersecurity', 'security' => [
                'gradient'    => 'from-red-500 to-red-600',
                'border'      => 'hover:border-red-200',
                'badge_color' => 'text-red-600 border-red-200 bg-red-50',
                'accent'      => 'text-red-600',
            ],
            default => [
                'gradient'    => 'from-solar to-solar-hover',
                'border'      => 'hover:border-solar-light',
                'badge_color' => 'text-solar border-solar-light bg-solar-bg',
                'accent'      => 'text-solar',
            ],
        };
    }
}
