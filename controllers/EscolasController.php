<?php

require_once __DIR__ . "/../models/EscolasModel.php";
require_once __DIR__ . "/../models/Escolas.php";
require_once __DIR__ . "/../models/UsuarioModel.php";
require_once __DIR__ . "/../models/Usuario.php";

// Classe EscolasController que atua como intermediária entre a view e o model
// É responsável por receber as requisições da view, processar os dados e chamar os métodos do model.
class EscolasController {

    private $model;
    private $usuarioModel;

    function __construct() {
        $this->model = new EscolasModel(); // Cria um objeto do tipo EscolasModel
        $this->usuarioModel = new UsuarioModel();
    }

    public function read() {
        return $this->model->read();
    }

    public function add(Escolas $e) {
        $this->model->create($e);

        $usuario = new Usuarios();
        $usuario->setNome($e->getNome());
        $usuario->setEmail($e->getEmail());
        $usuario->setSenha($e->getSenha());
        $usuario->setTipo("escola");
        $usuarioId = $this->usuarioModel->create($usuario);

        if($usuarioId) {
            $usuario->setId($usuarioId);

            $_SESSION[SessionConf::$sessionObj] = serialize($usuario);
            header("Location: ../../aulas");
            exit();
        }
    }

    public function edit(Escolas $e) {
        return $this->model->update($e);
    }

    public function findId($id) {
        return $this->model->findId($id); // Procurar por id
    }

    public function remove($id) {
        return $this->model->delete($id);
    }
}
