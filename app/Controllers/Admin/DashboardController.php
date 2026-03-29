<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\ContactMessageModel;
use App\Models\ProjectModel;

class DashboardController extends Controller
{
    private ProjectModel $projects;
    private ContactMessageModel $messages;

    public function __construct()
    {
        $this->projects = new ProjectModel();
        $this->messages = new ContactMessageModel();
    }

    public function index(): void
    {
        \requireLogin();

        $this->renderAdmin('admin/dashboard', [
            'pageTitle' => 'Dashboard',
            'adminSection' => 'dashboard',
            'stats' => [
                'projects' => $this->projects->countAll(),
                'messages' => $this->messages->countUnread(),
            ],
            'latestMessages' => $this->messages->getLatest(),
        ]);
    }
}
