<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\SettingModel;

class PageController extends Controller
{
    private SettingModel $settings;

    public function __construct()
    {
        $this->settings = new SettingModel();
    }

    public function home(): void
    {
        $githubLink = $this->settings->get('github_link', 'https://github.com/');

        $this->renderPublic('public/home', [
            'pageTitle' => '_Bienvenue',
            'activePage' => 'home',
            'githubLink' => $githubLink,
            'footerGithubLink' => $githubLink,
        ]);
    }

    public function about(): void
    {
        $settings = \hasDatabase() ? $this->settings->allKeyed() : [];
        $githubLink = $settings['github_link'] ?? 'https://github.com/';

        $this->renderPublic('public/about', [
            'pageTitle' => 'À propos',
            'activePage' => 'about',
            'footerGithubLink' => $githubLink,
            'aboutBio' => $settings['bio'] ?? "Passionné par le design graphique, le développement web et la communication digitale, je m'appelle Robin Hourtané, étudiant en BUT MMI à l’IUT de Toulon. Curieux, rigoureux et créatif, j'aime concevoir des expériences web soignées, à la fois visuelles et fonctionnelles. Mes compétences vont de l’UI/UX au développement PHP en passant par la gestion de projets.",
            'aboutImageUrl' => \aboutImageUrl($settings['about_image'] ?? null),
            'contactEmail' => $settings['email'] ?? 'robin.hourtane@gmail.com',
            'contactPhone' => $settings['phone'] ?? '+33610105558',
        ]);
    }
}
