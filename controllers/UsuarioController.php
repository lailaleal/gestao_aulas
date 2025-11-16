<?php
// require_once "../../vendors/Redirect/Redirect.php";
// require_once "../../vendors/FlashMessage/FlashMessage.php";
require_once "../../models/UsuarioModel.php";

class UsuarioController {

    private $model;

    function __construct()
    {
        $this->model = new UsuarioModel();
    }

    public function read() {
        return $this->model->read();
    }

    public function add(Usuarios $u) {
        return $this->model->create($u);
    }

    public function edit(Usuarios $u) {
        return $this->model->update($u);
    }

    public function findId($id) {
        return $this->model->findId($id);
    }

    /*public function editPass(string $oldPass, string $newPass, 
                                string $confirmNewPass, int $id) {
        if($newPass === $confirmNewPass) {
            $u = $this->model->findId($id);
            if($u->getSenha() == $oldPass) {
                $u->setSenha($newPass);
                FlashMessage::setMessage("A senha foi alterada", 1);
                return $this->model->updatePass($u);
            }
            // Senha não confere com banco
            FlashMessage::setMessage("A senha do banco não confere!", 0);
            Redirect::refresh();
        }
        // Confirmação de senha errada
        FlashMessage::setMessage("A nova senha não confere!", 0);
        Redirect::refresh();
    }*/

    public function remove($id) {
        return $this->model->delete($id);
    }

}