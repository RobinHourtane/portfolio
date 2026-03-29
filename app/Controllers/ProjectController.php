<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\ProjectImageModel;
use App\Models\ProjectModel;
use App\Models\SettingModel;

class ProjectController extends Controller
{
    private ProjectModel $projects;
    private ProjectImageModel $images;
    private SettingModel $settings;

    public function __construct()
    {
        $this->projects = new ProjectModel();
        $this->images = new ProjectImageModel();
        $this->settings = new SettingModel();
    }

    public function index(): void
    {
        $projects = \hasDatabase() ? $this->projects->getPublished() : [];
        $githubLink = $this->settings->get('github_link', 'https://github.com/');

        $this->renderPublic('public/projects', [
            'pageTitle' => '_projets',
            'activePage' => 'projects',
            'footerGithubLink' => $githubLink,
            'projects' => $projects,
            'projectTags' => ['Comprendre', 'Exprimer', 'Concevoir', 'Développer', 'Entreprendre'],
        ]);
    }

    public function show(): void
    {
        if (!\hasDatabase()) {
            $this->redirectTo('projects.php');
        }

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            $this->redirectTo('projects.php');
        }

        $project = $this->projects->findPublishedById($id);
        if ($project === null) {
            $this->redirectTo('projects.php');
        }

        $gallery = $this->images->getByProjectId($id);
        $softwares = !empty($project['software']) ? array_map('trim', explode(',', $project['software'])) : [];
        $competences = !empty($project['competences']) ? array_map('trim', explode(',', $project['competences'])) : [];
        $typeLabels = [
            'web_dev' => 'Développement Web',
            'communication' => 'Communication',
            'digital_creation' => 'Création Numérique',
            'pro' => 'Professionnel',
            'university' => 'Universitaire',
        ];
        $displayType = $typeLabels[$project['type']] ?? $project['type'];
        $githubLink = $this->settings->get('github_link', 'https://github.com/');

        $this->renderPublic('public/project_detail', [
            'pageTitle' => $project['title'],
            'activePage' => 'projects',
            'footerGithubLink' => $githubLink,
            'project' => $project,
            'gallery' => $gallery,
            'softwares' => $softwares,
            'competences' => $competences,
            'technologies' => [$displayType],
        ]);
    }
}
