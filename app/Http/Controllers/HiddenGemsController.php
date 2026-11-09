<?php

namespace App\Http\Controllers;

use App\Services\StoryFilter;
use Illuminate\Http\Request;

class HiddenGemsController extends Controller
{
    public function __invoke(Request $request, StoryFilter $filter)
    {
        $filters = StoryFilter::clean($request->only('status')) + ['gems' => true];

        return view('gems', [
            'stories' => $filter->query($filters)->paginate(12)->withQueryString(),
            'filters' => $filters,
            'gem' => config('storymuse.gem'),
        ]);
    }
}
