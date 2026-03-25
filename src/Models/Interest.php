<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Interest
{
    public static function register(int $programmeId, string $name, string $email): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO InterestedStudents (ProgrammeID, StudentName, Email) VALUES (?, ?, ?)");
        return $stmt->execute([$programmeId, $name, $email]);
    }

    public static function withdraw(string $email): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM InterestedStudents WHERE Email = ?");
        return $stmt->execute([$email]);
    }

    public static function allWithProgrammes(?int $filterProgrammeId = null): array
    {
        $db = Database::getConnection();
        $query = "SELECT i.*, p.ProgrammeName 
                  FROM InterestedStudents i 
                  JOIN Programmes p ON i.ProgrammeID = p.ProgrammeID";
        $params = [];
        
        if ($filterProgrammeId) {
            $query .= " WHERE i.ProgrammeID = ?";
            $params[] = $filterProgrammeId;
        }
        
        $query .= " ORDER BY i.RegisteredAt DESC";
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function delete(int $id): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM InterestedStudents WHERE InterestID = ?");
        return $stmt->execute([$id]);
    }
}
