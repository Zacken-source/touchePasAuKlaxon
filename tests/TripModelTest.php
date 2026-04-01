<?php

namespace Tests;

use App\Models\TripModel;
use PHPUnit\Framework\TestCase;

class TripModelTest extends TestCase
{
    private $model;

    protected function setUp(): void
    {
        $this->model = new TripModel();
    }

    public function testCreateRetourneUnId()
    {
        $id = $this->model->create([
            'agence_depart_id'  => 1,
            'agence_arrivee_id' => 2,
            'gdh_depart'        => '2027-06-01 08:00:00',
            'gdh_arrivee'       => '2027-06-01 10:00:00',
            'nb_places_total'   => 3,
            'utilisateur_id'    => 1,
        ]);

        $this->assertGreaterThan(0, $id);
        $this->model->delete($id);
    }

    public function testUpdateRetourneTrue()
    {
        $id = $this->model->create([
            'agence_depart_id'  => 1,
            'agence_arrivee_id' => 3,
            'gdh_depart'        => '2027-07-01 09:00:00',
            'gdh_arrivee'       => '2027-07-01 12:00:00',
            'nb_places_total'   => 4,
            'utilisateur_id'    => 1,
        ]);

        $result = $this->model->update($id, [
            'agence_depart_id'  => 1,
            'agence_arrivee_id' => 3,
            'gdh_depart'        => '2027-07-01 09:00:00',
            'gdh_arrivee'       => '2027-07-01 13:00:00',
            'nb_places_total'   => 4,
            'nb_places_dispo'   => 2,
        ]);

        $this->assertTrue($result);
        $this->model->delete($id);
    }

    public function testDeleteRetourneTrue()
    {
        $id = $this->model->create([
            'agence_depart_id'  => 2,
            'agence_arrivee_id' => 4,
            'gdh_depart'        => '2027-08-01 07:00:00',
            'gdh_arrivee'       => '2027-08-01 11:00:00',
            'nb_places_total'   => 2,
            'utilisateur_id'    => 1,
        ]);

        $this->assertTrue($this->model->delete($id));
    }

    public function testFindAvailableRetourneTableau()
    {
        $this->assertIsArray($this->model->findAvailable());
    }
}