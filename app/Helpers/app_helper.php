<?php

if (! function_exists('initials')) {
    /** Make a short avatar monogram from a name. */
    function initials(string $name): string
    {
        $parts = preg_split('/\s+/', trim($name), -1, PREG_SPLIT_NO_EMPTY) ?: [];
        $letters = '';

        foreach (array_slice($parts, 0, 2) as $part) {
            $letters .= mb_strtoupper(mb_substr($part, 0, 1));
        }

        return $letters !== '' ? $letters : 'ET';
    }
}
