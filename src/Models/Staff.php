<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Staff
{
    public static function all(): array
    {
        $db = Database::getConnection();
        return $db->query("SELECT * FROM Staff ORDER BY Name")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById(int $id): ?array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM Staff WHERE StaffID = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public static function findByEmail(string $email): ?array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM Staff WHERE Email = ? LIMIT 1");
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public static function emailExistsForOther(string $email, int $excludeStaffId): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT 1 FROM Staff WHERE Email = ? AND StaffID != ? LIMIT 1");
        $stmt->execute([$email, $excludeStaffId]);
        return (bool) $stmt->fetchColumn();
    }

    public static function getNextId(): int
    {
        $db = Database::getConnection();
        $n = (int) $db->query("SELECT COALESCE(MAX(StaffID), 0) + 1 FROM Staff")->fetchColumn();
        return $n > 0 ? $n : 1;
    }

    public static function create(string $name, string $email, string $passwordHash): bool
    {
        $db = Database::getConnection();
        $id = self::getNextId();
        $stmt = $db->prepare("INSERT INTO Staff (StaffID, Name, Email, PasswordHash) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$id, $name, $email, $passwordHash]);
    }

    public static function update(int $id, string $name, ?string $email, ?string $passwordHash): bool
    {
        $db = Database::getConnection();
        if ($passwordHash !== null) {
            $stmt = $db->prepare("UPDATE Staff SET Name = ?, Email = ?, PasswordHash = ? WHERE StaffID = ?");
            return $stmt->execute([$name, $email, $passwordHash, $id]);
        }
        $stmt = $db->prepare("UPDATE Staff SET Name = ?, Email = ? WHERE StaffID = ?");
        return $stmt->execute([$name, $email, $id]);
    }

    public static function revokePortalAccess(int $id, string $name): bool
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE Staff SET Name = ?, Email = NULL, PasswordHash = NULL WHERE StaffID = ?");
        return $stmt->execute([$name, $id]);
    }

    public static function isReferenced(int $staffId): bool
    {
        $db = Database::getConnection();
        $m = $db->prepare("SELECT 1 FROM Modules WHERE ModuleLeaderID = ? LIMIT 1");
        $m->execute([$staffId]);
        if ($m->fetchColumn()) {
            return true;
        }
        $p = $db->prepare("SELECT 1 FROM Programmes WHERE ProgrammeLeaderID = ? LIMIT 1");
        $p->execute([$staffId]);
        return (bool) $p->fetchColumn();
    }

    public static function delete(int $id): bool
    {
        if (self::isReferenced($id)) {
            return false;
        }
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM Staff WHERE StaffID = ?");
        return $stmt->execute([$id]);
    }

    public static function getModulesLedByStaff(int $staffId): array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare(
            "SELECT ModuleID, ModuleName, Description, Image FROM Modules WHERE ModuleLeaderID = ? ORDER BY ModuleName"
        );
        $stmt->execute([$staffId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getProgrammeImpactForStaff(int $staffId): array
    {
        $db = Database::getConnection();
        $sql = "SELECT p.ProgrammeID, p.ProgrammeName, l.LevelName, m.ModuleID, m.ModuleName, pm.Year
                FROM ProgrammeModules pm
                JOIN Programmes p ON p.ProgrammeID = pm.ProgrammeID
                LEFT JOIN Levels l ON l.LevelID = p.LevelID
                JOIN Modules m ON m.ModuleID = pm.ModuleID
                WHERE pm.ModuleID IN (SELECT ModuleID FROM Modules WHERE ModuleLeaderID = ?)
                ORDER BY p.ProgrammeName, pm.Year, m.ModuleName";
        $stmt = $db->prepare($sql);
        $stmt->execute([$staffId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
