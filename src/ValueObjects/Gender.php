<?php

namespace PersonaGenerator\ValueObjects;

enum Gender: string
{
    case Male = 'male';
    case Female = 'female';

    /**
     * The single-character code used by most candidate stores ('M' / 'F').
     */
    public function code(): string
    {
        return match ($this) {
            self::Male => 'M',
            self::Female => 'F',
        };
    }

    public function isMale(): bool
    {
        return $this === self::Male;
    }

    public function isFemale(): bool
    {
        return $this === self::Female;
    }
}
