<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Programme
{
    public static function all(string $search = '', string $level = ''): array
    {
        $db = Database::getConnection();
        $query = "SELECT p.*, l.LevelName, s.Name as LeaderName 
                  FROM Programmes p 
                  JOIN Levels l ON p.LevelID = l.LevelID 
                  LEFT JOIN Staff s ON p.ProgrammeLeaderID = s.StaffID 
                  WHERE 1=1";
        $params = [];

        if ($search !== '') {
            $query .= " AND (p.ProgrammeName LIKE ? OR p.Description LIKE ?)";
            $params[] = "%$search%";
            $params[] = "%$search%";
        }

        if ($level !== '') {
            $query .= " AND l.LevelName = ?";
            $params[] = $level;
        }

        $query .= " ORDER BY p.ProgrammeName";
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find(int $id): ?array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT p.*, l.LevelName, s.Name as LeaderName 
                              FROM Programmes p 
                              JOIN Levels l ON p.LevelID = l.LevelID 
                              LEFT JOIN Staff s ON p.ProgrammeLeaderID = s.StaffID 
                              WHERE p.ProgrammeID = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public static function create(array $data): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO Programmes (ProgrammeName, LevelID, ProgrammeLeaderID, Description, Image) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['name'],
            $data['level_id'],
            $data['leader_id'],
            $data['description'],
            $data['image'] ?? null
        ]);
    }

    public static function update(int $id, array $data): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE Programmes SET ProgrammeName = ?, LevelID = ?, ProgrammeLeaderID = ?, Description = ?, Image = ? WHERE ProgrammeID = ?");
        return $stmt->execute([
            $data['name'],
            $data['level_id'],
            $data['leader_id'],
            $data['description'],
            $data['image'] ?? null,
            $id
        ]);
    }

    public static function delete(int $id): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM Programmes WHERE ProgrammeID = ?");
        return $stmt->execute([$id]);
    }
}
