<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Module
{
    public static function all(): array
    {
        $db = Database::getConnection();
        return $db->query("SELECT m.*, s.Name as LeaderName 
                           FROM Modules m 
                           LEFT JOIN Staff s ON m.ModuleLeaderID = s.StaffID 
                           ORDER BY m.ModuleName")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find(int $id): ?array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT m.*, s.Name as LeaderName 
                              FROM Modules m 
                              LEFT JOIN Staff s ON m.ModuleLeaderID = s.StaffID 
                              WHERE m.ModuleID = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public static function create(array $data): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO Modules (ModuleName, ModuleLeaderID, Description, Image) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $data['name'],
            $data['leader_id'],
            $data['description'],
            $data['image'] ?? null
        ]);
    }

    public static function update(int $id, array $data): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE Modules SET ModuleName = ?, ModuleLeaderID = ?, Description = ?, Image = ? WHERE ModuleID = ?");
        return $stmt->execute([
            $data['name'],
            $data['leader_id'],
            $data['description'],
            $data['image'] ?? null,
            $id
        ]);
    }

    public static function delete(int $id): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM Modules WHERE ModuleID = ?");
        return $stmt->execute([$id]);
    }
}
