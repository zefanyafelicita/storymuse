<?php

namespace App\Services;

use App\Models\Story;
use Illuminate\Database\Eloquent\Builder;

/**
 * Hidden Gem score (0–100):
 *   engagement 60 = min(1, votes/reads ÷ ratio_target)
 *   rating     25 = clamp((rating − 3) ÷ 2, 0, 1)
 *   obscurity  15 = clamp(1 − reads ÷ max_reads, 0, 1)
 * A story qualifies when min_reads ≤ reads < max_reads and score ≥ threshold.
 * score() (PHP) and scored() (SQL) implement the same formula.
 */
class HiddenGemService
{
    public function score(Story $s): float
    {
        $c = config('storymuse.gem');
        $w = $c['weights'];

        $engagement = min(1, $s->vote_rate / $c['ratio_target']);
        $rating = max(0, min(1, ($s->rating - 3) / 2));
        $obscurity = max(0, min(1, 1 - $s->reads / $c['max_reads']));

        return round($engagement * $w['engagement'] + $rating * $w['rating'] + $obscurity * $w['obscurity'], 1);
    }

    public function isHiddenGem(Story $s): bool
    {
        $c = config('storymuse.gem');

        return $s->reads >= $c['min_reads']
            && $s->reads < $c['max_reads']
            && $this->score($s) >= $c['threshold'];
    }

    /** Every story, with a computed gem_score column (no gem filtering). */
    
    /** Every story, with a computed gem_score column (no gem filtering). */
    public function scored(): Builder
    {
        $c = config('storymuse.gem');
        $w = $c['weights'];

        return Story::query()
            ->select('stories.*')
            ->selectRaw(
                'ROUND(
                    LEAST(1, (`votes` / GREATEST(`reads`, 1)) / ?) * ?
                    + GREATEST(0, LEAST(1, (`rating` - 3) / 2)) * ?
                    + GREATEST(0, LEAST(1, 1 - `reads` / ?)) * ?,
                    1
                ) AS gem_score',
                [
                    $c['ratio_target'],
                    $w['engagement'],
                    $w['rating'],
                    $c['max_reads'],
                    $w['obscurity']
                ]
            );
    }


    /** Only qualifying hidden gems, best first. */
    public function query(): Builder
    {
        $c = config('storymuse.gem');

        return $this->scored()
            ->where('reads', '>=', $c['min_reads'])
            ->where('reads', '<', $c['max_reads'])
            ->having('gem_score', '>=', $c['threshold'])
            ->orderByDesc('gem_score');
    }
}
