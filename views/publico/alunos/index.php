<?php
// Carrega as bibliotecas
require_once "../../includes/autoLoad.php";

require_once "../../../controllers/EscolasController.php";

$escolasController = new EscolasController();
$escolas = $escolasController->read();

if(isset($_POST) && count($_POST) > 0) {

    require_once "../../../controllers/AlunosController.php";

    // Cria um objeto do tipo Alunos
    $obj = new Alunos();

    // Ele pega os dados do formulario HTML e atribui aos atributos do objeto
    $obj->setNome(htmlspecialchars($_POST['campo-nome']));
    $obj->setEmail(htmlspecialchars($_POST['campo-email']));
    $obj->setTelefone(htmlspecialchars($_POST['campo-telefone']));
    $obj->setSerie(htmlspecialchars($_POST['campo-serie']));
    $obj->setSenha(md5(htmlspecialchars($_POST['campo-senha'])));

    $idEscola = htmlspecialchars($_POST['campo-id_escola']) ?? null;
    if ($idEscola === '' || $idEscola === null) {
        $idEscola = null;
    }
    $obj->setIdEscola($idEscola);

    $interesse = isset($_POST['campo-interesse_aulao_enem']) ? 1 : 0;
    $obj->setInteresseAulaoEnem($interesse);

    // Cria um objeto do tipo AlunosController
    $AlunosController = new AlunosController();

    // Pede para o controller adicionar o aluno
    $rs = $AlunosController->add($obj);
}

?>
<!doctype html>
<html lang="pt-br">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="../../css/adminlte.css" />
    <title>Gestão de aula | Alunos</title>
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
            Crie sua Conta de Aluno
          </h1>
          <p
            class="text-base font-normal leading-normal text-[#617589] dark:text-gray-400"
          >
            Preencha os campos abaixo para iniciar sua jornada de aprendizado.
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
                                                  <label for="id-aluno" class="form-label">Nome</label>
                                                  <input type="text" class="form-control" id="id-aluno"
                                                      name="campo-nome" />
                                              </div>
                                              <div class="mb-3">
                                                  <label for="id_email" class="form-label">E-mail</label>
                                                  <input type="email" class="form-control" id="id_email"
                                                      name="campo-email" />
                                              </div>
                                              <div class="mb-3">
                                                  <label for="id_telefone" class="form-label">Telefone</label>
                                                  <input type="text" class="form-control" id="id_telefone"
                                                      name="campo-telefone" />
                                              </div>
                                              <div class="mb-3">
                                                  <label for="id-serie" class="form-label">Série</label>
                                                  <input type="text" class="form-control" id="id-serie"
                                                      name="campo-serie" />
                                              </div>
                                              <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" id="interesse-aulao" name="campo-interesse_aulao_enem" value="1">
                                                <label class="form-check-label" for="interesse-aulao">
                                                  Tem interesse em participar do aulão ENEM
                                                </label>
                                              </div>
                                              <div class="mb-3" style="display: none" id="campo-id_escola-div">
                                                <label for="campo-id_escola" class="form-label">Escola</label>
                                                <select class="form-select w-100" id="campo-id_escola" name="campo-id_escola">
                                                  <option value="">Selecione uma escola</option>
                                                  <?php foreach ($escolas as $esc): ?>
                                                    <option value="<?= htmlspecialchars($esc->getId()) ?>">
                                                      <?= htmlspecialchars($esc->getNome()) ?>
                                                    </option>
                                                  <?php endforeach; ?>
                                                </select>
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
    const campoEscolaDiv = document.getElementById('campo-id_escola-div');
    const campoEscola = document.getElementById('campo-id_escola');

    campoEscolaDiv.style.display = this.checked ? 'block' : 'none';
    if (!this.checked) campoEscola.value = '';
  });
</script>

</html>
