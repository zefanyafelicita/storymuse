<?php

return [
    // Hidden Gems scoring (0–100). See App\Services\HiddenGemService.
    'gem' => [
        'min_reads' => 1000,
        'max_reads' => 50000,
        'ratio_target' => 0.25,   // a 25% vote-to-read ratio earns full engagement points
        'threshold' => 55,
        'weights' => ['engagement' => 60, 'rating' => 25, 'obscurity' => 15],
    ],

    // Curated collections. "filters" are applied by the Discover filter service (part 2).
    'collections' => [
        ['slug' => 'cozy-reads', 'name' => 'Cozy reads for rainy days', 'description' => 'Gentle stories with warm hearts.', 'tone' => 'peach', 'filters' => ['mood' => 'Cozy']],
        ['slug' => 'slow-burns', 'name' => 'Slow burns worth the wait', 'description' => 'Romance and mystery that take their time.', 'tone' => 'pink', 'filters' => ['trope' => 'Slow burn']],
        ['slug' => 'found-family', 'name' => 'Found-family favourites', 'description' => 'Chosen people, shared tables.', 'tone' => 'lavender', 'filters' => ['trope' => 'Found family']],
        ['slug' => 'weekend-reads', 'name' => 'Finish in a weekend', 'description' => 'Short, complete stories.', 'tone' => 'peach', 'filters' => ['length' => 'short']],
        ['slug' => 'completed-stories', 'name' => 'Completed stories', 'description' => 'Finished stories you can read from start to end.', 'tone' => 'lavender', 'filters' => ['status' => 'completed']],
        ['slug' => 'ongoing-romance', 'name' => 'Ongoing romance', 'description' => 'Romances still being written.', 'tone' => 'pink', 'filters' => ['status' => 'ongoing', 'genre' => 'Romance']],
        ['slug' => 'completed-hidden-gems', 'name' => 'Completed hidden gems', 'description' => 'Finished stories with few reads and many fans.', 'tone' => 'lavender', 'filters' => ['status' => 'completed', 'gems' => true]],
        ['slug' => 'ongoing-fantasy', 'name' => 'Ongoing fantasy', 'description' => 'Fantasy worlds that are still growing.', 'tone' => 'peach', 'filters' => ['status' => 'ongoing', 'genre' => 'Fantasy']],
    ],
];
