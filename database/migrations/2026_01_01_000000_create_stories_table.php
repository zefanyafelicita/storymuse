<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stories', function (Blueprint $t) {
            $t->id();
            $t->string('title');
            $t->string('slug')->unique();
            $t->string('author');
            $t->string('genre')->index();
            $t->string('mood')->nullable()->index();
            $t->enum('length_band', ['short', 'medium', 'long']);
            $t->text('summary');
            $t->text('why_notable')->nullable();
            $t->json('tropes');
            $t->unsignedInteger('reads')->default(0);
            $t->unsignedInteger('votes')->default(0);
            $t->unsignedSmallInteger('chapters')->default(0);
            $t->decimal('rating', 2, 1)->default(0);
            // Lowercase values in the database; labels such as "Ongoing" live in App\Enums\StoryStatus.
            $t->enum('status', ['ongoing', 'completed'])->index();
            $t->enum('ending', ['happy', 'bittersweet', 'open'])->nullable(); // completed stories only
            $t->date('last_updated_at')->nullable();  // NULL when unknown, never guessed
            $t->date('completed_at')->nullable();     // NULL when unknown, never guessed
            $t->string('wattpad_url')->nullable();    // NULL until verified
            $t->boolean('wattpad_verified')->default(false);
            $t->timestamps();

            $t->index(['status', 'genre']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stories');
    }
};
