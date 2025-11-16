<?php
include "../includes/autoLoad.php";
Security::verifyAuthentication();

// Requisita controlador
require_once "../../controllers/UsuarioController.php";
// Instacia o controlador
$UsuarioController = new UsuarioController();

// Verificações
if (isset($_POST) && count($_POST) > 0) {
    // Gravação dos dados
    $id = htmlspecialchars($_POST['campo-id']);
    $senhaAtual = md5($_POST['campo-senha']);
    $senhaNova = md5($_POST['campo-senhaNova']);
    $senhaNovaConf = md5($_POST['campo-senhaNovaConf']);
    // Executa método EDIT
    $rs = $UsuarioController->editPass($senhaAtual, $senhaNova, 
                                        $senhaNovaConf, $id);
    // Redireciona para a INDEX
    if ($rs) {
        header("location: ./");
        exit();
    }

} else if(isset($_GET['id']) && !empty($_GET['id'])) {
    $obj = $UsuarioController->findId($_GET['id']);
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
                            <h3 class="mb-0">Usuarios</h3>
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
                                    <div class="card-title">Editar senha</div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Form-->
                                <form action="" method="post">
                                    <input type="hidden" name="campo-id" value="<?= $obj->getId(); ?>">
                                    <!--begin::Body-->
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="id-senha" class="form-label">Senha</label>
                                            <input type="password" class="form-control" id="id-senha"
                                                name="campo-senha" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="id-senhaNova" class="form-label">Nova senha</label>
                                            <input type="password" class="form-control" id="id-senhaNova"
                                                name="campo-senhaNova" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="id-senhaNovaConf" class="form-label">Confirmar nova senha</label>
                                            <input type="password" class="form-control" id="id-senhaNovaConf"
                                                name="campo-senhaNovaConf" />
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