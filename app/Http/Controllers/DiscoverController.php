<?php

namespace App\Http\Controllers;

use App\Services\StoryFilter;
use Illuminate\Http\Request;

class DiscoverController extends Controller
{
    public function __invoke(Request $request, StoryFilter $filter)
    {
        $filters = StoryFilter::clean($request->query());

        return view('discover', [
            'stories' => $filter->query($filters)->paginate(12)->withQueryString(),
            'filters' => $filters,
            'options' => $filter->options(),
            'sorts' => StoryFilter::SORTS,
        ]);
    }
}
