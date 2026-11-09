<?php

namespace App\Services;

use App\Enums\StoryStatus;
use App\Models\Story;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;

/** One place for search, filters and sorting, shared by Discover, Hidden Gems and Collections. */
class StoryFilter
{
    public const SORTS = [
        'gem' => 'Gem score',
        'rating' => 'Highest rated',
        'votes' => 'Most votes',
        'fewest_reads' => 'Fewest reads',
        'updated' => 'Recently updated',
    ];

    public function __construct(private HiddenGemService $gems)
    {
    }

    public static function rules(): array
    {
        return [
            'q' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', Rule::enum(StoryStatus::class)],
            'genre' => ['nullable', 'string', 'max:60'],
            'trope' => ['nullable', 'string', 'max:60'],
            'mood' => ['nullable', 'string', 'max:60'],
            'ending' => ['nullable', Rule::in(['happy', 'bittersweet', 'open'])],
            'length' => ['nullable', Rule::in(['short', 'medium', 'long'])],
            'min_rating' => ['nullable', 'numeric', 'between:0,5'],
            'sort' => ['nullable', Rule::in(array_keys(self::SORTS))],
        ];
    }

    /** Invalid values are dropped silently instead of redirecting. */
    public static function clean(array $input): array
    {
        return validator($input, self::rules())->valid();
    }

    public function query(array $f): Builder
    {
        $q = ! empty($f['gems']) ? $this->gems->query()->reorder() : $this->gems->scored();

        if (! empty($f['q'])) {
            $like = '%'.addcslashes($f['q'], '%_\\').'%';
            $q->where(fn ($w) => $w->where('title', 'like', $like)
                ->orWhere('author', 'like', $like)
                ->orWhere('summary', 'like', $like)
                ->orWhere('tropes', 'like', $like));
        }
        foreach (['status', 'genre', 'mood', 'ending'] as $col) {
            if (! empty($f[$col])) {
                $q->where($col, $f[$col]);
            }
        }
        if (! empty($f['length'])) {
            $q->where('length_band', $f['length']);
        }
        if (! empty($f['trope'])) {
            $q->whereJsonContains('tropes', $f['trope']);
        }
        if (! empty($f['min_rating'])) {
            $q->where('rating', '>=', (float) $f['min_rating']);
        }

        match ($f['sort'] ?? 'gem') {
            'rating' => $q->orderByDesc('rating'),
            'votes' => $q->orderByDesc('votes'),
            'fewest_reads' => $q->orderBy('reads'),
            'updated' => $q->orderByDesc('last_updated_at'),
            default => $q->orderByDesc('gem_score'),
        };

        return $q->orderBy('id');
    }

    public function options(): array
    {
        return [
            'genres' => Story::query()->distinct()->orderBy('genre')->pluck('genre'),
            'moods' => Story::query()->whereNotNull('mood')->distinct()->orderBy('mood')->pluck('mood'),
            'tropes' => Story::query()->pluck('tropes')->flatten()->unique()->sort()->values(),
        ];
    }
}
