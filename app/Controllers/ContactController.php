<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\ContactMessageModel;
use App\Models\SettingModel;

class ContactController extends Controller
{
    private ContactMessageModel $messages;
    private SettingModel $settings;

    public function __construct()
    {
        $this->messages = new ContactMessageModel();
        $this->settings = new SettingModel();
    }

    public function index(): void
    {
        $messageSent = false;
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!\hasDatabase()) {
                $error = "Le formulaire n'est pas disponible tant que la base locale n'est pas configurée.";
            } else {
                $name = trim((string) ($_POST['name'] ?? ''));
                $email = trim((string) ($_POST['email'] ?? ''));
                $subject = trim((string) ($_POST['subject'] ?? ''));
                $message = trim((string) ($_POST['message'] ?? ''));

                if ($name === '' || $email === '' || $message === '') {
                    $error = 'Tous les champs sont requis.';
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error = "Format d'email invalide.";
                } else {
                    try {
                        $this->messages->create([
                            'name' => $name,
                            'email' => $email,
                            'subject' => $subject,
                            'message' => $message,
                        ]);

                        $to = $this->settings->get('email');
                        if (!empty($to)) {
                            $headers = 'From: ' . $email;
                            mail($to, "Nouveau message de {$name} : {$subject}", $message, $headers);
                        }

                        $messageSent = true;
                    } catch (\Throwable $e) {
                        $error = "Erreur lors de l'envoi : " . $e->getMessage();
                    }
                }
            }
        }

        $githubLink = $this->settings->get('github_link', 'https://github.com/');

        $this->renderPublic('public/contact', [
            'pageTitle' => 'contactez_moi',
            'activePage' => 'contact',
            'footerGithubLink' => $githubLink,
            'messageSent' => $messageSent,
            'error' => $error,
        ]);
    }
}
