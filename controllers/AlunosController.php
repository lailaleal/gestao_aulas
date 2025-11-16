<?php

require_once __DIR__ . "/../models/AlunosModel.php";

// Classe AlunosController que atua como intermediária entre a view e o model
// A classe AlunosController é responsável por receber as requisições da view,
// processar os dados e chamar os métodos do model para manipular os dados dos alunos.
class AlunosController {

    private $model;

    function __construct()
    {
        $this->model = new AlunosModel(); // Cria um objeto do tipo AlunosModel
    }

    public function read() {
        return $this->model->read();
    }

    public function add(Alunos $a) {
        $this->model->create($a);

        header("Location: ../../aulas");
        exit();
    }

    public function edit(Alunos $a) {
        return $this->model->update($a);
    }

    public function findId($id) { // Procurar por id
        return $this->model->findId($id);
    }

    public function remove($id) {
        return $this->model->delete($id);
    }

}
