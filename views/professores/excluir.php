<?php
// Carrega as bibliotecas
include "../includes/autoLoad.php";
// Verifica se o usuário está logado
Security::verifyAuthentication();

if(isset($_GET['id']) && $_GET['id'] != "") {
    require_once "../../controllers/ProfessoresController.php";
    $ProfessoresController = new ProfessoresController();

    $rs = $ProfessoresController->remove(htmlspecialchars($_GET['id']));

    if ($rs) {
        header("location: index.php");
    }
}

?>