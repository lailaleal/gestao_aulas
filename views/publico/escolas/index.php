<?php
// Carrega as bibliotecas
require_once "../../includes/autoLoad.php";

if(isset($_POST) && count($_POST) > 0) {

    require_once "../../../controllers/EscolasController.php";

    $obj = new Escolas();

    // Ele pega os dados do formulario HTML e atribui aos atributos do objeto
    $obj->setNome(htmlspecialchars($_POST['campo-nome']));
    $obj->setEmail(htmlspecialchars($_POST['campo-email']));
    $obj->setEndereco(htmlspecialchars($_POST['campo-endereco']));
    $obj->setHoraInicioAulaoEnem(htmlspecialchars($_POST['campo-hora-inicio']));
    $obj->setHoraFimAulaoEnem(htmlspecialchars($_POST['campo-hora-fim']));
    $obj->setDataAulaoEnem(htmlspecialchars($_POST['campo-data-horario']));
    $obj->setSenha(md5(htmlspecialchars($_POST['campo-senha'])));

    $interesse = isset($_POST['campo-interesse_aulao_enem']) ? 1 : 0;
    $obj->setInteresseAulaoEnem($interesse);

    $escolasController = new EscolasController();

    $escolasController->add($obj);
}

?>
<!doctype html>
<html lang="pt-br">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="../../css/adminlte.css" />
    <title>Gestão de aula | Escolas</title>
    <?php include '../../includes/head.php'; ?>
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
  <div
      class="relative flex min-h-screen w-full flex-col items-center justify-center p-4 group/design-root"
    >
    <div class="w-full max-w-md space-y-8">
        <div class="space-y-3 text-center">
          <h1
            class="text-4xl font-black leading-tight tracking-[-0.033em] text-[#111418] dark:text-white"
          >
            Cadastro de Escola
          </h1>
          <p
            class="text-base font-normal leading-normal text-[#617589] dark:text-gray-400"
          >
            Preencha os campos abaixo para criar a conta da sua escola.
          </p>
        </div>

          <!--begin::App Wrapper-->
          <div class="app-wrapper">
              <main class="app-main">
                  <!--begin::App Content-->
                  <div class="app-content">
                      <!--begin::Container-->
                      <div class="container-fluid">
                          <!--begin::Row-->
                          <div class="row">
                              <div class="col-12">
                                  <div class="card card-primary card-outline mb-4">
                                      <!--end::Header-->
                                      <!--begin::Form-->
                                      <form action="" method="post" class="space-y-6">
                                        <div class="space-y-4">
                                          <!--begin::Body-->
                                          <div class="card-body">
                                              <div class="mb-3">
                                                  <label for="nome-escola" class="form-label">Nome</label>
                                                  <input type="text" class="form-control" id="nome-escola"
                                                      name="campo-nome" />
                                              </div>
                                              <div class="mb-3">
                                                  <label for="id_email" class="form-label">E-mail</label>
                                                  <input type="email" class="form-control" id="id_email"
                                                      name="campo-email" />
                                              </div>
                                              <div class="mb-3">
                                                  <label for="id_endereco" class="form-label">Endereço</label>
                                                  <input type="text" class="form-control" id="id_endereco"
                                                      name="campo-endereco" />
                                              </div>
                                              <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" id="interesse-aulao" name="campo-interesse_aulao_enem" value="1">
                                                <label class="form-check-label" for="interesse-aulao">
                                                  Tem interesse em participar do aulão ENEM
                                                </label>
                                              </div>

                                              <div class="row mb-3" style="display: none" id="id-data-horario-container">
                                                <div class="col mb-3">
                                                  <label for="data-horario" class="form-label">Data do Aulão do ENEM</label>
                                                  <input type="date" class="form-control" id="id-data-horario" name="campo-data-horario" />
                                                </div>
                                                <div class="col mb-3">
                                                  <label for="hora-inicio" class="form-label">Hora de Início</label>
                                                  <input type="time" class="form-control" id="id-hora-inicio" name="campo-hora-inicio" />
                                                </div>
                                                <div class="col mb-3">
                                                  <label for="hora-fim" class="form-label">Hora de Fim</label>
                                                  <input type="time" class="form-control" id="id-hora-fim" name="campo-hora-fim" />
                                                </div>
                                              </div>

                                              <div class="mb-3">
                                                  <label for="id-senha" class="form-label">Senha</label>
                                                  <input type="password" class="form-control" id="id-senha"
                                                      name="campo-senha" />
                                              </div>
                                              <div class="mb-3">
                                                <label for="id-confirmar-senha" class="form-label">Confirmar Senha</label>
                                                <input type="password" class="form-control" id="id-confirmar-senha" name="campo-confirmar-senha" oninput="validarSenha()" />
                                              </div>
                                              <div id="senha-error" class="text-danger" style="display:none;">
                                                As senhas não conferem
                                              </div>

                                              <script>
                                                function validarSenha() {
                                                  var senha = document.getElementById('id-senha').value;
                                                  var confirmarSenha = document.getElementById('id-confirmar-senha').value;
                                                  var errorDiv = document.getElementById('senha-error');
                                                  var submitBtn = document.querySelector('button[type="submit"]');

                                                  if (senha !== confirmarSenha) {
                                                    errorDiv.style.display = 'block';
                                                    submitBtn.disabled = true;
                                                  } else {
                                                    errorDiv.style.display = 'none';
                                                    submitBtn.disabled = false;
                                                  }
                                                }
                                              </script>
                                          </div>
                                          <!--end::Body-->
                                          <!--begin::Footer-->
                                          <div class="card-footer">
                                              <button type="submit" class="btn btn-primary">Gravar</button>
                                          </div>
                                          <!--end::Footer-->
                                          </div>
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
          </div>
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <?php include '../../includes/js.php'; ?>

</body>
<!--end::Body-->

<script>
  const checkboxInteresse = document.getElementById('interesse-aulao');

  checkboxInteresse.addEventListener('change', function () {
    const campoDataHorario = document.getElementById('id-data-horario');
    const campoHoraInicio = document.getElementById('id-hora-inicio');
    const campoHoraFim = document.getElementById('id-hora-fim');
    const campoDataHorarioContainer = document.getElementById('id-data-horario-container');

    campoDataHorarioContainer.style.display = this.checked ? 'block' : 'none';

    if (!this.checked) {
      campoDataHorario.value = '';
      campoHoraInicio.value = '';
      campoHoraFim.value = '';
    }
  });
</script>

</html>
