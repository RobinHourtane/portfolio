<?php
namespace App\Models;

class ProjectModel extends Model
{
    public function getPublished(): array
    {
        $stmt = $this->db()->query(
            'SELECT * FROM projects WHERE is_published = 1 ORDER BY order_position ASC, created_at DESC'
        );

        return $stmt->fetchAll();
    }

    public function getAll(): array
    {
        $stmt = $this->db()->query('SELECT * FROM projects ORDER BY created_at DESC');
        return $stmt->fetchAll();
    }

    public function countAll(): int
    {
        return (int) $this->db()->query('SELECT COUNT(*) FROM projects')->fetchColumn();
    }

    public function findPublishedById(int $id): ?array
    {
        $stmt = $this->db()->prepare('SELECT * FROM projects WHERE id = ? AND is_published = 1');
        $stmt->execute([$id]);
        $project = $stmt->fetch();

        return $project ?: null;
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db()->prepare('SELECT * FROM projects WHERE id = ?');
        $stmt->execute([$id]);
        $project = $stmt->fetch();

        return $project ?: null;
    }

    public function create(array $project): int
    {
        $sql = 'INSERT INTO projects (title, subtitle, description, category, type, competences, software, live_link, is_published, image_url, created_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())';
        $stmt = $this->db()->prepare($sql);
        $stmt->execute([
            $project['title'],
            $project['subtitle'],
            $project['description'],
            $project['category'],
            $project['type'],
            $project['competences'],
            $project['software'],
            $project['live_link'],
            $project['is_published'],
            $project['image_url'],
        ]);

        return (int) $this->db()->lastInsertId();
    }

    public function update(int $id, array $project): void
    {
        $sql = 'UPDATE projects
                SET title = ?, subtitle = ?, description = ?, category = ?, type = ?, competences = ?, software = ?, live_link = ?, is_published = ?, image_url = ?
                WHERE id = ?';
        $stmt = $this->db()->prepare($sql);
        $stmt->execute([
            $project['title'],
            $project['subtitle'],
            $project['description'],
            $project['category'],
            $project['type'],
            $project['competences'],
            $project['software'],
            $project['live_link'],
            $project['is_published'],
            $project['image_url'],
            $id,
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db()->prepare('DELETE FROM projects WHERE id = ?');
        $stmt->execute([$id]);
    }
}
