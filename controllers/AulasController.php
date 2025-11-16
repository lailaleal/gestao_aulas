<?php

require_once "../../models/AulasModel.php";
require_once __DIR__ . "/../models/UsuarioModel.php";
require_once __DIR__ . '/../models/Usuario.php';

class AulasController {

    private $model;
    private $usuarioModel;

    function __construct()
    {
        $this->model = new AulasModel();
        $this->usuarioModel = new UsuarioModel();
    }

    public function read() {
        return $this->model->read();
    }

    public function getAulas() {
        $usuario = unserialize($_SESSION[SessionConf::$sessionObj]);
        $usuario = $this->usuarioModel->findEmail($usuario->getEmail());

        if($usuario->getTipo() == 'aluno') {
            return $this->model->getAulasDoAluno($usuario->getEmail());
        } else if($usuario->getTipo() == 'professor') {
            return $this->model->getAulasDoProfessor($usuario->getEmail());
        } else {
            return $this->model->getAulasDaEscola($usuario->getEmail());
        }
    }

    public function add(Aulas $a) {
        $aulaId = $this->model->create($a);

        return $aulaId;
    }

    public function confirmarAula($id) {
        $aula = $this->model->confirmarAula($id);

        return $aula;
    }

    public function edit(Aulas $c) {
        return $this->model->update($c);
    }

    public function findId($id) {
        return $this->model->findId($id);
    }

    public function remove($id) {
        return $this->model->delete($id);
    }

}
