<?php
// Carrega as bibliotecas
include "../includes/autoLoad.php";
// Verifica se o usuário está logado
Security::verifyAuthentication();

require_once "../../controllers/ProfessoresController.php";
$ProfessoresController = new ProfessoresController();

if (isset($_POST) && count($_POST) > 0) {

    $obj = new Professores();

    $obj->setId(htmlspecialchars($_POST['campo-id']));
    $obj->setNome(htmlspecialchars($_POST['campo-nome']));
    $obj->setEmail(htmlspecialchars($_POST['campo-email']));
    $obj->setTelefone(htmlspecialchars($_POST['campo-telefone']));
    $obj->setEspecialidade(htmlspecialchars($_POST['campo-especialidade']));
    $obj->setBiografia(htmlspecialchars($_POST['campo-biografia']));
    $obj->setValorHoraAula(htmlspecialchars($_POST['campo-valor_hora_aula']));
    $obj->setOfereceAulaExperimental(isset($_POST['campo-oferece_aula_experimental']) ? true : false);
    $obj->setDisponivelFinalSemana(isset($_POST['campo-disponivel_final_semana']) ? true : false);

    $rs = $ProfessoresController->edit($obj);

    if ($rs) {
        header("location: index.php");
    }
} else {
    $id = $_GET['id'];

    $obj = $ProfessoresController->findId($id);
}

?>
<!doctype html>
<html lang="pt-br">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AdminLTE v4 | Dashboard</title>
    <?php include '../includes/head.php'; ?>
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        <?php include '../includes/barra-superior.php'; ?>
        <!--end::Header-->
        <!--begin::Sidebar-->
        <?php include '../includes/menu-lateral.php'; ?>
        <!--end::Sidebar-->
        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Professores</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content Header-->
            <!--begin::App Content-->
            <div class="app-content">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary card-outline mb-4">
                                <!--begin::Header-->
                                <div class="card-header">
                                    <div class="card-title">Editar</div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Form-->
                                <form action="" method="post">
                                    <input type="hidden" name="campo-id" value="<?= $obj->getId(); ?>">
                                    <!--begin::Body-->
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="id-nome" class="form-label">Nome</label>
                                            <input type="text" class="form-control" id="id-nome"
                                                name="campo-nome" value="<?= $obj->getNome(); ?>" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="id_telefone" class="form-label">Telefone</label>
                                            <input type="text" class="form-control" id="id_telefone"
                                                name="campo-telefone" value="<?= $obj->getTelefone(); ?>" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="id_email" class="form-label">E-mail</label>
                                            <input type="email" class="form-control" id="id_email"
                                                name="campo-email" value="<?= $obj->getEmail(); ?>" />
                                        </div>
                                           <div class="mb-3">
                                            <label for="id_especialidade" class="form-label">Especialidade</label>
                                            <input type="text" class="form-control" id="id_especialidade"
                                                name="campo-especialidade" value="<?= $obj->getEspecialidade(); ?>" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="id_valor_hora_aula" class="form-label">Valor Hora Aula</label>
                                            <input type="number" step="0.01" class="form-control" id="id_valor_hora_aula"
                                                name="campo-valor_hora_aula" value="<?= $obj->getValorHoraAula(); ?>" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="id_biografia" class="form-label">Biografia</label>
                                            <textarea name="campo-biografia" class="form-control" 
                                                id="id_biografia"><?= $obj->getBiografia(); ?></textarea>
                                        </div>
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="id-aula-experimental" name="campo-oferece_aula_experimental" value="1" 
                                                <?= $obj->getOfereceAulaExperimental() ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="id-aula-experimental">Oferece Aula Experimental</label>
                                        </div>
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="id-disponivel_final_semana" name="campo-disponivel_final_semana" value="1" 
                                                <?= $obj->getDisponivelFinalSemana() ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="id-disponivel_final_semana">Disponível Final de Semana</label>
                                        </div>
                                    </div>
                                    <!--end::Body-->
                                    <!--begin::Footer-->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Gravar</button>
                                    </div>
                                    <!--end::Footer-->
                                </form>
                                <!--end::Form-->
                            </div>
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content-->
        </main>
        <!--end::App Main-->
        <!--begin::Footer-->
        <?php include '../includes/rodape.php'; ?>
        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <?php include '../includes/js.php'; ?>

</body>
<!--end::Body-->

</html>