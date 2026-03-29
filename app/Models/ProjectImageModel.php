<?php
namespace App\Models;

class ProjectImageModel extends Model
{
    public function getByProjectId(int $projectId): array
    {
        $stmt = $this->db()->prepare('SELECT * FROM project_images WHERE project_id = ?');
        $stmt->execute([$projectId]);

        return $stmt->fetchAll();
    }

    public function findForProject(int $imageId, int $projectId): ?array
    {
        $stmt = $this->db()->prepare('SELECT * FROM project_images WHERE id = ? AND project_id = ?');
        $stmt->execute([$imageId, $projectId]);
        $image = $stmt->fetch();

        return $image ?: null;
    }

    public function create(int $projectId, string $imageUrl): void
    {
        $stmt = $this->db()->prepare('INSERT INTO project_images (project_id, image_url) VALUES (?, ?)');
        $stmt->execute([$projectId, $imageUrl]);
    }

    public function delete(int $imageId): void
    {
        $stmt = $this->db()->prepare('DELETE FROM project_images WHERE id = ?');
        $stmt->execute([$imageId]);
    }
}
