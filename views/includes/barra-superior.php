<?php
require_once "../../controllers/NotificacoesController.php";
require_once "../../models/Notificacoes.php";
require_once "../../models/Usuario.php";
require_once "autoLoad.php";

Security::verifyAuthentication();

$usuario = unserialize($_SESSION[SessionConf::$sessionObj]);
$notificacoesController = new NotificacoesController();

if ($usuario) {
  $notificacoes = $notificacoesController->listarNaoLidas();
  $qtdNotificacoes = count($notificacoes);

  $usuario = unserialize($_SESSION[SessionConf::$sessionObj]);
  $iniciais = strtoupper(substr($usuario->getNome(), 0, 1));
}

?>

<style>
  .notificacao-item {
  white-space: normal !important;
  overflow-wrap: break-word;
  max-width: 280px;
}
</style>

<nav class="app-header navbar navbar-expand bg-body">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
        </ul>
        <!--end::Start Navbar Links-->
        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">
            <!--begin::Notifications Dropdown Menu-->
            <li class="nav-item dropdown">
                <a class="nav-link" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-bell-fill"></i>
                    <?php if ($qtdNotificacoes > 0): ?>
                        <span class="navbar-badge badge text-bg-warning"><?= $qtdNotificacoes ?></span>
                    <?php endif; ?>
                </a>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <span class="dropdown-item dropdown-header">
                        <?= $qtdNotificacoes ?> Notificação<?= $qtdNotificacoes !== 1 ? 'es' : '' ?>
                    </span>

                    <div class="dropdown-divider"></div>

                    <?php if ($qtdNotificacoes > 0): ?>
                        <?php foreach ($notificacoes as $n): ?>
                            <a href="#" class="dropdown-item notificacao-item">
                                <i class="bi bi-info-circle me-2"></i>
                                <?= htmlspecialchars($n->getMensagem()) ?>
                                <span class="float-end text-secondary fs-7">
                                    <?= date('d/m H:i', strtotime($n->getDataCriacao())) ?>
                                </span>
                            </a>
                            <div class="dropdown-divider"></div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="dropdown-item text-center text-muted small">
                            Nenhuma nova notificação
                        </div>
                    <?php endif; ?>
                </div>
            </li>
            <!--end::Notifications Dropdown Menu-->
            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                </a>
            </li>
            <!--end::Fullscreen Toggle-->
            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                  <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center shadow"
                      style="width: 35px; height: 35px; font-size: 16px; font-weight: bold;">
                    <?= $iniciais ?>
                  </div>
                  <span class="d-none d-md-inline"><?= htmlspecialchars($usuario->getNome()) ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <!--begin::User Image-->
                    <li class="user-header d-flex flex-column align-items-center justify-content-center"
                        style="background-color: #1e88e5; color: white;">
                      <div class="rounded-circle bg-white text-primary d-flex align-items-center justify-content-center shadow"
                          style="width: 90px; height: 90px; font-size: 36px; font-weight: bold; margin-bottom: 10px;">
                        <?= $iniciais ?>
                      </div>
                      <p class="m-0"><?= htmlspecialchars($usuario->getNome()) ?></p>
                    </li>
                    <!--end::User Image-->
                    <!--begin::Menu Footer-->
                    <li class="user-footer">
                        <a href="../usuarios/sair.php" class="btn btn-secondary btn-flat float-end">Sair</a>
                    </li>
                    <!--end::Menu Footer-->
                </ul>
            </li>
            <!--end::User Menu Dropdown-->
        </ul>
        <!--end::End Navbar Links-->
    </div>
    <!--end::Container-->
</nav>
