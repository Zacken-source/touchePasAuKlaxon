<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\AgenceModel;
use App\Models\TripModel;

class TripController extends Controller
{
    private $tripModel;
    private $agenceModel;

    public function __construct()
    {
        $this->tripModel   = new TripModel();
        $this->agenceModel = new AgenceModel();
    }

    public function index()
    {
        $trips = $this->tripModel->findAvailable();
        $user  = Session::get('user');

        $this->render('trips/index', [
            'title' => 'Trajets proposés',
            'trips' => $trips,
            'user'  => $user,
        ]);
    }

    public function create()
    {
        $user    = $this->requireAuth();
        $agences = $this->agenceModel->findAll();

        $this->render('trips/create', [
            'title'   => 'Créer un trajet',
            'agences' => $agences,
            'user'    => $user,
        ]);
    }

    public function store()
    {
        $user    = $this->requireAuth();
        $agences = $this->agenceModel->findAll();
        $errors  = [];

        $departId   = (int) ($_POST['agence_depart_id']  ?? 0);
        $arriveeId  = (int) ($_POST['agence_arrivee_id'] ?? 0);
        $gdhDepart  = trim($_POST['gdh_depart']  ?? '');
        $gdhArrivee = trim($_POST['gdh_arrivee'] ?? '');
        $places     = (int) ($_POST['nb_places_total'] ?? 0);

        if (!$departId || !$arriveeId) {
            $errors[] = 'Veuillez sélectionner les agences.';
        } elseif ($departId === $arriveeId) {
            $errors[] = 'Les agences de départ et d\'arrivée doivent être différentes.';
        }

        if (!$gdhDepart || !$gdhArrivee) {
            $errors[] = 'Les dates sont obligatoires.';
        } elseif (strtotime($gdhArrivee) <= strtotime($gdhDepart)) {
            $errors[] = 'La date d\'arrivée doit être après la date de départ.';
        } elseif (strtotime($gdhDepart) <= time()) {
            $errors[] = 'La date de départ doit être dans le futur.';
        }

        if ($places < 1 || $places > 9) {
            $errors[] = 'Le nombre de places doit être entre 1 et 9.';
        }

        if (!empty($errors)) {
            $this->render('trips/create', [
                'title'   => 'Créer un trajet',
                'agences' => $agences,
                'user'    => $user,
                'errors'  => $errors,
                'old'     => $_POST,
            ]);
            return;
        }

        $this->tripModel->create([
            'agence_depart_id'  => $departId,
            'agence_arrivee_id' => $arriveeId,
            'gdh_depart'        => $gdhDepart,
            'gdh_arrivee'       => $gdhArrivee,
            'nb_places_total'   => $places,
            'utilisateur_id'    => $user['id'],
        ]);

        Session::setFlash('Le trajet a été créé avec succès.');
        $this->redirect('/');
    }

    public function edit($id)
    {
        $user = $this->requireAuth();
        $trip = $this->tripModel->findById($id);

        if (!$trip || (int) $trip['utilisateur_id'] !== (int) $user['id']) {
            $this->redirect('/');
        }

        $agences = $this->agenceModel->findAll();
        $this->render('trips/edit', [
            'title'   => 'Modifier le trajet',
            'trip'    => $trip,
            'agences' => $agences,
            'user'    => $user,
        ]);
    }

    public function update($id)
    {
        $user = $this->requireAuth();
        $trip = $this->tripModel->findById($id);

        if (!$trip || (int) $trip['utilisateur_id'] !== (int) $user['id']) {
            $this->redirect('/');
        }

        $agences    = $this->agenceModel->findAll();
        $errors     = [];
        $departId   = (int) ($_POST['agence_depart_id']  ?? 0);
        $arriveeId  = (int) ($_POST['agence_arrivee_id'] ?? 0);
        $gdhDepart  = trim($_POST['gdh_depart']  ?? '');
        $gdhArrivee = trim($_POST['gdh_arrivee'] ?? '');
        $total      = (int) ($_POST['nb_places_total'] ?? 0);
        $dispo      = (int) ($_POST['nb_places_dispo'] ?? 0);

        if ($departId === $arriveeId) {
            $errors[] = 'Les agences doivent être différentes.';
        }
        if (strtotime($gdhArrivee) <= strtotime($gdhDepart)) {
            $errors[] = 'La date d\'arrivée doit être après le départ.';
        }
        if ($dispo > $total) {
            $errors[] = 'Les places disponibles ne peuvent pas dépasser le total.';
        }

        if (!empty($errors)) {
            $this->render('trips/edit', [
                'title'   => 'Modifier le trajet',
                'trip'    => array_merge($trip, $_POST),
                'agences' => $agences,
                'user'    => $user,
                'errors'  => $errors,
            ]);
            return;
        }

        $this->tripModel->update($id, [
            'agence_depart_id'  => $departId,
            'agence_arrivee_id' => $arriveeId,
            'gdh_depart'        => $gdhDepart,
            'gdh_arrivee'       => $gdhArrivee,
            'nb_places_total'   => $total,
            'nb_places_dispo'   => $dispo,
        ]);

        Session::setFlash('Le trajet a été modifié.');
        $this->redirect('/');
    }

    public function destroy($id)
    {
        $user = $this->requireAuth();
        $trip = $this->tripModel->findById($id);

        if (!$trip || (int) $trip['utilisateur_id'] !== (int) $user['id']) {
            $this->redirect('/');
        }

        $this->tripModel->delete($id);
        Session::setFlash('Le trajet a été supprimé.');
        $this->redirect('/');
    }
}