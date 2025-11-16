<?php
include "../../includes/autoLoad.php";

require_once "../../../controllers/EscolasController.php";
require_once "../../../controllers/HorariosProfessoresController.php";
require_once "../../../controllers/ProfessoresController.php";

$escolasController = new EscolasController();
$escolas = $escolasController->read();

if (isset($_POST) && count($_POST) > 0) {

    $horariosProfessoresController = new HorariosProfessoresController();

    $obj = new Professores();

    $obj->setNome(htmlspecialchars($_POST['campo-nome']));
    $obj->setEmail(htmlspecialchars($_POST['campo-email']));
    $obj->setTelefone(htmlspecialchars($_POST['campo-telefone']));
    $obj->setEspecialidade(htmlspecialchars($_POST['campo-especialidade']));
    $obj->setBiografia(htmlspecialchars($_POST['campo-biografia']));
    $obj->setValorHoraAula(htmlspecialchars($_POST['campo-valor_hora_aula']));
    $obj->setHorarios(json_decode($_POST['campo-horarios'], true));
    $obj->setSenha(htmlspecialchars(md5($_POST['campo-senha'])));

    $interesse = isset($_POST['campo-interesse_aulao_enem']) ? 1 : 0;
    $obj->setInteresseAulaoEnem($interesse);
    $idEscola = htmlspecialchars($_POST['campo-id_escola']) ?? null;
    if ($idEscola === '' || $idEscola === null) {
      $idEscola = null;
    }
    $obj->setIdEscola($idEscola);

    $professoresController = new ProfessoresController();

    $rs = $professoresController->add($obj);
}

?>
<!doctype html>
<html lang="pt-br">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="../../css/adminlte.css" />
    <title>Gestão de aula | Professores</title>
    <?php include '../../includes/head.php'; ?>
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">

        <main class="app-main">
            <!--begin::App Content Header-->
            <!-- Page Heading -->
          <div class="mb-8 text-center mt-4">
            <h1
              class="text-[#111418] dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]"
            >
              Cadastro de Professor
            </h1>
            <p
              class="text-[#617589] dark:text-gray-400 text-base font-normal leading-normal mt-2"
            >
              Preencha os campos abaixo para começar a compartilhar seu
              conhecimento.
            </p>
          </div>
            <!--begin::App Content-->
            <div class="app-content">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary card-outline mb-4">
                                <!--begin::Form-->
                                <form action="" method="post">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="id-nome" class="form-label">Nome</label>
                                            <input type="text" class="form-control" id="id-nome" name="campo-nome" required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="id-email" class="form-label">E-mail</label>
                                            <input type="email" class="form-control" id="id-email" name="campo-email" required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="id-telefone" class="form-label">Telefone</label>
                                            <input type="text" class="form-control" id="id-telefone" name="campo-telefone" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="id-especialidade" class="form-label">Especialidade</label>
                                            <select class="form-control" id="id-especialidade" name="campo-especialidade" required>
                                                <option value="">Selecione...</option>
                                                <option value="Química">Química</option>
                                                <option value="Física">Física</option>
                                                <option value="Matemática">Matemática</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="id-biografia" class="form-label">Biografia</label>
                                            <textarea name="campo-biografia" class="form-control" id="id-biografia"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="id-valor" class="form-label">Valor Hora Aula (R$)</label>
                                            <input type="number" step="0.01" class="form-control" id="id-valor" name="campo-valor_hora_aula" required />
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

                                        <hr>

                                        <h5>Horários Disponíveis para Aulas Particulares</h5>
                                        <input type="hidden" id="campo-horarios" name="campo-horarios" />
                                        <div class="mb-3">
                                          <label for="data-horario" class="form-label">Data</label>
                                          <input type="date" class="form-control" id="data-horario" name="data-horario" />
                                        </div>

                                        <div class="row mb-3">
                                          <div class="col">
                                            <label for="hora-inicio" class="form-label">Hora de Início</label>
                                            <input type="time" class="form-control" id="hora-inicio" name="hora-inicio" />
                                          </div>
                                          <div class="col">
                                            <label for="hora-fim" class="form-label">Hora de Fim</label>
                                            <input type="time" class="form-control" id="hora-fim" name="hora-fim" />
                                          </div>
                                        </div>

                                        <button type="button" class="btn btn-primary mb-4" onclick="adicionarHorario()">Adicionar Horário</button>


                                        <ul id="lista-horarios" class="list-group"></ul>

                                        <hr>
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
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Gravar</button>
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
        <!--begin::Footer-->
        <?php include '../../includes/rodape.php'; ?>
        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <?php include '../../includes/js.php'; ?>

</body>
<!--end::Body-->

<script>
  const horarios = [];

  const checkboxInteresse = document.getElementById('interesse-aulao');

  checkboxInteresse.addEventListener('change', function () {
    const campoEscolaDiv = document.getElementById('campo-id_escola-div');
    const campoEscola = document.getElementById('campo-id_escola');

    campoEscolaDiv.style.display = this.checked ? 'block' : 'none';
    if (!this.checked) campoEscola.value = '';
  });

  function adicionarHorario() {
    const data = document.getElementById('data-horario').value;
    const horaInicio = document.getElementById('hora-inicio').value;
    const horaFim = document.getElementById('hora-fim').value;
    const lista = document.getElementById('lista-horarios');

    if (!data || !horaInicio || !horaFim) {
      alert('Preencha todos os campos de data e hora!');
      return;
    }

    const horario = { data, horaInicio, horaFim };
    horarios.push(horario);

    const li = document.createElement('li');
    li.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');
    li.innerHTML = `
      ${data} - ${horaInicio} às ${horaFim}
    `;
    lista.appendChild(li);

    document.getElementById('campo-horarios').value = JSON.stringify(horarios);

    // limpa campos
    document.getElementById('data-horario').value = '';
    document.getElementById('hora-inicio').value = '';
    document.getElementById('hora-fim').value = '';
  }
</script>

</html>
