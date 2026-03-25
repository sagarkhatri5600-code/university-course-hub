<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class ProgrammeModule
{
    public static function getByProgramme(int $programmeId): array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT pm.*, m.ModuleName, s.Name as LeaderName 
                              FROM ProgrammeModules pm 
                              JOIN Modules m ON pm.ModuleID = m.ModuleID 
                              LEFT JOIN Staff s ON m.ModuleLeaderID = s.StaffID 
                              WHERE pm.ProgrammeID = ? 
                              ORDER BY pm.Year ASC, m.ModuleName ASC");
        $stmt->execute([$programmeId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function assign(int $programmeId, int $moduleId, int $year): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO ProgrammeModules (ProgrammeID, ModuleID, Year) VALUES (?, ?, ?)");
        return $stmt->execute([$programmeId, $moduleId, $year]);
    }

    public static function remove(int $id): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM ProgrammeModules WHERE ProgrammeModuleID = ?");
        return $stmt->execute([$id]);
    }
}
