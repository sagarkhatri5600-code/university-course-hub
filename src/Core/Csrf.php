<?php

namespace App\Core;

class Csrf
{
    public static function generate(): string
    {
        if (!Session::get('csrf_token')) {
            Session::set('csrf_token', bin2hex(random_bytes(32)));
        }
        return Session::get('csrf_token');
    }

    public static function validate(?string $token): bool
    {
        $stored = Session::get('csrf_token');
        if (!$stored || !$token) {
            return false;
        }
        return hash_equals($stored, $token);
    }
}
