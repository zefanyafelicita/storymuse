<?php

namespace App\Models;

use App\Enums\StoryStatus;
use App\Services\HiddenGemService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'tropes' => 'array',
            'status' => StoryStatus::class,
            'rating' => 'float',
            'last_updated_at' => 'date',
            'completed_at' => 'date',
            'wattpad_verified' => 'boolean',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeOngoing(Builder $q): Builder
    {
        return $q->where('status', StoryStatus::Ongoing);
    }

    public function scopeCompleted(Builder $q): Builder
    {
        return $q->where('status', StoryStatus::Completed);
    }

    public function getVoteRateAttribute(): float
    {
        return $this->reads > 0 ? $this->votes / $this->reads : 0.0;
    }

    public function getIsHiddenGemAttribute(): bool
    {
        return app(HiddenGemService::class)->isHiddenGem($this);
    }

    public function getCoverToneAttribute(): int
    {
        return $this->id % 3;
    }

    /** Never invents dates: falls back to a plain "not available" message. */
    public function getStatusInfoAttribute(): string
    {
        if ($this->status === StoryStatus::Ongoing) {
            return $this->last_updated_at
                ? 'Last updated '.$this->last_updated_at->format('F j, Y')
                : 'Last update date not available';
        }

        return $this->completed_at
            ? 'Completed '.$this->completed_at->format('F j, Y')
            : 'Completion date not available';
    }
}
