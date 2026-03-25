<?php

namespace App\Core;

class Auth
{
    public static function attempt(string $username, string $password): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM AdminUsers WHERE Username = ? LIMIT 1");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['PasswordHash'])) {
            Session::set('admin_id', $user['AdminID']);
            Session::set('admin_username', $user['Username']);
            Session::regenerateId(true);
            return true;
        }

        return false;
    }

    public static function check(): bool
    {
        return Session::get('admin_id') !== null;
    }

    public static function user(): ?array
    {
        if (self::check()) {
            return [
                'id' => Session::get('admin_id'),
                'username' => Session::get('admin_username')
            ];
        }
        return null;
    }

    public static function logout(): void
    {
        Session::remove('admin_id');
        Session::remove('admin_username');
        Session::destroy();
    }
}
