<?php

require_once "../../models/NotificacoesModel.php";
require_once __DIR__ . "/../models/Notificacoes.php";
require_once __DIR__ . '/../models/Usuario.php';

class NotificacoesController {

    private $model;

    function __construct()
    {
        $this->model = new NotificacoesModel();
    }

    public function read() {
        return $this->model->read();
    }

    public function add(Notificacoes $c) {
        return $this->model->create($c);
    }

    public function edit(Notificacoes $c) {
        return $this->model->update($c);
    }

    public function findId($id) {
        return $this->model->findId($id);
    }

    public function remove($id) {
        return $this->model->delete($id);
    }

    public function listarNaoLidas()
    {
        $usuario = unserialize($_SESSION[SessionConf::$sessionObj]);

        return $this->model->listarNaoLidas($usuario->getId());
    }

    public function marcarComoLida($id)
    {
        return $this->model->marcarComoLida($id);
    }

}