<?php
namespace App\Core;

abstract class Controller
{
    protected function renderWithLayout(string $view, string $layout, array $data = []): void
    {
        View::render($view, $data, $layout);
    }

    protected function renderPublic(string $view, array $data = []): void
    {
        View::render($view, $data, 'layouts/public');
    }

    protected function renderAdmin(string $view, array $data = []): void
    {
        View::render($view, $data, 'layouts/admin');
    }

    protected function redirectTo(string $path): void
    {
        \redirect(\siteUrl($path));
    }
}
