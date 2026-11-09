<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Services\HiddenGemService;

class StoryController extends Controller
{
    public function show(Story $story, HiddenGemService $gems)
    {
        return view('story.show', [
            'story' => $story,
            'gemScore' => $gems->score($story),
            'related' => Story::where('genre', $story->genre)->whereKeyNot($story->id)->orderByDesc('rating')->limit(3)->get(),
        ]);
    }
}
