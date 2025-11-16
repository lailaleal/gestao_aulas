<?php
// Carrega as bibliotecas
include "../includes/autoLoad.php";
// Verifica se o usuário está logado
Security::verifyAuthentication();

if(isset($_GET['id']) && $_GET['id'] != "") {
    require_once "../../controllers/UsuarioController.php";
    $UsuarioController = new UsuarioController();

    $rs = $UsuarioController->remove(htmlspecialchars($_GET['id']));

    if ($rs) {
        header("location: index.php");
    }
}

?>