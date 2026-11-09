<?php

namespace App\Http\Controllers;

use App\Services\StoryFilter;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index(StoryFilter $filter)
    {
        $collections = collect(config('storymuse.collections'))
            ->map(fn ($c) => $c + ['count' => $filter->query($c['filters'])->get()->count()]);

        return view('collections.index', compact('collections'));
    }

    public function show(Request $request, StoryFilter $filter, string $slug)
    {
        $collection = collect(config('storymuse.collections'))->firstWhere('slug', $slug);
        abort_if($collection === null, 404);

        $fixedStatus = isset($collection['filters']['status']);
        $extra = $fixedStatus ? [] : StoryFilter::clean($request->only('status'));
        $filters = array_merge($extra, $collection['filters']);

        return view('collections.show', [
            'collection' => $collection,
            'fixedStatus' => $fixedStatus,
            'status' => $extra['status'] ?? null,
            'stories' => $filter->query($filters)->paginate(12)->withQueryString(),
        ]);
    }
}
