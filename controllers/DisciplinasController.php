<?php

require_once "../../models/DisciplinasModel.php";

class DisciplinasController {

    private $model;

    function __construct()
    {
        $this->model = new DisciplinasModel();
    }

    public function read() {
        return $this->model->read();
    }

    public function add(Disciplinas $c) {
        return $this->model->create($c);
    }

    public function edit(Disciplinas $c) {
        return $this->model->update($c);
    }

    public function findId($id) {
        return $this->model->findId($id);
    }

    public function remove($id) {
        return $this->model->delete($id);
    }

}