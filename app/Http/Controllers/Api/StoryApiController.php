<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StoryApiController extends Controller
{
    public function index(): JsonResponse
    {
        $stories = Story::query()
            ->latest()
            ->paginate(10);

        return response()->json($stories);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:stories,slug',
            'author' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'mood' => 'nullable|string|max:255',
            'length_band' => 'required|in:short,medium,long',
            'summary' => 'required|string',
            'why_notable' => 'nullable|string',
            'tropes' => 'required|array',
            'reads' => 'sometimes|integer|min:0',
            'votes' => 'sometimes|integer|min:0',
            'chapters' => 'sometimes|integer|min:0',
            'rating' => 'sometimes|numeric|min:0|max:9.9',
            'status' => 'required|in:ongoing,completed',
            'ending' => 'nullable|in:happy,bittersweet,open',
            'last_updated_at' => 'nullable|date',
            'completed_at' => 'nullable|date',
            'wattpad_url' => 'nullable|url',
            'wattpad_verified' => 'sometimes|boolean',
        ]);

        $story = Story::create($validated);

        return response()->json([
            'message' => 'Story created successfully.',
            'data' => $story,
        ], 201);
    }
}
