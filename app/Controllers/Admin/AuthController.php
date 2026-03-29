<?php
namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\AdminModel;

class AuthController extends Controller
{
    private AdminModel $admins;

    public function __construct()
    {
        $this->admins = new AdminModel();
    }

    public function login(): void
    {
        \requireDatabase();

        if (\isLoggedIn()) {
            $this->redirectTo('admin/index.php');
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim((string) ($_POST['username'] ?? ''));
            $password = (string) ($_POST['password'] ?? '');

            if ($username !== '' && $password !== '') {
                $user = $this->admins->findByUsername($username);

                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['admin_id'] = $user['id'];
                    $_SESSION['admin_user'] = $user['username'];
                    session_regenerate_id(true);

                    $this->redirectTo('admin/index.php');
                }

                $error = 'Identifiants incorrects.';
            } else {
                $error = 'Veuillez remplir tous les champs.';
            }
        }

        $this->renderWithLayout('admin/login', 'layouts/auth', [
            'pageTitle' => 'Admin Login',
            'error' => $error,
        ]);
    }

    public function logout(): void
    {
        session_unset();
        session_destroy();

        $this->redirectTo('admin/login.php');
    }
}
