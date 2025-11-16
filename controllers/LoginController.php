<?php
require_once __DIR__ . "/../vendors/Security/Security.php";
require_once __DIR__ . "/../vendors/Redirect/Redirect.php";
require_once __DIR__ . "/../vendors/FlashMessage/FlashMessage.php";
require_once __DIR__ . "/../models/UsuarioModel.php";


class LoginController {

    private $model;

    function __construct()
    {
        $this->model = new UsuarioModel();
    }

    public function login(Usuarios $user) {
        $rs = $this->model->login($user);
        if($rs) {
            $_SESSION[SessionConf::$sessionObj] = serialize($rs);   
            header("location: ../aulas");
            exit();
        } else {
            FlashMessage::setMessage("Usuário ou senha inválido", 0);
        }
    }

}