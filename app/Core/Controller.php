<?php

namespace App\Core;

/**
 * Contrôleur de base.
 */
class Controller
{
    protected function render($view, $data = [])
    {
        extract($data);

        ob_start();
        require __DIR__ . '/../Views/' . $view . '.php';
        $content = ob_get_clean();

        require __DIR__ . '/../Views/layouts/main.php';
    }

    protected function redirect($url)
    {
        header('Location: ' . $url);
        exit;
    }

    protected function requireAuth()
    {
        $user = Session::get('user');
        if (!$user) {
            $this->redirect('/login');
        }
        return $user;
    }

    protected function requireAdmin()
    {
        $user = $this->requireAuth();
        if ($user['role'] !== 'admin') {
            $this->redirect('/');
        }
        return $user;
    }
}