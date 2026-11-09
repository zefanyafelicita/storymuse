<?php

namespace App\Http\Controllers;

use App\Services\RecommendationService;
use App\Services\StoryFilter;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RecommendationController extends Controller
{
    public function __invoke(Request $request, RecommendationService $recommender, StoryFilter $filter)
    {
        $options = $filter->options();
        $prefs = validator($request->query(), [
            'genres' => ['nullable', 'array'],
            'genres.*' => ['string', Rule::in($options['genres'])],
            'mood' => ['nullable', Rule::in($options['moods'])],
            'length' => ['nullable', Rule::in(['short', 'medium', 'long'])],
            'status' => ['nullable', Rule::in(['any', 'ongoing', 'completed'])],
        ])->valid() + ['status' => 'any'];

        return view('for-you', [
            'options' => $options,
            'prefs' => $prefs,
            'results' => $request->boolean('go') ? $recommender->recommend($prefs, 6) : null,
        ]);
    }
}
