<?php
// Carrega as bibliotecas
include "../includes/autoLoad.php";
// Verifica se o usuário está logado
Security::verifyAuthentication();

// Requisa o controlador
require_once "../../controllers/ProfessoresController.php";
// Isnstancia o objeto do controlador
$ProfessoresController = new ProfessoresController();
// COntrolador busca dados no banco de dados
$resultData = $ProfessoresController->read();

?>
<!doctype html>
<html lang="pt-br">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Professores</title>
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
                                <div class="card-header">
                                    <a href="adicionar.php" class="btn btn-sm btn-success">Adicionar</a>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID Professor</th>
                                                <th>Nome Professor</th>
                                                <th>Email Professor</th>
                                                <th>Telefone Professor</th>
                                                <th>Especialidade Professor</th>
                                                <th>Biografia Professor</th>
                                                <th>Valor Hora Aula</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($resultData as $obj) { ?>
                                                <tr class="align-middle">
                                                    <td><?= $obj->getId() ?></td>
                                                    <td><?= $obj->getNome() ?></td>
                                                    <td><?= $obj->getEmail() ?></td>
                                                    <td><?= $obj->getTelefone() ?></td>
                                                    <td><?= $obj->getEspecialidade() ?></td>
                                                    <td><?= $obj->getBiografia() ?></td>
                                                    <td><?= $obj->getValorHoraAula() ?></td>
                                                    <td>
                                                        <a href="editar.php?id=<?= $obj->getId() ?>" class="btn btn-sm btn-warning">Editar</a>
                                                        <a href="#" onclick="excluir(<?= $obj->getId() ?>);" class="btn btn-sm btn-danger">Remover</a>
                                                    </td>
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
        function excluir(id){
            if(confirm("Tem certeza que quer excluir esse registro?")) {
                window.location = "excluir.php?id=" + id;
            }
        }
    </script>                                           
</body>
<!--end::Body-->

</html>