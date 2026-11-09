<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Services\HiddenGemService;

class HomeController extends Controller
{
    public function __invoke(HiddenGemService $gems)
    {
        return view('home', [
            'gems' => $gems->query()->limit(3)->get(),
            'ongoingCount' => Story::ongoing()->count(),
            'completedCount' => Story::completed()->count(),
            'collections' => collect(config('storymuse.collections'))->take(3),
        ]);
    }
}
