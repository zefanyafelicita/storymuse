<?php

namespace App\Services;

use App\Models\Story;
use Illuminate\Support\Collection;

/**
 * Match score out of 100: genre 35 · mood 25 · length 15 · status 10 · reader love 15.
 * A preference left empty gives every story half of that criterion's points (neutral);
 * status "any" gives every story all 10 points.
 */
class RecommendationService
{
    public const WEIGHTS = ['genre' => 35, 'mood' => 25, 'length' => 15, 'status' => 10, 'quality' => 15];

    public function recommend(array $prefs, int $limit = 6): Collection
    {
        return $this->rank(Story::all(), $prefs)->take($limit)->values();
    }

    public function rank(Collection $stories, array $prefs): Collection
    {
        $w = self::WEIGHTS;
        $genres = $prefs['genres'] ?? [];
        $mood = $prefs['mood'] ?? null;
        $length = $prefs['length'] ?? null;
        $status = $prefs['status'] ?? 'any';
        $target = config('storymuse.gem.ratio_target');

        return $stories->map(function (Story $s) use ($w, $genres, $mood, $length, $status, $target) {
            $score = 0;
            $why = [];

            if ($genres) {
                if (in_array($s->genre, $genres, true)) { $score += $w['genre']; $why[] = $s->genre; }
            } else { $score += $w['genre'] / 2; }

            if ($mood) {
                if ($s->mood === $mood) { $score += $w['mood']; $why[] = $mood.' mood'; }
            } else { $score += $w['mood'] / 2; }

            if ($length) {
                if ($s->length_band === $length) { $score += $w['length']; $why[] = ucfirst($length).' read'; }
            } else { $score += $w['length'] / 2; }

            if (in_array($status, ['ongoing', 'completed'], true)) {
                if ($s->status->value === $status) { $score += $w['status']; $why[] = $s->status->label(); }
            } else { $score += $w['status']; }

            $love = min(1, $s->vote_rate / $target);
            $score += $love * $w['quality'];
            if ($love >= 0.7) { $why[] = 'Loved by its readers'; }

            $s->setAttribute('match_score', (int) round($score));
            $s->setAttribute('match_reasons', $why);

            return $s;
        })->sortBy([['match_score', 'desc'], ['rating', 'desc']])->values();
    }
}
