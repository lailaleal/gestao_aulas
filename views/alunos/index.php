<?php
// Carrega as bibliotecas
include "../includes/autoLoad.php";
// Verifica se o usuário está logado
Security::verifyAuthentication();

// Requisa o controlador
require_once "../../controllers/AlunosController.php";
// Isnstancia o objeto do controlador
$AlunosController = new AlunosController();
// COntrolador busca dados no banco de dados
$resultData = $AlunosController->read();

?>
<!doctype html>
<html lang="pt-br">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Alunos</title>
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
                            <h3 class="mb-0">Alunos</h3>
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
                                                <!-- Cabeçalho da tabela com as colunas -->
                                                <th>ID Aluno</th>
                                                <th>Nome Aluno</th>
                                                <th>Email Aluno</th>
                                                <th>Telefone Aluno</th>
                                                <th>Série</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($resultData as $obj) { ?>
                                                <!-- Linha da tabela com os dados dos alunos -->
                                                <tr class="align-middle">
                                                    <td><?= $obj->getId() ?></td>
                                                    <td><?= $obj->getNome() ?></td>
                                                    <td><?= $obj->getEmail() ?></td>
                                                    <td><?= $obj->getTelefone() ?></td>
                                                    <td><?= $obj->getSerie() ?></td>
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