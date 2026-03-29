<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\AdminModel;
use App\Models\SettingModel;

class SettingsController extends Controller
{
    private SettingModel $settings;
    private AdminModel $admins;

    public function __construct()
    {
        $this->settings = new SettingModel();
        $this->admins = new AdminModel();
    }

    public function index(): void
    {
        \requireLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!\verifyCsrfToken($_POST['csrf_token'] ?? '')) {
                die('Erreur CSRF');
            }

            $settingsToSave = [];
            foreach (['github_link', 'email', 'phone', 'bio'] as $key) {
                if (isset($_POST[$key])) {
                    $settingsToSave[$key] = trim((string) $_POST[$key]);
                }
            }

            $this->settings->saveMany($settingsToSave);

            $newPassword = (string) ($_POST['new_password'] ?? '');
            if ($newPassword !== '' && isset($_SESSION['admin_id'])) {
                $this->admins->updatePassword((int) $_SESSION['admin_id'], password_hash($newPassword, PASSWORD_DEFAULT));
            }

            $this->redirectTo('admin/settings.php?success=1');
        }

        $this->renderAdmin('admin/settings', [
            'pageTitle' => 'Paramètres',
            'adminSection' => 'settings',
            'currentSettings' => $this->settings->allKeyed(),
            'success' => isset($_GET['success']),
        ]);
    }
}
