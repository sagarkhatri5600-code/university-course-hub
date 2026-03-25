<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class AdminUser
{
    public static function findByUsername(string $username): ?array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM AdminUsers WHERE Username = ? LIMIT 1");
        $stmt->execute([$username]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }
}
