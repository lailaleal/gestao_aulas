<?php
// Carrega as bibliotecas
include "../includes/autoLoad.php";
require_once "../../models/Usuario.php";
// Verifica se o usuário está logado
Security::verifyAuthentication();

$usuario = unserialize($_SESSION[SessionConf::$sessionObj]);

$tipoUsuario = $usuario->getTipo();

// Requisa o controlador
require_once "../../controllers/AulasController.php";
// Isnstancia o objeto do controlador
$AulasController = new AulasController();
// COntrolador busca dados no banco de dados

$resultData = $AulasController->getAulas();

?>
<!doctype html>
<html lang="pt-br">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Aulas</title>
    <?php include '../includes/head.php'; ?>
    <link rel="stylesheet" href="../css/adminlte.css" />
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
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <?php if ($tipoUsuario == 'aluno'): ?>
                                  <div class="card-header">
                                      <a href="adicionar.php" class="btn btn-sm btn-success">Solicitar aula</a>
                                  </div>
                                <?php endif; ?>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <?php if ($tipoUsuario == 'professor'): ?>
                                                    <th>Nome do aluno</th>
                                                <?php endif; ?>
                                                <?php if ($tipoUsuario == 'aluno'): ?>
                                                    <th>Nome da disciplina</th>
                                                <?php endif; ?>
                                                <?php if ($tipoUsuario == 'aluno'): ?>
                                                    <th>Nome do professor</th>
                                                <?php endif; ?>
                                                <th>Data</th>
                                                <th>Hora início</th>
                                                <th>Hora fim</th>
                                                <th>Status</th>
                                                <th>Tipo</th>
                                                <th>Link</th>
                                                <th>Endereço</th>
                                                <th>Observações</th>
                                                <?php if ($tipoUsuario == 'professor'): ?>
                                                  <th>Ações</th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($resultData as $obj) { ?>
                                                <tr class="align-middle">
                                                    <td><?= $obj->getId() ?></td>
                                                    <?php if ($tipoUsuario == 'professor'): ?>
                                                        <td><?= $obj->getNomeAluno() ?></td>
                                                    <?php endif; ?>
                                                    <?php if ($tipoUsuario == 'aluno'): ?>
                                                        <td><?= $obj->getDisciplina() ?></td>
                                                    <?php endif; ?>
                                                    <?php if ($tipoUsuario == 'aluno'): ?>
                                                        <td><?= $obj->getNomeProfessor() ?></td>
                                                    <?php endif; ?>
                                                    <td><?= $obj->getData() ?></td>
                                                    <td><?= $obj->getHoraInicio() ?></td>
                                                    <td><?= $obj->getHoraFim() ?></td>
                                                    <td><?= $obj->getStatus() ?></td>
                                                    <td><?= $obj->getTipo() ?></td>
                                                    <td><?= $obj->getLink() ?></td>
                                                    <td><?= $obj->getEndereco() ?></td>
                                                    <td><?= $obj->getObservacoes() ?></td>
                                                    <td>
                                                        <?php if ($tipoUsuario == 'professor' && $obj->getTipo() != 'aulao_enem'): ?>
                                                            <a href="#" onclick="confirmarAula(<?= $obj->getId() ?>);" class="btn btn-sm btn-success">Confirmar aula</a>
                                                        <!--<a href="editar.php?id=<?= $obj->getId() ?>" class="btn btn-sm btn-warning">Editar</a>-->
                                                    </td>
                                                    <?php endif; ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">

                                    <ul class="pagination pagination-sm m-0 float-end">
                                        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /.card -->
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
    <script>
        function confirmarAula(id){
            if(confirm("Tem certeza que quer confirmar esta aula?")) {
                window.location = "confirmarAula.php?id=" + id;
            }
        }
    </script>
</body>
<!--end::Body-->

</html>
