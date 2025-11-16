<?php

require_once __DIR__ . "../../models/ProfessoresModel.php";
require_once __DIR__ . "/../models/UsuarioModel.php";
require_once __DIR__ . "/../models/Usuario.php";

class ProfessoresController {

    private $model;
    private $usuarioModel;

    function __construct()
    {
        $this->model = new ProfessoresModel();
        $this->usuarioModel = new UsuarioModel();
    }

    public function read() {
        return $this->model->read();
    }

    public function add(Professores $p) {
        $professor = $this->model->create($p);

        $usuario = new Usuarios();
        $usuario->setNome($p->getNome());
        $usuario->setEmail($p->getEmail()); 
        $usuario->setSenha($p->getSenha());
        $usuario->setTipo("professor");
        $usuarioId = $this->usuarioModel->create($usuario);

        if($usuarioId) {
            $usuario->setId($usuarioId);

            $_SESSION[SessionConf::$sessionObj] = serialize($usuario);
            header("Location: ../../aulas");
            exit();
        }
    }

    public function edit(Professores $p) {
        return $this->model->update($p);
    }

    public function findId($id) {
        return $this->model->findId($id);
    }

    public function remove($id) {
        return $this->model->delete($id);
    }

}