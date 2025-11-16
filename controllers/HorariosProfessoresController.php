<?php

require_once __DIR__ . '/../models/HorariosProfessoresModel.php';

class HorariosProfessoresController {

    private $model;

    function __construct()
    {
        $this->model = new HorariosProfessoresModel();
    }

    public function read() {
        return $this->model->read();
    }

    public function add(HorariosProfessores $c) {
        return $this->model->create($c);
    }

    public function edit(HorariosProfessores $c) {
        return $this->model->update($c);
    }

    public function findId($id) {
        return $this->model->findId($id);
    }

    public function remove($id) {
        return $this->model->delete($id);
    }

}
