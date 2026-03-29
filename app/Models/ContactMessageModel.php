<?php
namespace App\Models;

class ContactMessageModel extends Model
{
    public function create(array $message): void
    {
        $stmt = $this->db()->prepare(
            'INSERT INTO contact_messages (name, email, subject, message, created_at) VALUES (?, ?, ?, ?, NOW())'
        );
        $stmt->execute([
            $message['name'],
            $message['email'],
            $message['subject'],
            $message['message'],
        ]);
    }

    public function getAll(): array
    {
        $stmt = $this->db()->query('SELECT * FROM contact_messages ORDER BY created_at DESC');
        return $stmt->fetchAll();
    }

    public function getLatest(int $limit = 5): array
    {
        $stmt = $this->db()->prepare('SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT ?');
        $stmt->bindValue(1, $limit, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function countUnread(): int
    {
        return (int) $this->db()->query('SELECT COUNT(*) FROM contact_messages WHERE is_read = 0')->fetchColumn();
    }

    public function markRead(int $id): void
    {
        $stmt = $this->db()->prepare('UPDATE contact_messages SET is_read = 1 WHERE id = ?');
        $stmt->execute([$id]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db()->prepare('DELETE FROM contact_messages WHERE id = ?');
        $stmt->execute([$id]);
    }
}
