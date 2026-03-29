<?php
namespace App\Models;

class AdminModel extends Model
{
    public function findByUsername(string $username): ?array
    {
        $stmt = $this->db()->prepare('SELECT * FROM admin WHERE username = ?');
        $stmt->execute([$username]);
        $admin = $stmt->fetch();

        return $admin ?: null;
    }

    public function updatePassword(int $id, string $passwordHash): void
    {
        $stmt = $this->db()->prepare('UPDATE admin SET password = ? WHERE id = ?');
        $stmt->execute([$passwordHash, $id]);
    }
}
