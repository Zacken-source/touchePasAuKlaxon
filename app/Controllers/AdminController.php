<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\AgenceModel;
use App\Models\TripModel;
use App\Models\UserModel;

class AdminController extends Controller
{
    private $userModel;
    private $agenceModel;
    private $tripModel;

    public function __construct()
    {
        $this->userModel   = new UserModel();
        $this->agenceModel = new AgenceModel();
        $this->tripModel   = new TripModel();
    }

    public function dashboard()
    {
        $this->requireAdmin();
        $this->render('admin/dashboard', ['title' => 'Administration']);
    }

    public function users()
    {
        $this->requireAdmin();
        $this->render('admin/users', [
            'title' => 'Utilisateurs',
            'users' => $this->userModel->findAll(),
        ]);
    }

    public function agencies()
    {
        $this->requireAdmin();
        $this->render('admin/agencies/index', [
            'title'   => 'Agences',
            'agences' => $this->agenceModel->findAll(),
        ]);
    }

    public function createAgency()
    {
        $this->requireAdmin();
        $this->render('admin/agencies/create', ['title' => 'Nouvelle agence']);
    }

    public function storeAgency()
    {
        $this->requireAdmin();
        $nom = trim($_POST['nom'] ?? '');

        if (empty($nom)) {
            $this->render('admin/agencies/create', [
                'title'  => 'Nouvelle agence',
                'errors' => ['Le nom est requis.'],
            ]);
            return;
        }

        $this->agenceModel->create($nom);
        Session::setFlash('L\'agence a été créée.');
        $this->redirect('/admin/agencies');
    }

    public function editAgency($id)
    {
        $this->requireAdmin();
        $agence = $this->agenceModel->findById($id);

        if (!$agence) {
            $this->redirect('/admin/agencies');
        }

        $this->render('admin/agencies/edit', [
            'title'  => 'Modifier l\'agence',
            'agence' => $agence,
        ]);
    }

    public function updateAgency($id)
    {
        $this->requireAdmin();
        $nom    = trim($_POST['nom'] ?? '');
        $agence = $this->agenceModel->findById($id);

        if (!$agence) {
            $this->redirect('/admin/agencies');
        }

        if (empty($nom)) {
            $this->render('admin/agencies/edit', [
                'title'  => 'Modifier l\'agence',
                'agence' => $agence,
                'errors' => ['Le nom est requis.'],
            ]);
            return;
        }

        $this->agenceModel->update($id, $nom);
        Session::setFlash('L\'agence a été modifiée.');
        $this->redirect('/admin/agencies');
    }

    public function destroyAgency($id)
    {
        $this->requireAdmin();
        $this->agenceModel->delete($id);
        Session::setFlash('L\'agence a été supprimée.');
        $this->redirect('/admin/agencies');
    }

    public function trips()
    {
        $this->requireAdmin();
        $this->render('admin/trips/index', [
            'title' => 'Trajets',
            'trips' => $this->tripModel->findAvailable(),
        ]);
    }

    public function destroyTrip($id)
    {
        $this->requireAdmin();
        $this->tripModel->delete($id);
        Session::setFlash('Le trajet a été supprimé.');
        $this->redirect('/admin/trips');
    }
}