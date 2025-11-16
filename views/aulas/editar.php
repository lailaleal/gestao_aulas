<?php
// Carrega as bibliotecas
include "../includes/autoLoad.php";
// Verifica se o usuário está logado
Security::verifyAuthentication();

require_once "../../controllers/AulasController.php";
$AulasController = new AulasController();

if (isset($_POST) && count($_POST) > 0) {

    $obj = new Aulas();

    $obj->setId(htmlspecialchars($_POST['campo-id']));
    $obj->setIdAluno(htmlspecialchars($_POST['campo-id_aluno']));
    $obj->setIdProfessor(htmlspecialchars($_POST['campo-id_professor']));
    $obj->setIdDisciplina(htmlspecialchars($_POST['campo-id_disciplina']));
    $obj->setData(htmlspecialchars($_POST['campo-data']));
    $obj->setHoraInicio(htmlspecialchars($_POST['campo-hora_inicio']));
    $obj->setHoraFim(htmlspecialchars($_POST['campo-hora_fim']));
    $obj->setDuracaoMinutos(htmlspecialchars($_POST['campo-duracao_minutos']));
    $obj->setStatus(htmlspecialchars($_POST['campo-status']));
    $obj->setTipo(htmlspecialchars($_POST['campo-tipo']));
    $obj->setLink(htmlspecialchars($_POST['campo-link']));
    $obj->setEndereco(htmlspecialchars($_POST['campo-endereco']));
    $obj->setObservacoes(htmlspecialchars($_POST['campo-observacoes']));

    $rs = $AulasController->edit($obj);

    if ($rs) {
        header("location: index.php");
    }
} else {
    $id = $_GET['id'];

    $obj = $AulasController->findId($id);
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
                            <h3 class="mb-0">Aulas</h3>
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
                                            <label for="id-aluno" class="form-label">Nome do Aluno</label>
                                            <input type="text" class="form-control" id="id-aluno"
                                                name="campo-id_aluno" value="<?= $obj->getIdAluno(); ?>" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="id-professor" class="form-label">Nome do Professor</label>
                                            <input type="text" class="form-control" id="id-professor"
                                                name="campo-id_professor" value="<?= $obj->getIdProfessor(); ?>" />
                                        </div>  
                                        <div>
                                            <label for="id-disciplina" class="form-label">Disciplina</label>
                                        </div>
                                        <div>
                                            <input type="radio" id="Quimica"  name="campo-id_disciplina" value="1" <?= $obj->getIdDisciplina() == 1 ? 'checked' : ''; ?>>
                                            <label for="Quimica">Química</label>
                                        </div>
                                        <div>
                                            <input type="radio" id="Fisica" name="campo-id_disciplina" value="2" <?= $obj->getIdDisciplina() == 2 ? 'checked' : ''; ?>>
                                            <label for="Fisica">Física</label>
                                        </div>
                                        <div class="mb-3">
                                            <input type="radio" id="Matematica" name="campo-id_disciplina" value="3" <?= $obj->getIdDisciplina() == 3 ? 'checked' : ''; ?>>
                                            <label for="Matematica">Matemática</label>
                                        </div>
                                        <div class="mb-3">
                                            <label for="data" class="form-label">Data</label>
                                            <input type="date" class="form-control" id="data"
                                                name="campo-data" value="<?= $obj->getData(); ?>" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="hora_inicio" class="form-label">Hora de Início</label>
                                            <input type="time" class="form-control" id="hora_inicio"
                                                name="campo-hora_inicio" value="<?= $obj->getHoraInicio(); ?>" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="hora_fim" class="form-label">Hora de Fim</label>
                                            <input type="time" class="form-control" id="hora_fim"
                                                name="campo-hora_fim" value="<?= $obj->getHoraFim(); ?>" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="duracao_minutos" class="form-label">Duração (minutos)</label>
                                            <input type="number" class="form-control" id="duracao_minutos"
                                                name="campo-duracao_minutos" value="<?= $obj->getDuracaoMinutos(); ?>" />
                                        </div>    
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status da Aula</label>
                                            <select class="form-select" id="status" name="campo-status">
                                                <option value="agendada" <?= $obj->getStatus() == 'Agendada' ? 'selected' : ''; ?>>Agendada</option>
                                                <option value="confirmada" <?= $obj->getStatus() == 'Confirmada' ? 'selected' : ''; ?>>Confirmada</option>
                                                <option value="cancelada" <?= $obj->getStatus() == 'Cancelada' ? 'selected' : ''; ?>>Cancelada</option>
                                                <option value="concluida" <?= $obj->getStatus() == 'Concluida' ? 'selected' : ''; ?>>Concluída</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tipo" class="form-label">Tipo de Aula</label>
                                            <select class="form-select" id="tipo" name="campo-tipo" >
                                                <option value="presencial" <?= $obj->getTipo() == 'Presencial' ? 'selected' : ''; ?>>Presencial</option>
                                                <option value="online" <?= $obj->getTipo() == 'Online' ? 'selected' : ''; ?>>Online</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="link" class="form-label">Link da Aula (se online)</label>
                                            <input type="url" class="form-control" id="link"
                                                name="campo-link" value="<?= $obj->getLink(); ?>" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="endereco" class="form-label">Endereço da Aula (se presencial)</label>
                                            <input type="text" class="form-control" id="endereco"
                                                name="campo-endereco" value="<?= $obj->getEndereco(); ?>" />
                                        </div>  
                                        <div class="mb-3">
                                            <label for="observacoes" class="form-label">Observações</label>
                                            <textarea name="campo-observacoes" class="form-control" id="observacoes"><?= $obj->getObservacoes(); ?></textarea>
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