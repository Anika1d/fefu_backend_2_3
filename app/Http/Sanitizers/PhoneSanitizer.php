<?php

namespace App\Http\Sanitizers;

class PhoneSanitizer
{
    public static function sanitize(string $value): ?string
    {
        if ($value === null) {
            return null;
        }
        return preg_replace('/^8/', '7', preg_replace('/\D+/', '',$value));
    }
}
