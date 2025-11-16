<?php
// Carrega as bibliotecas
include "../includes/autoLoad.php";
// Verifica se o usuário está logado
Security::verifyAuthentication();

if(isset($_GET['id']) && $_GET['id'] != "") {
    require_once "../../controllers/AlunosController.php";

    // Cria um objeto do tipo AlunosController
    $AlunosController = new AlunosController();

    // Pede o controller para remover um aluno pelo id do aluno
    $rs = $AlunosController->remove(htmlspecialchars($_GET['id']));

    if ($rs) {
        header("location: index.php");
    }
}

?>