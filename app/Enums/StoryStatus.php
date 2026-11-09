<?php

namespace App\Enums;

enum StoryStatus: string
{
    case Ongoing = 'ongoing';
    case Completed = 'completed';

    public function label(): string
    {
        return ucfirst($this->value);
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::Ongoing => 'sm-badge-ongoing',
            self::Completed => 'sm-badge-completed',
        };
    }
}
