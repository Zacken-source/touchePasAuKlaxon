<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\UserModel;

class AuthController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function showLogin()
    {
        if (Session::get('user')) {
            $this->redirect('/');
        }
        $this->render('auth/login', ['title' => 'Connexion']);
    }

    public function login()
    {
        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $errors   = [];

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email invalide.';
        }
        if (empty($password)) {
            $errors[] = 'Mot de passe requis.';
        }

        if (!empty($errors)) {
            $this->render('auth/login', [
                'title'  => 'Connexion',
                'errors' => $errors,
                'email'  => $email,
            ]);
            return;
        }

        $user = $this->userModel->authenticate($email, $password);

        if (!$user) {
            $this->render('auth/login', [
                'title'  => 'Connexion',
                'errors' => ['Identifiants incorrects.'],
                'email'  => $email,
            ]);
            return;
        }

        session_regenerate_id(true);

        Session::set('user', [
            'id'     => $user['id'],
            'nom'    => $user['nom'],
            'prenom' => $user['prenom'],
            'email'  => $user['email'],
            'tel'    => $user['telephone'],
            'role'   => $user['role'],
        ]);

        Session::setFlash('Bienvenue ' . $user['prenom'] . ' !');

        if ($user['role'] === 'admin') {
            $this->redirect('/admin');
        } else {
            $this->redirect('/');
        }
    }

    public function logout()
    {
        Session::destroy();
        $this->redirect('/');
    }
}