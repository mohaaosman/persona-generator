<?php

namespace PersonaGenerator\Contracts;

use PersonaGenerator\Persona;

/**
 * Generates the free-text fields of a persona (bio, cover letter). Drivers may
 * be offline (templates) or AI-backed; either way they must return a non-empty
 * string and never throw.
 */
interface ProseDriver
{
    public function bio(Persona $persona): string;

    public function coverLetter(Persona $persona): string;
}
