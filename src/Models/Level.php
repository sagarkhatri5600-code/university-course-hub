<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Level
{
    public static function all(): array
    {
        $db = Database::getConnection();
        return $db->query("SELECT * FROM Levels ORDER BY LevelName")->fetchAll(PDO::FETCH_ASSOC);
    }
}
