<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\ProjectImageModel;
use App\Models\ProjectModel;

class ProjectController extends Controller
{
    private ProjectModel $projects;
    private ProjectImageModel $images;

    public function __construct()
    {
        $this->projects = new ProjectModel();
        $this->images = new ProjectImageModel();
    }

    public function index(): void
    {
        \requireLogin();

        $this->renderAdmin('admin/projects/list', [
            'pageTitle' => 'Gérer les projets',
            'adminSection' => 'projects',
            'projects' => $this->projects->getAll(),
            'success' => (string) ($_GET['success'] ?? ''),
        ]);
    }

    public function create(): void
    {
        \requireLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->assertCsrf();

            $project = $this->normalizedProjectInput();
            $project['image_url'] = $this->uploadSingleImage($_FILES['image'] ?? null);

            $projectId = $this->projects->create($project);
            $this->storeGalleryFiles($projectId, $_FILES['gallery'] ?? null);

            $this->redirectTo('admin/projects/list.php?success=created');
        }

        $this->renderProjectForm([
            'pageTitle' => 'Ajouter un projet',
            'heading' => 'Ajouter un projet',
            'submitLabel' => 'Enregistrer le projet',
            'formAction' => \siteUrl('admin/projects/add.php'),
            'project' => $this->emptyProject(),
            'galleryImages' => [],
            'currentTags' => [],
            'success' => false,
        ]);
    }

    public function edit(): void
    {
        \requireLogin();

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            $this->redirectTo('admin/projects/list.php');
        }

        $project = $this->projects->findById($id);
        if ($project === null) {
            $this->redirectTo('admin/projects/list.php');
        }

        $deleteImageId = filter_input(INPUT_GET, 'del_img', FILTER_VALIDATE_INT);
        if ($deleteImageId) {
            $image = $this->images->findForProject($deleteImageId, $id);
            if ($image) {
                \deleteImage($image['image_url'], PROJECT_UPLOADS_PATH);
                $this->images->delete($deleteImageId);
            }

            $this->redirectTo('admin/projects/edit.php?id=' . $id);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->assertCsrf();

            $updatedProject = $this->normalizedProjectInput();
            $updatedProject['image_url'] = $project['image_url'];

            $newCover = $this->uploadSingleImage($_FILES['image'] ?? null);
            if ($newCover !== null) {
                if (!empty($project['image_url'])) {
                    \deleteImage($project['image_url'], PROJECT_UPLOADS_PATH);
                }

                $updatedProject['image_url'] = $newCover;
            }

            $this->projects->update($id, $updatedProject);
            $this->storeGalleryFiles($id, $_FILES['gallery'] ?? null);

            $this->redirectTo('admin/projects/edit.php?id=' . $id . '&success=updated');
        }

        $this->renderProjectForm([
            'pageTitle' => 'Modifier projet',
            'heading' => 'Modifier : ' . $project['title'],
            'submitLabel' => 'Mettre à jour',
            'formAction' => \siteUrl('admin/projects/edit.php?id=' . $id),
            'project' => $project,
            'galleryImages' => $this->images->getByProjectId($id),
            'currentTags' => $this->extractTags($project['competences'] ?? ''),
            'success' => isset($_GET['success']),
        ]);
    }

    public function delete(): void
    {
        \requireLogin();

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id) {
            $project = $this->projects->findById($id);

            if ($project) {
                if (!empty($project['image_url'])) {
                    \deleteImage($project['image_url'], PROJECT_UPLOADS_PATH);
                }

                foreach ($this->images->getByProjectId($id) as $image) {
                    \deleteImage($image['image_url'], PROJECT_UPLOADS_PATH);
                }

                $this->projects->delete($id);
            }
        }

        $this->redirectTo('admin/projects/list.php?success=deleted');
    }

    private function renderProjectForm(array $data): void
    {
        $this->renderAdmin('admin/projects/form', $data + [
            'adminSection' => 'projects',
            'backUrl' => \siteUrl('admin/projects/list.php'),
            'backLabel' => 'Retour liste',
            'tags' => $this->availableTags(),
            'categoryOptions' => [
                'pro' => 'Projets Pro',
                'university' => 'Universitaire',
            ],
            'typeOptions' => [
                'web_dev' => 'Web Dev',
                'communication' => 'Communication',
                'digital_creation' => 'Créa Numérique',
            ],
        ]);
    }

    private function assertCsrf(): void
    {
        if (!\verifyCsrfToken($_POST['csrf_token'] ?? '')) {
            die('Erreur CSRF');
        }
    }

    private function normalizedProjectInput(): array
    {
        $category = (string) ($_POST['category'] ?? 'pro');
        if (!array_key_exists($category, ['pro' => true, 'university' => true])) {
            $category = 'pro';
        }

        $type = (string) ($_POST['type'] ?? 'web_dev');
        if (!array_key_exists($type, ['web_dev' => true, 'communication' => true, 'digital_creation' => true])) {
            $type = 'web_dev';
        }

        $selectedTags = $_POST['competences'] ?? [];
        if (!is_array($selectedTags)) {
            $selectedTags = [];
        }

        $selectedTags = array_values(array_intersect($this->availableTags(), $selectedTags));

        return [
            'title' => trim((string) ($_POST['title'] ?? '')),
            'subtitle' => trim((string) ($_POST['subtitle'] ?? '')),
            'description' => trim((string) ($_POST['description'] ?? '')),
            'category' => $category,
            'type' => $type,
            'live_link' => trim((string) ($_POST['live_link'] ?? '')),
            'is_published' => isset($_POST['is_published']) ? 1 : 0,
            'software' => trim((string) ($_POST['software'] ?? '')),
            'competences' => implode(',', $selectedTags),
        ];
    }

    private function uploadSingleImage(?array $file): ?string
    {
        if (!is_array($file) || ($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
            return null;
        }

        $image = \uploadImage($file, PROJECT_UPLOADS_PATH, 'proj_');
        return $image ?: null;
    }

    private function storeGalleryFiles(int $projectId, ?array $files): void
    {
        if (!is_array($files) || !isset($files['name']) || !is_array($files['name'])) {
            return;
        }

        $count = count($files['name']);

        for ($i = 0; $i < $count; $i++) {
            if (($files['error'][$i] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
                continue;
            }

            $file = [
                'name' => $files['name'][$i],
                'type' => $files['type'][$i],
                'tmp_name' => $files['tmp_name'][$i],
                'error' => $files['error'][$i],
                'size' => $files['size'][$i],
            ];

            $galleryImage = \uploadImage($file, PROJECT_UPLOADS_PATH, 'proj_');
            if ($galleryImage) {
                $this->images->create($projectId, $galleryImage);
            }
        }
    }

    private function extractTags(string $rawTags): array
    {
        if ($rawTags === '') {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode(',', $rawTags))));
    }

    private function availableTags(): array
    {
        return ['Comprendre', 'Exprimer', 'Concevoir', 'Développer', 'Entreprendre'];
    }

    private function emptyProject(): array
    {
        return [
            'title' => '',
            'subtitle' => '',
            'description' => '',
            'category' => 'pro',
            'type' => 'web_dev',
            'software' => '',
            'competences' => '',
            'live_link' => '',
            'is_published' => 1,
            'image_url' => null,
        ];
    }
}
