<?php

namespace App\Core;

class StaffAuth
{
    public static function attempt(string $email, string $password): bool
    {
        $user = \App\Models\Staff::findByEmail($email);
        if (!$user || empty($user['PasswordHash'])) {
            return false;
        }

        if (password_verify($password, $user['PasswordHash'])) {
            Session::set('staff_id', $user['StaffID']);
            Session::set('staff_name', $user['Name']);
            Session::regenerateId(true);
            return true;
        }

        return false;
    }

    public static function check(): bool
    {
        return Session::get('staff_id') !== null;
    }

    public static function user(): ?array
    {
        if (!self::check()) {
            return null;
        }
        return [
            'id' => Session::get('staff_id'),
            'name' => Session::get('staff_name'),
        ];
    }

    public static function logout(): void
    {
        Session::remove('staff_id');
        Session::remove('staff_name');
    }
}
