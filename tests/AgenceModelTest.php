<?php

namespace Tests;

use App\Models\AgenceModel;
use PHPUnit\Framework\TestCase;

class AgenceModelTest extends TestCase
{
    private $model;

    protected function setUp(): void
    {
        $this->model = new AgenceModel();
    }

    public function testCreateRetourneUnId()
    {
        $id = $this->model->create('Ville Test');
        $this->assertGreaterThan(0, $id);
        $this->model->delete($id);
    }

    public function testUpdateRetourneTrue()
    {
        $id     = $this->model->create('Ville Avant');
        $result = $this->model->update($id, 'Ville Après');
        $this->assertTrue($result);
        $this->model->delete($id);
    }

    public function testDeleteRetourneTrue()
    {
        $id = $this->model->create('Ville À Supprimer');
        $this->assertTrue($this->model->delete($id));
    }

    public function testFindAllRetourneTableau()
    {
        $this->assertIsArray($this->model->findAll());
    }
}