<?php

namespace Database\Seeders;

use App\Models\Story;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/** 20 fictional sample stories: 10 ongoing, 10 completed. Safe to re-run (skips when data exists). */
class StorySeeder extends Seeder
{
    public function run(): void
    {
        if (Story::exists()) {
            return;
        }

        // title, author, genre, tropes, mood, length, reads, votes, chapters, rating, status, ending, date, summary, why
        $rows = [
            ['The Lighthouse Keeper’s Letters', 'mira_vale', 'Romance', ['Slow burn', 'Historical', 'Epistolary'], 'Cozy', 'short', 18400, 3900, 22, 4.7, 'completed', 'happy', '2026-03-14', 'A widowed keeper begins answering letters meant for someone else, and an unlikely friendship grows across the water.', 'Unusually high vote rate for its readership, with warm, consistent reader comments.'],
            ['Static Between Stars', 'orionquill', 'Sci-Fi', ['Space', 'Found family', 'Mystery'], 'Thoughtful', 'long', 41200, 7600, 48, 4.5, 'ongoing', null, '2026-10-28', 'A radio technician on a failing relay station hears a voice that shouldn’t exist, and must decide whom to trust.', 'Tight plotting and clear arcs, rare for stories at this readership.'],
            ['Salt & Marigold', 'junebug.writes', 'Contemporary', ['Family', 'Food', 'Coming of age'], 'Cozy', 'medium', 9800, 2400, 31, 4.8, 'completed', 'bittersweet', null, 'Three cousins reopen their grandmother’s seaside kitchen and uncover the recipes she never explained.', 'One of the highest vote-to-read ratios in its genre.'],
            ['The Thirteenth Orchard', 'hollowfern', 'Fantasy', ['Magic', 'Quest', 'Folklore'], 'Adventurous', 'long', 63000, 9100, 64, 4.4, 'ongoing', null, null, 'An orchard that appears once a century offers one wish. A cartographer’s apprentice wants to refuse it.', 'Rich worldbuilding with a small but fiercely loyal readership.'],
            ['Quiet Hours', 'ellis_n', 'Mystery', ['Small town', 'Thriller', 'Library'], 'Tense', 'medium', 27500, 4800, 37, 4.3, 'completed', 'open', '2026-06-02', 'After a night-shift librarian finds a returned book with a map inside, the town starts to remember what it buried.', 'Strong chapter-to-chapter retention in reader feedback.'],
            ['Paper Boats in March', 'saffronsky', 'Young Adult', ['Friendship', 'Grief', 'Poetry'], 'Thoughtful', 'short', 6200, 1700, 18, 4.6, 'ongoing', null, '2026-11-02', 'Two strangers trade folded notes through a school’s old pipe system and slowly learn to speak plainly.', 'A new voice with exceptional engagement for so few reads.'],
            ['A Map of Small Mercies', 'theodora_k', 'Historical', ['War', 'Found family', 'Healing'], 'Emotional', 'long', 35800, 6100, 52, 4.5, 'completed', 'bittersweet', null, 'A field nurse and a mapmaker cross a ruined countryside, each carrying a different version of home.', 'Carefully researched and consistently well reviewed by readers.'],
            ['Moonlit Rivals', 'cinnamon.ink', 'Romance', ['Enemies to lovers', 'Academia', 'Witty'], 'Playful', 'medium', 48900, 8800, 41, 4.2, 'ongoing', null, '2026-10-15', 'Two rival astronomy students are forced to share one telescope, and one very small dorm roof.', 'Sharp banter and unusually polished prose.'],
            ['The Cartographer of Rain', 'wren_alder', 'Fantasy', ['Cozy fantasy', 'Weather magic', 'Slow burn'], 'Cozy', 'medium', 14300, 3300, 29, 4.6, 'completed', 'happy', '2026-08-20', 'In a city where weather is sold by the jar, a quiet mapmaker charts storms before they arrive.', 'Gentle, inventive, and almost unknown outside its small fanbase.'],
            ['Nine Lives of Ada Pryce', 'kestrel.p', 'Sci-Fi', ['Time loop', 'Humor', 'Heart'], 'Playful', 'short', 21000, 4300, 20, 4.7, 'ongoing', null, null, 'Ada keeps waking up on the same Tuesday, and each loop she fixes one tiny thing about someone else’s life.', 'A fresh premise with warm, funny writing.'],
            ['What the Tide Returns', 'marlow_se', 'Mystery', ['Coastal', 'Family secrets', 'Slow burn'], 'Tense', 'long', 52000, 7900, 58, 4.1, 'ongoing', null, '2026-09-30', 'A marine biologist returns to her island home when a sealed lifeboat washes ashore with her name on it.', 'Atmospheric and well paced, with growing word of mouth.'],
            ['Tea at the End of the World', 'pearl.hollis', 'Contemporary', ['Cozy', 'Found family', 'Humor'], 'Cozy', 'short', 11700, 2900, 16, 4.4, 'completed', 'happy', null, 'When the world is declared ending in six weeks, a tea shop owner decides to stay open.', 'Gentle and funny, with readers returning to re-read.'],
            ['Ink on Her Collar', 'vesper.lane', 'Romance', ['Workplace romance', 'Slow burn', 'Witty'], 'Playful', 'medium', 33000, 5600, 34, 4.3, 'ongoing', null, null, 'A newspaper’s new copy editor and its star columnist keep trading corrections in the margins.', 'Steady updates and a high vote rate for its size.'],
            ['The Glass Regent', 'aurelian.hale', 'Fantasy', ['Court intrigue', 'Magic', 'Political'], 'Tense', 'long', 87000, 11200, 72, 4.5, 'completed', 'bittersweet', '2026-07-09', 'A regent made of enchanted glass must hold a kingdom together before the next coronation shatters it.', 'A finished epic with a wide readership.'],
            ['Summer of Borrowed Names', 'tansy_roe', 'Young Adult', ['Friendship', 'Coming of age', 'Identity'], 'Emotional', 'medium', 15200, 3600, 30, 4.6, 'completed', 'happy', null, 'Three friends swap identities for one summer camp season and learn who they are when no one is watching.', 'Very high vote rate and a satisfying ending.'],
            ['Letters from the Salt Road', 'dune.marrow', 'Fantasy', ['Found family', 'Travel', 'Epistolary'], 'Thoughtful', 'long', 22700, 4100, 44, 4.4, 'ongoing', null, '2026-11-05', 'A caravan courier carries letters across a desert where every oasis keeps a different kind of memory.', 'Quiet, lyrical, and recently updated.'],
            ['Late Bloomers’ Club', 'nell.arden', 'Contemporary', ['Friendship', 'Humor', 'Second chances'], 'Cozy', 'medium', 8900, 2100, 26, 4.5, 'ongoing', null, null, 'A night-class pottery group of strangers over thirty slowly becomes the family none of them expected.', 'Small readership, big word of mouth.'],
            ['The Understudy’s Winter', 'calla.reeve', 'Romance', ['Second chance', 'Theatre', 'Slow burn'], 'Emotional', 'short', 12400, 2800, 17, 4.4, 'completed', 'happy', null, 'Years after leaving the stage, a stand-in is called back to cover the one role she never got to play.', 'Short, complete, and widely re-read.'],
            ['Orbit of Quiet Things', 'sable_tern', 'Sci-Fi', ['Space', 'Grief', 'Literary'], 'Thoughtful', 'medium', 72000, 10800, 39, 4.6, 'completed', 'open', '2026-05-11', 'A salvage crew finds a ship full of belongings and tries to return each one to a family that may not exist.', 'Finished, polished, and loved by a larger audience.'],
            ['The Clockmaker’s Alibi', 'piper.vance', 'Mystery', ['Small town', 'Thriller', 'Puzzle'], 'Tense', 'medium', 61000, 8400, 46, 4.2, 'ongoing', null, '2026-10-22', 'Every clock in town stopped at 9:14, and the only man with a perfect alibi is the one who repairs them.', 'Fast pacing and a growing following.'],
        ];

        foreach ($rows as [$title, $author, $genre, $tropes, $mood, $len, $reads, $votes, $ch, $rating, $status, $ending, $date, $summary, $why]) {
            Story::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'author' => $author,
                'genre' => $genre,
                'tropes' => $tropes,
                'mood' => $mood,
                'length_band' => $len,
                'reads' => $reads,
                'votes' => $votes,
                'chapters' => $ch,
                'rating' => $rating,
                'status' => $status,
                'ending' => $ending,
                'last_updated_at' => $status === 'ongoing' ? $date : null,
                'completed_at' => $status === 'completed' ? $date : null,
                'summary' => $summary,
                'why_notable' => $why,
            ]);
        }
    }
}
