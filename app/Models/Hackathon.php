<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
     * Get color scheme based on category.
     */
    public function getColorSchemeAttribute(): array
    {
        return match (strtolower($this->category)) {
            'ai/ml', 'ai', 'machine learning' => [
                'gradient'    => 'from-blue-500/20 to-cyan-500/20',
                'border'      => 'hover:border-blue-400/30',
                'badge_color' => 'text-blue-400 border-blue-400/20 bg-blue-400/5',
            ],
            'web3', 'blockchain', 'defi' => [
                'gradient'    => 'from-purple-500/20 to-pink-500/20',
                'border'      => 'hover:border-purple-400/30',
                'badge_color' => 'text-purple-400 border-purple-400/20 bg-purple-400/5',
            ],
            'iot', 'cleantech', 'green tech' => [
                'gradient'    => 'from-emerald-500/20 to-teal-500/20',
                'border'      => 'hover:border-emerald-400/30',
                'badge_color' => 'text-emerald-400 border-emerald-400/20 bg-emerald-400/5',
            ],
            'mobile', 'app development' => [
                'gradient'    => 'from-orange-500/20 to-amber-500/20',
                'border'      => 'hover:border-orange-400/30',
                'badge_color' => 'text-orange-400 border-orange-400/20 bg-orange-400/5',
            ],
            'cybersecurity', 'security' => [
                'gradient'    => 'from-red-500/20 to-rose-500/20',
                'border'      => 'hover:border-red-400/30',
                'badge_color' => 'text-red-400 border-red-400/20 bg-red-400/5',
            ],
            default => [
                'gradient'    => 'from-neon-blue/20 to-neon-purple/20',
                'border'      => 'hover:border-neon-purple/30',
                'badge_color' => 'text-neon-purple border-neon-purple/20 bg-neon-purple/5',
            ],
        };
    }
}
